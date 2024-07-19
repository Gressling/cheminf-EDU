# Laboratory Execution System (LES) Workflow Efficiency Project

## Introduction
The LES Workflow Efficiency Project aims to analyze and optimize the workflows of various laboratory processes, focusing on the synthesis of aspirin and copper sulfate pentahydrate. By studying the data related to these specific workflows, task statuses, resource allocation, and chemical and device usage, this project seeks to identify inefficiencies and propose improvements to streamline laboratory operations.

## Objective
The main objective of this project is to enhance the efficiency of laboratory workflows by:

- Analyzing the current workflow structures and identifying bottlenecks
- Optimizing resource allocation to minimize idle time and maximize productivity
- Identifying opportunities for process automation and standardization
- Proposing recommendations for workflow redesign and improvement

## Data Used
The project utilizes data from the following tables:

- `f6_laboratorytasks`: Tracks the status, resource allocation, time spent, and rewards for each task
- `f6_les_workflow`: Defines the high-level workflows (aspirin and copper sulfate pentahydrate synthesis) and their descriptions
- `f6_workflow_step_chemicals`: Maps the chemicals used in each step of the workflows
- `f6_workflow_step_devices`: Maps the devices used in each step of the workflows

The data has been collected through a combination of manual input and automated tracking systems. Preprocessing steps include data cleaning and integration of the various tables.

## Methodology
The project follows these key steps:

1. Data Exploration and Visualization
   - Analyze the relationships between workflows, steps, and their dependencies
   - Identify patterns and trends in task statuses, resource allocation, and time spent
   - Visualize the workflow structures and highlight potential bottlenecks

2. Workflow Optimization
   - Identify steps that can be parallelized or executed concurrently
   - Optimize resource allocation to minimize idle time and maximize utilization
   - Evaluate the impact of automating certain steps or introducing standardized protocols

3. Process Improvement Recommendations
   - Propose workflow redesigns to streamline the laboratory processes
   - Suggest changes in resource allocation and task scheduling
   - Identify areas where technology solutions can be implemented to enhance efficiency

4. Implementation and Monitoring
   - Implement the recommended changes through machine learning models
   - Establish metrics and key performance indicators (KPIs) to track the impact of improvements
   - Continuously monitor and refine the workflows based on feedback and data analysis

## Features

- **Task Status**: Indicates whether a task is pending, in-progress, or completed.
- **Resource Allocation**: Tracks which resources are allocated to which tasks.
- **Time Spent**: Measures the time spent on each task.
- **Reward**: Indicates the reward associated with each task, potentially correlating with task complexity or importance.
- **Chemical Usage**: Maps the chemicals used in each workflow step, including amounts where applicable.
- **Device Usage**: Maps the devices used in each workflow step.

## Predictions and Analysis
The project aims to predict and analyze:

- **Task Duration**: Estimating the time required for each task to identify opportunities for process improvement.
- **Resource Utilization**: Predicting the optimal allocation of resources to minimize idle time and maximize productivity.
- **Workflow Bottlenecks**: Identifying steps in the workflow that cause delays or inefficiencies.
- **Feature Importance**: Understanding which factors (e.g., resource allocation, task status) most significantly impact task duration and workflow efficiency.

## Machine Learning Approach
The project utilizes a Random Forest Regressor model to predict task duration and analyze feature importance. This approach allows for:

- Accurate prediction of task duration based on various features
- Identification of the most important factors influencing task duration
- Robust handling of non-linear relationships and interactions between features

## Installation and Usage

### Prerequisites

- Python 3.8 or higher
- pip (Python package installer)
- Required libraries: pandas, numpy, scikit-learn

### Installation Steps

1. Clone the repository:

   ```
   git clone https://github.com/yourusername/les-workflow-efficiency.git
   cd les-workflow-efficiency
   ```

2. Create a virtual environment:
    ```
    python -m venv venv
    source venv/bin/activate  # On Windows use `venv\Scripts\activate`
    ```

3. Install the required packages:

    ```
    pip install pandas numpy scikit-learn
    ```


1. Ensure your data is in CSV format named 'laboratory_tasks.csv' in the project directory.

2. Execute the Jupyter Notebook

3. View the results:
The notebook will output the model's performance metrics, feature importance, and a sample prediction.

## Future Improvements

- Incorporate more advanced machine learning techniques, such as neural networks or gradient boosting methods.
- Develop a user interface for easy interaction with the model and visualization of results.
- Implement real-time monitoring and prediction capabilities.
- Expand the analysis to include more diverse types of laboratory workflows.
