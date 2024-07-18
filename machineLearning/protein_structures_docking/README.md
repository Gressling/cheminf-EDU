# Protein structures docking
 

The dataset contains 31 entries with information on protein structure docking. The data is organized into several columns:

1. **id**: A unique identifier for each entry.
2. **protein_id**: An identifier for the protein.
3. **ligand_id**: An identifier for the ligand.
4. **protein_HELM**: The HELM notation (Hierarchical Editing Language for Macromolecules) of the protein.
5. **ligand_HELM**: The HELM notation of the ligand.
6. **affinity**: The binding affinity between the protein and ligand.
7. **resolution**: The resolution of the structure.
8. **pdb_code**: The PDB code (Protein Data Bank), which refers to the specific structure.
9. **classification**: The classification of the protein.
10. **source**: The source of the data (all entries are from simulated data).

Here is a summarized overview, for details see notebook:

- **Number of entries**: 31
- **Protein classifications**: 
  - Enzyme: 11 entries (35.5%)
  - Receptor: 11 entries (35.5%)
  - Transport: 9 entries (29.0%)
  
- **Affinity**:
  - Lowest value: 3.8
  - Highest value: 7.3
  - Mean value: 5.54

- **Resolution**:
  - Lowest value: 1.7
  - Highest value: 2.5
  - Mean value: 2.06

- **PDB codes**: All entries have unique PDB codes, indicating unique structures.

The data provides a comprehensive overview of simulated protein structure docking with detailed molecular information and structural resolutions.


**What are my features, what do I want to predict?**

 **binding affinity -->** protein_HELM, ligand_HELM, resolution, classification

 The binding affinity between a protein and a ligand depends on factors such as the molecular structures represented by the HELM notations, the resolution of the structure providing details on their interaction, and the protein classification influencing their binding mechanisms. These features collectively impact the strength of the protein-ligand interaction and can be used to predict binding affinity.

**classification -->** protein_HELM, ligand_HELM, affinity, resolution
 
In order to predict the classification of proteins, one can utilize features such as the molecular structures denoted by the HELM notations, binding affinity values, resolution of protein-ligand complexes, and the data source. By incorporating these features into a machine learning model, one can effectively forecast the protein classification based on the structural and molecular attributes present in the dataset.