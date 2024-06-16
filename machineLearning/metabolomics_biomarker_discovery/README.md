# Metabolomics Dataset
## Overview

This repository contains a dataset derived from a metabolomics study aimed at distinguishing between diseased and healthy individuals based on metabolite levels. Metabolomics, a field within "omics" sciences, focuses on the comprehensive analysis of small molecules, known as metabolites, within biological samples. The primary goal of this study is to identify metabolic differences that can serve as biomarkers for disease states, offering potential insights for diagnosis, prognosis, and therapeutic interventions.

The dataset includes quantitative measurements of various metabolites in blood samples, along with demographic information such as age, gender, and disease status. By analyzing this data, researchers can potentially uncover significant metabolic alterations associated with different health conditions, advancing our understanding of disease mechanisms and aiding in the development of personalized medicine.

## Metabolomics: An Overview

### Definition and Importance
Metabolomics is the scientific study of chemical processes involving metabolites, which are the intermediates and products of metabolism. The metabolome represents the complete set of metabolites in a biological cell, tissue, organ, or organism, which are the end products of cellular processes. The study of these small molecules and their interactions within a biological system provides a direct functional readout of cellular activity and physiological status.

The following graphic illustrates the factors influencing the phenotype and the role of metabolomics in understanding these influences:

By leveraging this dataset, researchers can apply various analytical and statistical techniques to uncover significant metabolic differences, leading to a better understanding of disease states and potential avenues for treatment and prevention.
<p align="center">
  <img src="https://github.com/Gressling/cheminf-EDU/assets/151255461/ec010b09-38f4-446b-9396-7c8b8c726a84" alt="1578509820-640w_mti_metabolomics">
</p>

<p align="center">
  Source: <a href="https://www.mtidx.com/our-technology/metabolomics">MTI Metabolomics</a>
</p>

### Applications
Metabolomics has a broad range of applications in various fields, including:

   - **Medical Research**: Identifying biomarkers for diseases, understanding disease mechanisms, and discovering new therapeutic targets
   - **Pharmacology**: Investigating drug metabolism and pharmacokinetics, and predicting drug efficacy and toxicity
   - **Nutrition**: Analyzing the impact of diet on health and identifying metabolic responses to dietary interventions
   - **Environmental Science**: Studying the effects of environmental changes on organisms and ecosystems through metabolic alterations
### Techniques
Several analytical techniques are employed in metabolomics to identify and quantify metabolites, including:

 - **Mass Spectrometry (MS)**: Provides detailed information on the molecular weight and structure of metabolites.
 - **Nuclear Magnetic Resonance (NMR) Spectroscopy**: Offers insights into the molecular structure and dynamics of metabolites.
 - **Chromatography**: Techniques like Gas Chromatography (GC) and Liquid Chromatography (LC) are used to separate complex mixtures of metabolites before MS or NMR analysis.

### Data Analysis
The analysis of metabolomic data involves several steps:

   1.  **Data Acquisition**: Collecting quantitative measurements of metabolites using analytical techniques.
   2.  **Data Preprocessing**: Normalizing and transforming raw data to reduce technical variability.
   3.  **Statistical Analysis**: Applying statistical methods to identify significant differences between groups (e.g., healthy vs. diseased).
   4.  **Pathway Analysis**: Mapping significant metabolites to metabolic pathways to understand the biological context.
    
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
  -  Violinplots: Depict the distribution of metabolite levels by disease status, combining aspects of boxplots and kernel density plots
  -  Heatmap of Average Metabolite Levels: Shows the average levels of each metabolite for healthy and diseased groups, providing a clear comparison
  -  Swarmplot: Visualizes the distribution of individual data points for a specific metabolite by disease status and gender
  -  Boxplot: Illustrate the median, quartiles, and outliers of metabolite levels for different disease statuses
  -  Histograms: Show the distribution and frequency of metabolite levels in the dataset

## 3D Plots
### Correlation Matrix

![newplot](https://github.com/Gressling/cheminf-EDU/assets/151255461/61771c67-83b4-492b-a2f5-e23ed24f3d5d)

### Scatter Plot 
![newplot (1)](https://github.com/Gressling/cheminf-EDU/assets/151255461/8ed0eafe-ca41-4b5e-9ae4-f102dde48573)

### Surface Plot 
![newplot (2)](https://github.com/Gressling/cheminf-EDU/assets/151255461/e430002f-0c61-4918-9993-645be0af97cb)


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
  

