# Chemical Safety Data

## Overview

This repository contains a dataset aimed at identifying hazards in various chemical substances. The primary goal of this dataset is to provide comprehensive data on chemical hazards, including toxicity, flammability, reactivity, and environmental impact. This information is crucial for ensuring safety in chemical handling, storage, and transportation, as well as for regulatory compliance and risk assessment.

The dataset includes detailed information on chemical properties, safety data sheets (SDS), and hazard classifications. By analyzing this data, researchers and safety professionals can better understand the risks associated with different chemicals and implement appropriate safety measures to protect workers, the public, and the environment.

## Hazard Identification: An Overview

### Definition and Importance

Hazard identification is the process of recognizing that a hazard exists and defining its characteristics. In the context of chemical safety, a hazard is any source of potential damage, harm, or adverse health effects on something or someone. The identification of hazards is a critical step in risk assessment and management, as it helps in preventing accidents and ensuring a safe working environment.

### Dataset Contents

The dataset includes the following key information for each chemical substance:

- **Chemical Name**: The common name of the chemical.
- **CAS Number**: The unique numerical identifier assigned by the Chemical Abstracts Service.
- **Molecular Formula**: The chemical formula indicating the types and numbers of atoms present.
- **Physical Properties**: Data on boiling point, melting point, density, etc.
- **Toxicity Data**: Information on acute and chronic toxicity.
- **Flammability**: Data on flash point, autoignition temperature, etc.
- **Reactivity**: Information on chemical reactivity and stability.
- **Environmental Impact**: Data on biodegradability, bioaccumulation, and ecotoxicity.
- **Safety Data Sheets (SDS)**: Comprehensive safety information as per regulatory standards.
- **Hazard Classifications**: GHS (Globally Harmonized System) hazard classifications, including pictograms and hazard statements.

### Example Data

Below are the first 5 rows of the dataset as an example:

| ID | Chemical_Name | CAS_Number | Physical_State | Chemical_Family | Toxicity_Level | Flammability_Level | Reactivity_Level | Special_Hazard | Data_Source | Label_Class |
|----|---------------|------------|----------------|-----------------|----------------|--------------------|------------------|----------------|-------------|-------------|
| 1  | Chemical A    | 75-07-0    | Solid          | Acid            | Medium         | None               | Highly Reactive  | Irritant       | Source A    | 2           |
| 2  | Chemical B    | 75-07-0    | Liquid         | Ester           | High           | Low                | Highly Reactive  | Irritant       | Source A    | 0           |
| 3  | Chemical A    | 75-07-0    | Gas            | Acid            | Medium         | Low                | Stable           | Explosive      | Source B    | 1           |
| 4  | Chemical B    | 64-17-5    | Gas            | Acid            | Medium         | Low                | Highly Reactive  | Corrosive      | Source A    | 2           |
| 5  | Chemical B    | 64-17-5    | Liquid         | Acid            | Medium         | High               | Unstable         | Explosive      | Source A    | 1           |

## Data Visualization

The dataset has been visualized using various plots to aid in the analysis and understanding of chemical hazards. The notebook `statistical_overview.ipynb` contains detailed plots and statistical analysis of the dataset, such as box plots showing the distribution of physical and chemical properties.

## Usage

This dataset can be used for:

- Conducting hazard identification and risk assessments for chemical substances.
- Developing safety protocols and guidelines for chemical handling and storage.
- Regulatory compliance and reporting for chemical safety.
- Building predictive models for chemical hazards based on physical and chemical properties.
- Educational purposes in chemistry and safety training programs.

## References and Further Reading

- [ToxNet Data](https://pubchem.ncbi.nlm.nih.gov/docs/toxnet)
- [Occupational Safety and Health Administration (OSHA)](https://www.osha.gov/chemical-hazards/)

## Notes

- This dataset is intended for research and educational purposes only.
