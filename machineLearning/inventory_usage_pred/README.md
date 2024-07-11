# Chemical Inventory Usage Prediction using LSTM

## Project Overview

This project aims to predict laboratory chemical inventory usage using a **Long Short-Term Memory (LSTM)** model. By analyzing historical inventory data, we will build a predictive model to optimize inventory management, reduce waste, and ensure smooth experiment operations.

## Dataset

The dataset used in this project contains the following fields:

*   `id`: Unique identifier for each record.
*   `amount_taken`: Amount of chemical taken.
*   `unit`: Unit of measurement for the amount taken (e.g., L, mg, ml, g).
*   `location`: Laboratory location where the chemical is stored.
*   `chemical`: Name of the chemical.
*   `CAS`: CAS Registry Number of the chemical, used for unique identification.
*   `reason`: Reason for taking the chemical (e.g., initial purchase, Experiment_20).

### Data Overview

The data overview can be found in the file `Data_Overview.ipynb`. The analysis reveals:

*   **Time span:** The dataset covers a period of approximately one year.
*   **Data distribution:** The distribution of `amount_taken` varies across different chemicals and units. Some chemicals have more frequent usage records than others.
*   **Missing values:** The dataset contains no missing values.
*   **Outliers:** Outliers exist in the `amount_taken` column, but they have not been removed, as they could represent valid extreme usage cases.

## Methodology

This project utilizes the **LSTM model**, a type of recurrent neural network well-suited for time series data, to predict chemical usage patterns.

### Data Preprocessing

The data preprocessing steps include:

1.  **Date conversion:** The `id` column was converted to datetime format for time series analysis.
2.  **Aggregation:** The data was aggregated by `date`, `location`, `reason`, `chemical`, and `unit` to get the total `amount_taken` for each combination.
3.  **One-Hot Encoding:** Categorical features (`location`, `reason`) were one-hot encoded to make them suitable for the LSTM model.

### Feature Engineering

The following features were engineered:

*   **Lag features:** Lag features (e.g., past 7-day and 30-day usage) were created for each chemical to capture time-dependent patterns in usage.
*   **One-Hot Encoded features:** The categorical features (`location` and `reason`) were one-hot encoded to be used as numerical inputs to the model.

### Features

The features used in this project for predicting chemical usage include:

*   `chemical`: The type of chemical being used (one-hot encoded).
*   `location`: The laboratory location where the chemical is stored/used (one-hot encoded).
*   `reason`: The reason for chemical usage (e.g., experiment, initial purchase) (one-hot encoded).
*   `date`: The date of chemical usage.
*   Lag features (e.g., past 7-day and 30-day usage) for each chemical.

### Prediction Target

The target variable is the `amount_taken`, representing the quantity of each chemical used. Separate models were built for each chemical due to the different units of measurement.

### Model Training and Evaluation

*   **LSTM Model:** The model has one LSTM layer with 50 units and ReLU activation, followed by a Dense output layer with 1 unit (for predicting the amount taken).
*   **Training:** The model was trained using the Adam optimizer and mean squared error (MSE) as the loss function.
*   **Evaluation:** The model was evaluated on a holdout test set (20% of the data). Evaluation metrics included Mean Squared Error (MSE), Mean Absolute Error (MAE), Root Mean Squared Error (RMSE), Mean Absolute Percentage Error (MAPE), and R-squared. The results are shown below.

## Results

| Chemical   | MSE      | MAE      | RMSE     | MAPE     | R-squared |
| :-------- | :------- | :------- | :------- | :------- | :-------- |
| Chemical_D | 44396.73 | 171.97   | 210.71  | 377.25%  | -1.32     |
| Chemical_A | 36698.06 | 167.81   | 191.57  | 399.76%  | -0.62     |
| Chemical_C | 95180.46 | 278.07   | 308.51  | 513.29%  | -4.52     |
| Chemical_B | 21392.41 | 120.44   | 146.26  | 230.67%  | -0.10     |

## Conclusion

The initial LSTM model shows poor performance on the test set, with negative R-squared values, indicating that the model's predictions are worse than simply using the mean value as a prediction.

## Future Work

*   **Data collection and preprocessing:** Collect more data to improve model training and explore data preprocessing techniques to handle outliers and normalize data.
*   **Feature engineering:** Experiment with additional features such as chemical properties, experiment types, and seasonality to improve model performance.
*   **Model architecture and hyperparameters:** Explore different LSTM architectures, including adding more layers or changing the number of units. Fine-tune hyperparameters such as learning rate and batch size.
*   **Alternative models:** Consider other time series forecasting models like ARIMA, Prophet, or other deep learning architectures.

## Installation and Usage

Tensorflow environment of Jyputer
All necessary packages are shown in the import cell 

## Contributors

Dr. Gressling, Me, ChatGPT and Google Gemini

## Considerations

* The current model may not generalize well to new data due to its poor performance on the test set.
* Chemical usage can be influenced by multiple factors, and the current model may not capture all of these factors.

## Contact

cheng.qian@student.hu-berlin.de
