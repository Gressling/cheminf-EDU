# Chemical Inventory Usage Prediction using LSTM

## Project Overview

This project aims to predict laboratory chemical inventory usage using a **Long Short-Term Memory (LSTM)** model. By analyzing historical inventory data, we will build a predictive model to optimize inventory management, reduce waste, and ensure smooth experiment operations.

## Dataset

The dataset used in this project contains the following fields:

* `id`: Unique identifier for each record.
* `amount_taken`: Amount of chemical taken.
* `unit`: Unit of measurement for the amount taken (e.g., L, mg, ml, g).
* `location`: Laboratory location where the chemical is stored.
* `chemical`: Name of the chemical.
* `CAS`: CAS Registry Number of the chemical, used for unique identification.
* `reason`: Reason for taking the chemical (e.g., initial purchase, Experiment_20).

### Data Overview

The date overview can be found in the file Data_Overview.ipynb

## Methodology

This project will utilize the **LSTM model**, a type of recurrent neural network well-suited for time series data, to predict chemical usage patterns.

### Data Preprocessing



### Feature Engineering

### Features

The features used in this project for predicting chemical usage include:

*   `chemical`: The type of chemical being used.
*   `location`: The laboratory location where the chemical is stored/used.
*   `reason`: The reason for chemical usage (e.g., experiment, initial purchase).
*   `date`: The date of chemical usage.
*   Lag features (e.g., past 7-day and 30-day usage) for each chemical.

### Prediction Target

The target variable is the `amount_taken`, representing the quantity of each chemical used. Separate models will be built for each chemical to accommodate different units of measurement.


### Model Training and Evaluation

* **LSTM Model:** Explain the architecture of your LSTM model (e.g., number of layers, number of units per layer, activation functions, etc.).
* **Training:** Describe the training process (e.g., loss function, optimizer, batch size, number of epochs).
* **Evaluation:** Explain how you evaluated the model (e.g., using a validation set, cross-validation). List the evaluation metrics you used (e.g., mean squared error, mean absolute error).

## Results



## Conclusion



## Future Work


## Installation and Usage

## Contributors

## License

## Acknowledgements


## Considerations

* The dataset may have imbalanced classes, requiring appropriate handling techniques.
* Chemical usage can be influenced by multiple factors, so careful feature selection is necessary.
* Prediction results may have uncertainties, requiring judgment based on the specific context.

## Contact

If you have any questions or suggestions regarding this project, feel free to contact me.
