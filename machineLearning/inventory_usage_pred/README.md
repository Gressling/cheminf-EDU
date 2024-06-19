# Chemical Inventory Usage Prediction

## Project Overview

This project aims to predict laboratory chemical inventory usage using machine learning models, specifically the **Long Short-Term Memory (LSTM)** model. By analyzing historical inventory data, including chemical names, CAS numbers, amounts used, and reasons for usage, we will build a predictive model to optimize inventory management, reduce waste, and ensure smooth experiment operations.

## Dataset

The dataset used in this project contains the following fields:

* `id`: Unique identifier for each record.
* `amount_taken`: Amount of chemical taken.
* `unit`: Unit of measurement for the amount taken (e.g., L, mg, ml, g).
* `location`: Laboratory location where the chemical is stored.
* `chemical`: Name of the chemical.
* `CAS`: CAS Registry Number of the chemical, used for unique identification.
* `reason`: Reason for taking the chemical (e.g., initial purchase, Experiment_20).


## Methods

This project will utilize the **LSTM model**, a type of recurrent neural network well-suited for time series data, to predict chemical usage patterns.

## Experiment Design

1. **Data Preprocessing:** Clean the data, handle missing values and outliers, and convert data types as needed.
2. **Feature Engineering:** Extract relevant features, such as time features, chemical categories, and experiment types.
3. **Model Training and Evaluation:** Train the LSTM model using the training set and evaluate its performance on the validation set.
4. **Model Selection:** Select the best-performing model based on the evaluation results.
5. **Model Deployment:** Deploy the chosen model to a production environment for real-time predictions.

## Considerations

* The dataset may have imbalanced classes, requiring appropriate handling techniques.
* Chemical usage can be influenced by multiple factors, so careful feature selection is necessary.
* Prediction results may have uncertainties, requiring judgment based on the specific context.

## Contact

If you have any questions or suggestions regarding this project, feel free to contact me.
