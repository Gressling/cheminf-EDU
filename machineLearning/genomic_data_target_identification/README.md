# Genomic Data Dataset

## Overview

This dataset represents a snapshot of genomic data for a set of genes. Researchers or bioinformaticians might use this data to analyze various aspects of gene function and expression. The dataset contains the following columns:

- `gene_id`: A unique identifier for each gene.
- `gene_name`: The name of the gene.
- `chromosome`: The chromosome on which the gene is located.
- `start_position`: The starting position on the chromosome where the gene is located.
- `end_position`: The ending position on the chromosome where the gene is located.
- `strand`: The strand of DNA on which the gene is found (`+` for forward strand, `-` for reverse strand).
- `gene_expression`: The level of gene expression.
- `drug_target`: Indicates whether the gene is a target for drug development (`1` for yes, `0` for no).

## What the Data Represents

This dataset is useful for various types of genomic analysis, including:

#### Gene Expression Analysis
By looking at the `gene_expression` values, researchers can determine which genes are highly expressed and which are not. This can be important in understanding gene function and regulation.

#### Chromosomal Mapping
The `start_position` and `end_position` columns help in mapping the exact location of genes on chromosomes. This can be crucial for genetic studies and for identifying regions of interest in the genome.

#### Drug Target Identification
The `drug_target` column indicates which genes are potential targets for drug development. This is important in pharmaceutical research where identifying new drug targets can lead to the development of new therapies. **This is the main focus of this project**!

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