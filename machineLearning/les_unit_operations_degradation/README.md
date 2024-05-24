# Situation Analysis Dataset

## Overview
This repository houses a dataset derived from a comprehensive study aimed at uncovering operational inefficiencies within a manufacturing process. 
The dataset encapsulates data collected from various unit operations, detailing parameters and degradation metrics.

## Dataset Description

### Degradation Data
Columns:

- id: Unique identifier for each data entry
- reactor_robot_id: Identifier for the reactor or robot involved
- experiment_group: Categorization of experiments
- workflow_step: Step within the workflow
- parameter_name: Name of the parameter recorded
- parameter_value: Value of the parameter recorded
- execution_time: Timestamp of the measurement
- inefficiency_score: Metric indicating operational inefficiency

### Parameters Data
Columns:

- Unit_Operation_ID: Identifier for the unit operation
- UOName: Name of the unit operation
- UODescription: Description of the unit operation
- UOParams: Parameters associated with the unit operation

## Sample Data

Degradation Data:
| id | reactor_robot_id | experiment_group | workflow_step | parameter_name | parameter_value | execution_time        | inefficiency_score |
|----|------------------|------------------|---------------|----------------|-----------------|-----------------------|--------------------|
| 1  | RR101            | Group2           | Step1         | Viscosity      | 344.139346      | 2024-05-13 11:30:53   | 0.087365           |
| 2  | RR104            | Group3           | Step1         | Viscosity      | 218.951722      | 2024-05-13 11:35:53   | 0.023142           |
| 3  | RR102            | Group1           | Step1         | Pressure       | 364.330959      | 2024-05-13 11:40:53   | 0.142511           |
| ...| ...              | ...              | ...           | ...            | ...             | ...                   | ...                |

Parameters Data:
| Unit_Operation_ID | UOName       | UODescription  | UOParams     |
|-------------------|--------------|----------------|--------------|
| UO001             | Distillation | ...            | ...          |
| UO002             | Dry          | ...            | ...          |
| UO003             | Mixing       | ...            | ...          |
| ...               | ...          | ...            | ...          |


## Statistical Summary
- The degradation data includes metrics for operational inefficiency, measured across different unit operations and workflow steps.
- The parameters data provides details about various unit operations and associated parameters. Statistical summaries provide insights into the dataset's central tendencies and variability.

## Example Statistical Summaries
#### Means of Inefficiency Scores by Experiment Group

| experiment_group | Mean_Inefficiency_Score |
|------------------|-------------------------|
| Group1           | 0.113                   |
| Group2           | 0.092                   |
| Group3           | 0.101                   |


## Minimum and Maximum Values
The tables below show the minimum and maximum values for each parameter in the degradation dataset. These values help identify the range and variability within the dataset.

### Minimum Values

| Parameter         | Minimum Value     |
|-------------------|-------------------|
| id                | 1                 |
| reactor_robot_id  | RR101             |
| experiment_group  | Group1            |
| workflow_step     | Step1             |
| parameter_name    | Pressure          |
| parameter_value   | 105.757959        |
| execution_time    | 2024-05-13 11:30:53 |
| inefficiency_score| 0.012226          |

### Maximum Values

| Parameter         | Maximum Value     |
|-------------------|-------------------|
| id                | 44                |
| reactor_robot_id  | RR104             |
| experiment_group  | Group3            |
| workflow_step     | Step3             |
| parameter_name    | Viscosity         |
| parameter_value   | 399.654102        |
| execution_time    | 2024-05-13 15:05:53 |
| inefficiency_score| 0.195349          |


## Correlation Matrix
The correlation matrix below exhibits the correlation coefficients between different operational parameters and inefficiency scores.

## Data Visualization
Visualizing the dataset involves the following plots:
- Distribution of Inefficiency Scores: A histogram that shows the distribution of inefficiency scores in the dataset.
- Inefficiency Score vs. Parameter Value: A scatter plot illustrating the relationship between parameter values and inefficiency scores, differentiated by experiment group.
- Correlation Heatmap: A heatmap displaying the correlation coefficients between various numerical parameters and inefficiency scores.

## Usage
This dataset can be used for:
- Analyzing operational inefficiencies spanning diverse unit operations and workflow steps.
- Developing predictive models to anticipate inefficiency scores based on operational parameters.
- Conducting statistical analyses to pinpoint significant parameters influencing operational inefficiencies.
