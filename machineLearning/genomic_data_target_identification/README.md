# Genomic Data Dataset

## Overview

This project focuses on analyzing a genomic dataset to identify potential drug targets. The dataset represents a snapshot of genomic data for a set of genes, which is vital for researchers and bioinformaticians aiming to understand various aspects of gene function and expression. The ultimate goal is to leverage this data to facilitate drug discovery and development by pinpointing specific genes that could serve as drug targets.

## Dataset Description
The dataset contains the following columns:

- gene_id: A unique identifier for each gene, crucial for tracking and referencing specific genes across various databases and studies.
- gene_name: The name of the gene, providing a more intuitive understanding of the gene's identity and function.
- chromosome: The chromosome on which the gene is located, which is essential for understanding the gene's genomic context.
- start_position: The starting position on the chromosome where the gene is located. This positional data is vital for mapping the gene's precise location.
- end_position: The ending position on the chromosome where the gene is located, complementing the start position for accurate genomic mapping.
- strand: The strand of DNA on which the gene is found (+ for forward strand, - for reverse strand). This indicates the direction of transcription and is critical for understanding gene regulation mechanisms.
- gene_expression: The level of gene expression, which reflects how actively a gene is being transcribed into RNA and translated into protein.
- drug_target: Indicates whether the gene is a target for drug development (1 for yes, 0 for no). This is the main focus of this project, as identifying new drug targets is key to developing innovative therapies.

These are the *features* the dataset provides. 

#### What's to predict?

In this project, the main objective is to predict the value of the ``drug_target`` feature. This feature indicates whether a particular gene is a target for drug development, with 1 representing a gene that is identified as a potential drug target and 0 representing a gene that is not considered a drug target. The prediction task involves analyzing various genomic features of the genes to accurately determine their potential as drug targets. By predicting the ``drug_target`` value, researchers can focus on genes that are more likely to be viable candidates for drug development, thus streamlining the drug discovery process and potentially leading to the development of new and effective therapies. 


### Data Snapshot

This dataset represents a snapshot of genomic data for a set of genes. Researchers or bioinformaticians might use this data to analyze various aspects of gene function and expression. Below are the first five entries of the dataset:

| gene_id | gene_name | chromosome | start_position | end_position | strand | gene_expression | drug_target |
|---------|-----------|------------|----------------|--------------|--------|-----------------|-------------|
| 1       | GeneA     | Chr1       | 1000           | 2000         | +      | 0.8             | 1           |
| 2       | GeneB     | Chr2       | 3000           | 4000         | -      | 0.6             | 0           |
| 3       | GeneC     | Chr3       | 5000           | 6000         | +      | 0.9             | 1           |
| 4       | GeneD     | Chr4       | 7000           | 8000         | -      | 0.3             | 0           |
| 5       | GeneE     | Chr5       | 9000           | 10000         | +      | 0.7             | 1           |


## What the Data Represents

This dataset is useful for various types of genomic analysis, including:

#### Gene Expression Analysis
Gene expression analysis involves examining the gene_expression values to determine the activity level of different genes. High expression levels might indicate genes that play critical roles in cellular functions, while low expression levels could point to genes with more specialized or less active roles. By understanding which genes are highly expressed, researchers can infer their importance in various biological processes and potentially link them to diseases.

#### Chromosomal Mapping
The ´start_position´ and ´end_position´ columns provide detailed information about the gene's location on a chromosome. Chromosomal mapping is fundamental in genetic research, allowing scientists to:

- Identify regions associated with specific traits or diseases.
- Study gene clusters and their regulatory elements.
- Understand the structural organization of the genome.
- Locate genes in relation to known genetic markers or variants.

Mapping genes accurately is crucial for comparative genomics, evolutionary studies, and for identifying potential chromosomal abnormalities.

#### Drug Target Identification
The drug_target column is the **centerpiece of this project**. This column flags genes that are potential targets for drug development. Identifying drug targets involves several steps:

- Disease Association: Linking genes to diseases or conditions where modulation of gene activity can have therapeutic effects.
- Biological Function: Understanding the role of the gene in normal and diseased states to predict the impact of targeting it.
- Feasibility: Assessing whether the gene product (usually a protein) can be effectively targeted with drugs (e.g., small molecules, antibodies). 

#### Importance in Pharmaceutical Research
Identifying new drug targets is a critical step in the drug discovery process. Once a potential target is identified, it can lead to the development of compounds that specifically interact with the target to modulate its activity. This process includes:

- Target Validation: Experimentally confirming that the target is directly involved in the disease process.
- Lead Compound Identification: Finding molecules that interact with the target in a desirable way.
- Optimization: Refining these molecules to improve their efficacy, safety, and pharmacokinetic properties.

The ability to systematically analyze genomic data to identify new drug targets can significantly accelerate the development of new therapies, especially for complex diseases where current treatments are insufficient.

## Example Insights

#### Gene Expression Patterns
Genes with high expression values, such as GeneC (0.9) and GeneA (0.8), might be of particular interest for further study, as they are more actively transcribed.

#### Drug Development
Genes marked as drug targets (`drug_target = 1`) such as GeneA, GeneC, and GeneE, could be investigated further for their potential in developing new drugs.

#### Strand Information
Knowing the strand information (`+` or `-`) is useful in understanding the direction of transcription and can affect how genes are regulated and expressed.


## How to use

- To run this project, make sure to create the necessary _.env_ file in the **db** folder. Check the README.md there for clarification.
- Once created, make sure to install all necessary libraries. For this, use ```pip install -r requirements.txt```
- Then, simply run ```python genomic_target_identification.py``` to start. 
- You can adjust the hyperparameters in the ```if __name__ == "__main__":``` part. An argument-parser might be following.
- If you want to use optimal hyperparameters, run the *hyperparameter_tuning.py* file and check out the results.