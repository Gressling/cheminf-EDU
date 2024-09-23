# Laboratory Execution System (LES) Workflow Efficiency Project

## Introduction
The LES Workflow Efficiency Project aims to analyze and optimize the workflows of various laboratory processes. By studying the data related to different synthesis workflows, task statuses, resource allocation, and chemical and device usage, this project seeks to identify inefficiencies and propose improvements to streamline laboratory operations.

## Objective
The main objective of this project is to enhance the efficiency of laboratory workflows by:

- Analyzing the current workflow structures and identifying bottlenecks
- Optimizing resource allocation to minimize idle time and maximize productivity
- Identifying opportunities for process automation and standardization
- Proposing recommendations for workflow redesign and improvement

## Data Used
The project utilizes data from the following tables:

- `f6_entity`: Contains information about various entities involved in the workflows
- `f6_laboratorytasks`: Tracks the status, resource allocation, time spent, and rewards for each task
- `f6_les_workflow`: Defines the high-level workflows and their descriptions
- `f6_workflow_step_chemicals`: Maps the chemicals used in each step of the workflows
- `f6_workflow_step_devices`: Maps the devices used in each step of the workflows

The data is assumed to be collected through a combination of manual input, automated tracking systems, and sensor data. Preprocessing steps may include data cleaning, normalization, and integration.

## Methodology
The project will follow these key steps:

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
   - Collaborate with laboratory personnel to implement the recommended changes
   - Establish metrics and key performance indicators (KPIs) to track the impact of improvements
   - Continuously monitor and refine the workflows based on feedback and data analysis

## Features

- **Task Status**: Indicates whether a task is pending, in-progress, or completed. This helps in understanding the current state of the workflow and identifying bottlenecks.
- **Resource Allocation**: Tracks which resources are allocated to which tasks. This is crucial for optimizing resource utilization and minimizing idle time.
- **Time Spent**: Measures the time spent on each task. This helps in identifying time-consuming steps and opportunities for process improvement.
- **Chemical and Device Usage**: Maps the chemicals and devices used in each workflow step. This information is essential for ensuring that the necessary materials and equipment are available and used efficiently.

## Predictions
The project aims to predict:

- **Workflow Bottlenecks**: Identifying steps in the workflow that cause delays or inefficiencies.
- **Resource Utilization**: Predicting the optimal allocation of resources to minimize idle time and maximize productivity.
- **Time Optimization**: Estimating the time required for each task to identify opportunities for process improvement.
- **Automation Opportunities**: Identifying steps that can be automated to enhance efficiency and standardize processes.


## Installation and Usage (Preliminary)

### Prerequisites

- Python 3.8 or higher
- pip (Python package installer)
- Git

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
    pip install -r requirements.txt
    ```

### Example Usage

1. Run the data preprocessing script:

    ```
    python preprocess_data.py
    ```

2. Execute the workflow analysis:

    ```
    python analyze_workflows.py
    ```

3. Generate optimization recommendations:

    ```
    python optimize_workflows.py
    ```

4. View the results:

    The results will be saved in the results directory. You can view the visualizations and recommendations in the generated reports.
