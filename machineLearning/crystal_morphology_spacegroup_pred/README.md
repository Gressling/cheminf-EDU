# Crystal Morphology Space Groups Prediction

## Overview
The project is focused on the analysis of crystal morphology data with the ultimate goal of training a Convolutional Neural Network (CNN) to predict space groups. Currently, the project involves data extraction from a database, decoding and analysing the morphology data, and visualising various aspects of the data to gain insights that will inform the machine learning model development.

## Data Overview
### What is Crystal Morphology?

Crystal morphology refers to the external shape and structure of a crystal, which is determined by the arrangement of atoms within the crystal lattice. Understanding crystal morphology is essential in various fields such as materials science, geology, and chemistry, as it influences the properties and applications of the material.

### What are Space Groups?
Space groups are a classification of the symmetrical arrangement of atoms in a crystal. They describe the symmetry and repetitive patterns in three-dimensional space. There are 230 unique space groups in crystallography, each representing a distinct symmetry.

### Data Overview
The data in the database is structured as follows:

| Column name    | Description                                                    |
|----------------|----------------------------------------------------------------|
| **id**         | Unique identifier for each record                              |
| **bitmap**     | Encoded bitmap data representing the morphology of the crystal |
| **spacegroup** | Label representing the space group of the crystal              |


## Work with this Dataset
### Data Extraction from the Database
First, use the `db_access.ipynb` notebook to establish a connection to your database and extract the required crystal morphology data. This notebook will guide you through querying the database and saving the extracted data into a CSV file named `data/data.csv`.

### Data Analysis and Visualisation
After extracting the data, use the `db_analysis.py` to analyse and visualise the data. This script reads the CSV file, decodes the morphology data, and calculates statistical measures such as the average brightness of the images. It also generates various visualisations, including histograms of pixel values, average brightness per space group, and brightness distribution per space group. These analyses provide insights into the characteristics and distribution of the morphology data, which will be crucial for developing the CNN model for space group prediction.

## Potential Uses of the Dataset
The crystal morphology dataset can be utilised in various ways:
1. **Machine Learning**: Training machine learning models, especially Convolutional Neural Networks (CNNs), to predict space groups based on crystal morphology data.
2. **Materials Science**: Analyzing the relationship between crystal morphology and material properties, leading to the discovery of new materials with desired characteristics.
3. **Educational Purposes**: Providing a rich dataset for teaching and learning about crystallography, symmetry in crystals, and the application of machine learning in materials science.
4. **Research**: Conducting research on the influence of crystal symmetry on physical and chemical properties, and exploring new methodologies for classifying and predicting crystal structures.

