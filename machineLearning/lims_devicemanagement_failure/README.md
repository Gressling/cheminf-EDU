# Device Failure Prediction 

## Introduction
The Device Failure Prediction project aims to leverage AI techniques, specifically Recurrent Neural Networks (RNNs), to predict device failures in a laboratory setting. By analyzing calibration results and status fields, this project seeks to provide early warnings for potential device failures, allowing for proactive maintenance and reduced downtime.

## Objective
The main objective of this project is to develop a predictive model using RNNs to estimate the likelihood of device failures. The specific goals include:

- Analyzing historical calibration data to identify patterns indicative of failure
- Developing a model that can predict device failures based on calibration results and operational status
- Providing actionable insights to improve maintenance schedules and device reliability

## Data Used
The project utilizes data from the following tables in the MySQL database:

- **c3_devicecalibration**: Contains calibration results and relevant dates for various devices.
- **c3_device_properties**: Includes properties and specifications of the devices.
- **c3_devices**: Lists the devices used in the laboratory with their operational status.
- **c3_devices_depr**: Contains deprecated or retired device information.
- **c3_devices_properties_temp**: Temporary properties of devices for ongoing calibration processes.

The dataset includes normal distributions for measurements and randomized dates for calibration relevance, making it suitable for RNN-based predictive analysis.

### Example Data
Below are samples of the data from each table:

#### c3_devicecalibration
| ID | DeviceID | CalibrationDate     | CalibrationDueDate    | CalibrationResult | Technician | GroupLabel | Measurement1 | Measurement2 | Measurement3 | Status      |
|----|----------|---------------------|-----------------------|-------------------|------------|------------|--------------|--------------|--------------|-------------|
| 1  | Device001| 2024-01-01 11:21:16 | 2025-03-06 11:21:16   | Pass              | John Smith | Group3     | 0.001103     | 0.002149     | 0.003052     | Operational |
| 2  | Device002| 2023-11-04 11:21:16 | 2025-01-24 11:21:16   | Adjust            | John Smith | Group1     | 0.000872     | 0.002020     | 0.003120     | Operational |
| 3  | Device003| 2023-06-07 11:21:16 | 2024-08-18 11:21:16   | Pass              | Bob Lee    | Group3     | 0.001084     | 0.001953     | 0.002962     | Operational |
| 4  | Device004| 2024-02-02 11:21:16 | 2024-08-28 11:21:16   | Adjust            | John Smith | Group2     | 0.000851     | 0.002181     | 0.003069     | Operational |
| 5  | Device005| 2023-12-03 11:21:16 | 2024-07-03 11:21:16   | Adjust            | John Smith | Group2     | 0.000893     | 0.001771     | 0.003035     | Failed      |

#### c3_device_properties
| id | category               | subcategory             | attribute | value            |
|----|------------------------|-------------------------|-----------|------------------|
| 1  | 3D Printing Equipment  | 3D Printer Accessories  | Color     | Blue             |
| 2  | 3D Printing Equipment  | 3D Printer Accessories  | Color     | Clear            |
| 3  | 3D Printing Equipment  | 3D Printer Accessories  | Color     | Red              |
| 4  | 3D Printing Equipment  | 3D Printer Accessories  | Color     | Transparent      |
| 5  | 3D Printing Equipment  | 3D Printer Accessories  | Color     | Transparent Blue |

#### c3_devices
| id | name                         | property_hash |
|----|------------------------------|---------------|
| 1  | Agilent 1260 Infinity II LC  | None          |
| 2  | Nexera X2                    | None          |
| 3  | ACQUITY UPLC H-Class System  | None          |


#### c3_devices_depr
--

#### c3_devices_properties_temp
| id | attribute                  | value                                                                                        | d_id |
|----|----------------------------|----------------------------------------------------------------------------------------------|------|
| 1  | Column Capacity            | 4                                                                                            | 1    |
| 2  | Column ID Reader Option    | Optional                                                                                     | 1    |
| 3  | Depth                      | 468 mm                                                                                       | 1    |
| 4  | Flow Range                 | 0.05 to 5 mL/min with G7112B, 0.2 to 10 mL/min with G7116A/B                                 | 1    |
| 5  | Injection Range            | 0.1-100 µL, 0.1-900 µL with Extended Injection Range                                         | 1    |

## Methodology
The project will follow these key steps:

### Data Exploration and Visualization
- Analyze the relationships between calibration results, dates, and device statuses.
- Identify patterns and trends in calibration data that precede device failures.
- Visualize the calibration data to highlight potential indicators of failure.

### Model Development
- Preprocess the data by cleaning and normalizing the calibration results and statuses.
- Develop an RNN model to predict device failures based on historical calibration data.
- Train the RNN model using a training dataset and validate its performance using a separate validation dataset.

### Model Evaluation
- Evaluate the model using metrics such as accuracy, precision, recall, and F1-score.
- Perform cross-validation to ensure the model's robustness and generalizability.

### Implementation and Monitoring
- Integrate the predictive model into the laboratory's maintenance system.
- Set up continuous monitoring to provide real-time failure predictions and maintenance alerts.
- Regularly update the model with new calibration data to maintain its accuracy.

## Features (Preliminary)
- **CalibrationResult**: The result of the device calibration, which indicates the accuracy of the device's measurements.
- **Status**: Indicates whether a device has passed or failed calibration. This helps in understanding the current operational state of the device.
- **Device Properties**: Additional properties and specifications of the devices that may influence their performance and failure rates.

## Installation and Usage
### Prerequisites
- Python installed on your system.
- MySQL database with the relevant tables and data.
- Required Python libraries: `pymysql`, `pandas`, `matplotlib`, `tensorflow` (or `pytorch` for the RNN model).

### Installation Steps
1. Clone the repository to your local machine and navigate to the project directory.
2. Install the required packages using the following command:
   ```sh
   pip install -r requirements.txt
   
### Example Usage
import pymysql.cursors
import pandas as pd
import matplotlib.pyplot as plt
import tensorflow as tf
#### Connect to the database
connection = pymysql.connect(
    host='den1.mysql6.gear.host',
    user='situation',
    password='your_password',
    database='situation',
    cursorclass=pymysql.cursors.DictCursor
)
#### Fetch data from the c3_devicecalibration table
sql = "SELECT * FROM c3_devicecalibration;"
data = pd.read_sql(sql, connection)
#### Display the first few rows of the data
print(data.head())
#### Preprocess the data for RNN model
#### Define and train the RNN model
#### Predict device failures


## Conclusion

This project aims to provide a robust and scalable solution for predicting device failures in laboratory settings. By leveraging advanced machine learning techniques, specifically RNNs, we can gain valuable insights into device performance and take proactive measures to maintain operational efficiency.

## References
Recurrent Neural Networks:
Data Preprocessing for Machine Learning: 
TensorFlow Documentation: https://www.tensorflow.org/



