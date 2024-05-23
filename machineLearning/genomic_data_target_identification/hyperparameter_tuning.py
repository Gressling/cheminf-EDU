import sys
import numpy as np
import pandas as pd
from typing import List
import tensorflow as tf
import keras_tuner as kt
from pathlib import Path
from keras.regularizers import l2
from keras.models import Sequential
from sklearn.pipeline import Pipeline
from keras.layers import Dense, Dropout
from keras.callbacks import EarlyStopping
from sklearn.compose import ColumnTransformer
from sklearn.model_selection import StratifiedKFold
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler, OneHotEncoder

sys.path.append(str(Path(__file__).resolve().parent))
import db.db as db
import utils.utils as utils


def prepare_data(data: List[dict]) -> pd.DataFrame:
    """Convert list of dictionaries into a DataFrame and preprocesses it.

    Args:
        data (List[dict]): The data to process.

    Returns:
        pd.DataFrame: Processed data frame.
    """
    df = pd.DataFrame(data)
    X = df.drop(["gene_id", "gene_name", "drug_target"], axis=1)
    y = df["drug_target"]
    return X, y


def clean_data(df) -> pd.DataFrame:
    if "gene_name" in df.columns:
        # Correct missing 'gene_name' at entry 62
        df.loc[df["gene_id"] == 62, "gene_name"] = "GeneBJ"

    if "chromosome" in df.columns:
        # Correct missing 'chromosome' at entry 63
        df.loc[df["gene_id"] == 63, "chromosome"] = "Chr63"

    if "strand" in df.columns:
        # Correct missing 'strand' at entry 65
        df.loc[df["gene_id"] == 65, "strand"] = "-"

    return df


def create_preprocessor() -> ColumnTransformer:
    """Creates preprocessor to transform categorical features to numerical ones.

    Returns:
        ColumnTransformer: The transformer instance.
    """
    numeric_features = ["start_position", "end_position", "gene_expression"]
    numeric_transformer = Pipeline(steps=[("scaler", StandardScaler())])

    categorical_features = ["chromosome", "strand"]

    # one-hot encode categorical features to process these.
    # use sparse_output=False to make dense array - keras can handle that better
    categorical_transformer = Pipeline(
        steps=[("onehot", OneHotEncoder(handle_unknown="ignore", sparse_output=False))]
    )

    return ColumnTransformer(
        transformers=[
            ("num", numeric_transformer, numeric_features),
            ("cat", categorical_transformer, categorical_features),
        ]
    )


def build_model(
    input_dimension: int,
    use_dropout: bool = False,
    use_l2: bool = False,
    dropout_rate: float = 0.5,
    l2_rate: float = 0.01,
    learning_rate: float = 1e-3,
) -> Sequential:
    """Builds and compiles a Keras model for binary classification.

    Args:
        input_dimension (int): Input dimension.
        use_dropout (bool, optional): Flag to use dropout. Defaults to False.
        use_l2 (bool, optional): Flag to use l2 regularization. Defaults to False.
        dropout_rate (float, optional): Dropout rate. Defaults to 0.5.
        l2_rate (float, optional): L2 regularization rate. Defaults to 0.01.
        learning_rate (float, optional): Learning rate. Defaults to 1e-3.

    Returns:
        Sequential: The keras model.
    """
    model = Sequential()

    # first layer
    if use_l2:
        model.add(
            Dense(
                128,
                activation="relu",
                input_dim=input_dimension,
                kernel_regularizer=l2(l2_rate),
            )
        )
    else:
        model.add(Dense(128, activation="relu", input_dim=input_dimension))

    # dropout to prevent overfitting
    if use_dropout:
        model.add(Dropout(rate=dropout_rate))

    # hidden layer with l2 regularization
    if use_l2:
        model.add(Dense(64, activation="relu", kernel_regularizer=l2(l2=l2_rate)))
    else:
        model.add(Dense(64, activation="relu"))

    # use dropout on second layer
    if use_dropout:
        model.add(Dropout(rate=dropout_rate))

    # output layer
    model.add(Dense(1, activation="sigmoid"))

    # add optimizer
    optimizer = tf.keras.optimizers.Adam(learning_rate=learning_rate)

    # compile
    model.compile(optimizer=optimizer, loss="binary_crossentropy", metrics=["accuracy"])
    return model


def get_data_from_database(file_path: Path) -> None:
    """Create connection to database and load data.

    Args:
        file_path (Path): Data file path.
    """
    connection = db.connect_to_database()
    data = db.query_data(connection=connection, type="sql")
    if type(data) == list:
        # sql return value converted to csv
        utils.convert_to_csv(data=data, output_path=file_path)
    elif type(data) == pd.DataFrame:
        data.to_csv(file_path, index=False)
    else:
        print("Data invalid or empty.")
        raise


################################################################


# Hyperparameter search
def build_model(hp):
    model = Sequential()
    model.add(
        Dense(
            units=hp.Int("units", min_value=32, max_value=512, step=32),
            activation="relu",
            input_shape=(70,),
            kernel_regularizer=l2(
                hp.Float("l2_rate", min_value=1e-5, max_value=1e-2, sampling="LOG")
            ),
        )
    )
    model.add(Dropout(hp.Float("dropout_rate", min_value=0.0, max_value=0.5, step=0.1)))
    model.add(Dense(64, activation="relu"))
    model.add(Dense(1, activation="sigmoid"))

    model.compile(
        optimizer=tf.keras.optimizers.Adam(
            hp.Float("learning_rate", min_value=1e-5, max_value=1e-2, sampling="LOG")
        ),
        loss="binary_crossentropy",
        metrics=["accuracy"],
    )

    return model


def tune_hyperparameters(X, y, input_dim, max_trials=10, executions_per_trial=1):
    tuner = kt.Hyperband(
        build_model,
        objective="val_accuracy",
        max_epochs=50,
        factor=3,
        directory="tuner_results",
        project_name="hyperparameter_tuning",
        overwrite=True,
    )

    early_stopping = EarlyStopping(
        monitor="val_loss", patience=10, restore_best_weights=True
    )

    tuner.search(X, y, epochs=50, validation_split=0.2, callbacks=[early_stopping])
    best_hps = tuner.get_best_hyperparameters(num_trials=1)[0]
    return best_hps


################################################################


def train_model(
    use_dropout: bool = True,
    use_l2: bool = False,
    dropout_rate: float = 0.2,
    l2_rate: float = 0.01,
    use_cv: bool = False,
    n_splits: int = 5,
    learning_rate: float = 1e-3,
    epochs: int = 10,
    batch_size: int = 10,
    patience: int = 10,
    tune_hyperparams: bool = False,
    max_trials: int = 10,
) -> None:
    """Trains a keras model and saves the results and an additional plot to respective run directories. I am Batman.

    Args:
        use_dropout (bool, optional): Flag to use dropout. Defaults to True.
        use_l2 (bool, optional): Flag to use l2 regularization. Defaults to False.
        dropout_rate (float, optional): Dropout rate. Defaults to 0.2.
        l2_rate (float, optional): L2 regularization rate. Defaults to 0.01.
        use_cv (bool, optional): Flag to use cross validation. Defaults to False.
        n_splits (int, optional): Number of splits in CV. Defaults to 5.
        learning_rate (float, optional): The learning rate. Defaults to 1e-3.
    """

    #####################################################
    directory = Path("data")
    file_path = directory / "data.csv"
    utils.handle_paths(directory=directory, file_path=file_path)
    data_file_is_empty = utils.check_data_file_empty(file_path=file_path)

    if data_file_is_empty:
        get_data_from_database(file_path=file_path)

    data: pd.DataFrame = utils.load_data_csv(path=file_path)
    #####################################################

    # apply cleaning (just filling empty tuples)
    df_cleaned = clean_data(df=data)

    # create X and y
    X = df_cleaned.drop(["gene_id", "gene_name", "drug_target"], axis=1)
    y = df_cleaned["drug_target"]

    preprocessor: ColumnTransformer = create_preprocessor()
    X_transformed = preprocessor.fit_transform(X)
    # num of columns (distinct feats after processing)
    input_dim = X_transformed.shape[1]
    final_history = None
    metrics = None

    ######################################################################################
    if tune_hyperparams:
        best_hps = tune_hyperparameters(
            X_transformed, y, input_dim, max_trials=max_trials
        )
        dropout_rate = best_hps.get("dropout_rate")
        l2_rate = best_hps.get("l2_rate")
        learning_rate = best_hps.get("learning_rate")
        units = best_hps.get("units")

        print(f"Best hyperparameters found: {best_hps.values}")
        return

    ######################################################################################

    early_stopping = EarlyStopping(
        monitor="val_loss", patience=patience, restore_best_weights=True
    )

    if use_cv:
        print("Using Cross-Validation.\n")
        cv = StratifiedKFold(n_splits=n_splits, shuffle=True, random_state=42)
        fold_accuracies = []

        for train_index, val_index in cv.split(X_transformed, y):
            X_train, X_val = X_transformed[train_index], X_transformed[val_index]
            y_train, y_val = y[train_index], y[val_index]

            model = build_model(
                input_dimension=input_dim,
                use_dropout=use_dropout,
                use_l2=use_l2,
                dropout_rate=dropout_rate,
                l2_rate=l2_rate,
                learning_rate=learning_rate,
            )

            final_history = model.fit(
                X_train,
                y_train,
                epochs=10,
                batch_size=10,
                validation_data=(X_val, y_val),
                callbacks=[early_stopping],  # add callback
            )

            score = model.evaluate(X_val, y_val, verbose=0)
            fold_accuracies.append(score[1])

        print(
            f"CV Accuracy: {sum(fold_accuracies) / len(fold_accuracies):.4f} (+/- {np.std(fold_accuracies):.4f})"
        )

        # final training on entire dataset after CV
        model = build_model(
            input_dimension=input_dim,
            use_dropout=use_dropout,
            use_l2=use_l2,
            dropout_rate=dropout_rate,
            l2_rate=l2_rate,
            learning_rate=learning_rate,
        )
        final_history = model.fit(
            X_transformed,
            y,
            epochs=epochs,
            batch_size=batch_size,
            callbacks=[early_stopping],
        )
        metrics = model.evaluate(X_transformed, y, verbose=0)
        print(f"Final test accuracy: {metrics[1]:.4f}")

    else:
        X_train, X_test, y_train, y_test = train_test_split(
            X_transformed, y, test_size=0.2, random_state=42
        )

        model = build_model(
            input_dimension=input_dim,
            use_dropout=use_dropout,
            use_l2=use_l2,
            dropout_rate=dropout_rate,
            l2_rate=l2_rate,
            learning_rate=learning_rate,
        )

        final_history = model.fit(
            X_train,
            y_train,
            epochs=epochs,
            batch_size=batch_size,
            validation_split=0.2,
            callbacks=[early_stopping],
        )

        metrics = model.evaluate(X_test, y_test, verbose=0)
        print(f"Final test accuracy: {metrics[1]:.4f}")

    ###############################################################################

    # save model parameters
    hyperparameters = {
        "use_dropout": use_dropout,
        "use_l2": use_l2,
        "dropout_rate": dropout_rate,
        "l2_rate": l2_rate,
        "learning_rate": learning_rate,
        "epochs": epochs,
        "batch_size": batch_size,
        "patience": patience,
    }

    if final_history:
        utils.save_results(
            history=final_history,
            metrics=metrics,
            use_cv=use_cv,
            hyperparameters=hyperparameters,
            results_dir="results",
        )


########################################################

if __name__ == "__main__":
    # Note: Using only CV does not prevent overfitting - recommended to use either one if not both
    # Adjust epochs accordingly. We only have about 68 rows, so achieving overfitting is quite easy...
    # Additional: Setting the tune_hyperparams flag tunes hyperparameters here but does not train the model with the best hyperparams.
    # This may take a while...
    train_model(
        use_dropout=True,
        use_l2=True,
        dropout_rate=0.6,
        l2_rate=0.01,
        use_cv=True,
        n_splits=2,
        learning_rate=1e-2,
        epochs=5,
        patience=10,
        tune_hyperparams=True,
    )
