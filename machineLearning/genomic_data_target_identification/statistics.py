import sys
import numpy as np
import pandas as pd
from typing import List
import tensorflow as tf
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


if __name__ == "__main__":
    directory = Path("data")
    file_path = directory / "data.csv"
    utils.handle_paths(directory=directory, file_path=file_path)
    data_file_is_empty = utils.check_data_file_empty(file_path=file_path)

    if data_file_is_empty:
        get_data_from_database(file_path=file_path)

    data: pd.DataFrame = utils.load_data_csv(path=file_path)
    #####################################################

    # Statistics are calculated for these values. The others wouldn't make much sense tbh.
    numeric_columns = ["start_position", "end_position", "gene_expression"]
    stats = data[numeric_columns].describe()

    # Handling missing values before statistics
    data["start_position"] = pd.to_numeric(data["start_position"], errors="coerce")
    data["end_position"] = pd.to_numeric(data["end_position"], errors="coerce")
    data["gene_expression"] = pd.to_numeric(data["gene_expression"], errors="coerce")

    # Fill or drop NaNs for meaningful statistics
    data.fillna(
        {
            "start_position": data["start_position"].mean(),
            "end_position": data["end_position"].mean(),
            "gene_expression": data["gene_expression"].mean(),
            "chromosome": "Unknown",
            "strand": "+",
        },
        inplace=True,
    )

    # Re-compute statistics after handling NaNs
    stats_after_fill = data[numeric_columns].describe()

    print("\nStatistical values (after handling NaNs):")
    print(stats_after_fill)

    # Additional statistics
    min_values = data[numeric_columns].min()
    max_values = data[numeric_columns].max()
    mean_values = data[numeric_columns].mean()

    print("\nMinimum values:")
    print(min_values)
    print("\nMaximum values:")
    print(max_values)
    print("\nMean values:")
    print(mean_values)

    with open("./statistics.txt", "w") as f:
        f.write("Statistical values (after handling NaNs):\n")
        f.write(stats_after_fill.to_string())
        f.write("\n\nMinimum values:\n")
        f.write(min_values.to_string())
        f.write("\n\nMaximum values:\n")
        f.write(max_values.to_string())
        f.write("\n\nMean values:\n")
        f.write(mean_values.to_string())
