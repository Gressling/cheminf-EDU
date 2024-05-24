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