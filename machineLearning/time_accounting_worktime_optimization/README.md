# AI in Chemistry: Worktime Optimization using Reinforcement Learning

## Introduction

This project aims to optimize worktime accounting for various experimental tasks in a chemistry lab using reinforcement learning. By analyzing data from experiments and their corresponding tasks, we aim to develop a Machine Learning model that can efficiently allocate worktime to maximize productivity and rewards.

## Objective

The primary objective of this project is to utilize reinforcement learning techniques to optimize the scheduling and allocation of worktime for different experimental tasks. The goal is to minimize idle time and maximize the rewards associated with completing tasks within a chemistry lab setting.

## Features

The dataset contains the following parameters for each experimental task:

- **ExperimentID**: A unique identifier for each experiment.
- **TaskID**: A unique identifier for each task.
- **TaskDescription**: A brief description of the task.
- **StartTime**: The start time of the task.
- **EndTime**: The end time of the task.
- **TotalTime**: The total time taken to complete the task.
- **Reward**: The reward associated with completing the task.
- **ExperimentGroup**: The group or category of the experiment.

Example data:

| ExperimentID | TaskID | TaskDescription | StartTime          | EndTime            | TotalTime | Reward | ExperimentGroup |
|--------------|--------|-----------------|--------------------|--------------------|-----------|--------|-----------------|
| 144          | 2      | cleaning        | 2024/1/1 9:00      | 2024/1/1 9:30      | 161       | 14     | Ethylvanillin   |
| 147          | 4      | benchtop        | 2024/1/1 10:00     | 2024/1/1 10:30     | 128       | 5      | Ethylvanillin   |
| 164          | 1      | precursor       | 2024/1/1 11:00     | 2024/1/1 11:30     | 72        | 8      | Guaiacol        |
| 167          | 4      | benchtop        | 2024/1/1 12:00     | 2024/1/1 12:30     | 142       | 5      | ortho-Vanillin  |
| 167          | 3      | analytics       | 2024/1/1 13:00     | 2024/1/1 13:30     | 179       | 1      | ortho-Vanillin  |

## Prediction Objective

The primary objective of the project is to optimize the scheduling and allocation of worktime for various experimental tasks using reinforcement learning. The specific prediction that the reinforcement learning model is:

**Reward Maximization**: Ensuring that the tasks are completed in a way that maximizes the total reward, balancing high-reward tasks with the need to minimize idle time (refers to the periods during which resources, such as personnel, equipment, or machinery, are not actively engaged in productive tasks or operations).

## Methodology

The project follows these steps:

1. **Data Preprocessing**: Clean and preprocess the data to ensure it is in a suitable format for analysis.
2. **Model Selection**: Choose a reinforcement learning model that fits the problem. Possible models include Q-Learning, Deep Q-Networks (DQN), and Policy Gradient methods.
3. **Training**: Train the model using the experimental data to learn the optimal scheduling and allocation of tasks.
4. **Evaluation**: Evaluate the model's performance using metrics such as total reward, average idle time, and task completion time.
5. **Optimization**: Fine-tune the model to improve its performance based on evaluation results.

## How to Present Results

The results of the project will be presented in the following formats:

- **Graphs and Charts**: Visual representations of task scheduling, idle times, and reward distribution.
- **Summary Statistics**: Key metrics such as total rewards, average task completion time, and overall efficiency improvements.
- **Model Performance**: Detailed analysis of the model's performance, including training progress and evaluation metrics.

## Conclusion

This project demonstrates the application of reinforcement learning in optimizing worktime allocation for experimental tasks.



 

