# Sensors Monitoring

## Overview

This repository contains a dataset collected from a sensor over a period of time. The dataset includes information about sensor readings, temperature, humidity, and degradation levels recorded at different timestamps.

## Project Objective

The main objective of this project is to leverage the power of Convolutional Neural Networks (CNNs) to predict the degradation levels of sensors over time. By analyzing historical data collected from various sensors, the CNN model will learn to identify patterns and trends that indicate the degradation of sensor performance. Accurate prediction of degradation levels can help in proactive maintenance and preventing unexpected failures, ensuring the reliability and longevity of the equipment being monitored.

## Dataset Description

The dataset consists of the following features:

- **SensorID**: A unique identifier for each sensor.
- **Timestamp**: The specific date and time when the data was recorded.
- **SensorValue**: The numerical value recorded by the sensor at the given timestamp. 
- **Temperature**: The ambient temperature in degrees Celsius at the time the data was recorded.
- **Humidity**: he absolute humidity at the time the data was recorded, measured in grams of water vapor per cubic meter of air (g/m³). 
- **DegradationLevel**: A measure indicating the level of degradation, where a higher value represents greater degradation.

## Sample Data
|Feature | Value |
|----|----|
|Sensor ID | 1|
|Timestamp | 2024/1/2 00:00 |
|Sensor Value | 60.1641 |
|Temperature | 20.3917 |
|Humidity | 59.0499 |
|Degradation Level |0.012346 |

## Data Statistics

- Data over time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/cadcc85b-17a5-477b-81f6-38adeb43020a)

- Sensor Value over time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/a93b64aa-47c7-433b-9bd9-829b76d17b74)

- Temperature over time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/b5ab5fec-8eb6-48f6-bf18-606ac6f50489)

- Humidity over time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/caa4b8c0-8f84-48cf-9666-e5dbe6c9a3fd)

- DegradationLevel over time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/20d6dc29-65b0-4f70-b1a4-cd16a41609b3)

- Correlation Heatmap
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/1eb34ac8-87f4-4660-8cb4-3517df4af9e8)

- Sensor value and degradation level relation
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/ae1daeb5-a70f-42e6-89d5-76eebfe9754d)

- Temperature and humidity  relation over Time
![image](https://github.com/dlrow18/cheminf-EDU/assets/166999523/95f5b30c-dd83-47b7-a6b2-2ed2a4ba1449)


 

