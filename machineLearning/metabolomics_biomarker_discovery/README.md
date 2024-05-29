# Metabolomics Dataset
## Overview

This repository contains a dataset derived from a metabolomics study aimed at distinguishing between diseased and healthy individuals based on metabolite levels. The dataset includes various metabolites measured in blood samples, along with demographic information such as age, gender, and disease status.

## Dataset Description
### Columns

 - **sample_id**: Unique identifier for each sample
 - **metabolite1 to metabolite10**: Quantitative measurements of different metabolites in the blood samples
 - **age**: Age of the individual from whom the sample was taken
 - **gender**: Gender of the individual (Male/Female)
 - **disease_status**: Health status of the individual, indicating whether they are "Healthy" or "Diseased"

### Sample Data

| sample_id | metabolite1 | metabolite2 | ... |  metabolite10 | age | gender | disease_status |
|-----------|-------------|-------------|-----|---------------|-----|--------|----------------|
| sample_0  | 0.676405    | 0.653278    | ... | 0.514195      | 43  | Female | Healthy        |
| sample_1  | 0.540016    | 0.646936    | ... | 0.468067      | 54  | Female | Diseased       |
| ...       | ...         | ...         | ... |  ...          | ... | ...    | ...            |
| sample_10 | 0.514404    | 0.461267    | ... |  0.440369     | 46  | Male   | Healthy        |
| ...       | ...         | ...         | ... |  ...          | ... | ...    | ...            |


### Statistical Summary

   - dataset contains quantitative data for ten metabolites, each represented by a column
   - age column represents the age of the individuals
   - gender column indicates the gender of the individuals
   - disease_status column categorizes individuals as either "Healthy" or "Diseased"

### Example Statistical Summaries
Means of Metabolite Levels by Disease Status
| disease_status | metabolite1 | metabolite2 | ... | metabolite10 | age   |
|----------------|-------------|-------------|-----|--------------|-------|
| Diseased       | 0.517483    | 0.502760    | ... | 0.467217     | 49.27 |
| Healthy        | 0.549179    | 0.468476    | ... | 0.484593     | 41.94 |


## Correlation Matrix

The correlation matrix below shows the correlation coefficients between different metabolites:
![grafik](https://github.com/Gressling/cheminf-EDU/assets/151255461/67beb9fe-2267-4bc3-b1ca-c4a112488ce4)

## Data Visualization

The dataset has been visualized using various plots:

  -  Distribution of Metabolites: Histograms for each metabolite show the distribution of their values
  -  Pairplots: Pairwise scatter plots of metabolites, colored by disease status, to visualize relationships and clustering
  -  Correlation Heatmap: A heatmap of the correlation matrix to identify relationships between different metabolites

## Usage

This dataset can be used for:

   - Analyzing the differences in metabolite levels between healthy and diseased individuals
   - Building machine learning models to predict disease status based on metabolite levels
   - Conducting statistical analysis to identify significant metabolites related to the disease

## Referneces and further reading

  - https://www.nature.com/articles/s41598-020-72914-7, see also:  https://www.kaggle.com/datasets/desertman/human-serum-metabolome-variability
  - https://www.kaggle.com/datasets/desertman/komp-plasma-metabolomics-dataset

## notes

  - https://chatgpt.com/share/1b6994f4-e909-46e0-8d15-17814f1b870b
  - https://www.kaggle.com/code/desertman/box-and-whisker-plots-for-a-metabolomics-dataset 
  

