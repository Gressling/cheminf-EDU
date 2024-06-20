# Examples for AI in Chemistry
 
The provided data consists of two related tables: one defining various properties of molecules and another listing the specific values of these properties for different molecules. Here's a detailed explanation:

### Properties Table
This table describes different properties that can be measured for molecules. Each property has a unique `PropertyID`, a `PropertyName`, and a `UnitMeasurement`.

| PropertyID | PropertyName    | UnitMeasurement |
|------------|------------------|-----------------|
| 1          | Molecular Weight | g/mol           |
| 2          | Polarity         | None            |
| 3          | Solubility       | None            |
| 4          | Melting Point    | °C              |
| 5          | Boiling Point    | °C              |
| 6          | Density          | g/cm^3          |
| 7          | Reactivity       | None            |


1. **Molecular Weight**
   - **Description**: The molecular weight (also called molecular mass) is the sum of the atomic weights of all the atoms in a molecule. It is typically measured in grams per mole (g/mol).
   - **Unit of Measurement**: g/mol

2. **Polarity**
   - **Description**: Polarity refers to the distribution of electric charge around atoms, molecules, or chemical groups. Polar molecules have regions with partial positive and negative charges due to differences in electronegativity between bonded atoms.
   - **Unit of Measurement**: None (qualitative property)

3. **Solubility**
   - **Description**: Solubility is the ability of a substance to dissolve in a solvent, forming a solution. It is usually expressed in terms of the maximum amount of solute that can dissolve in a given amount of solvent at a specific temperature.
   - **Unit of Measurement**: None (qualitative property, though it can be quantified as concentration)

4. **Melting Point**
   - **Description**: The melting point is the temperature at which a solid becomes a liquid. At this temperature, the solid and liquid phases are in equilibrium.
   - **Unit of Measurement**: °C (degrees Celsius)

5. **Boiling Point**
   - **Description**: The boiling point is the temperature at which a liquid turns into vapor. It is the temperature at which the vapor pressure of the liquid equals the external pressure surrounding the liquid.
   - **Unit of Measurement**: °C (degrees Celsius)

6. **Density**
   - **Description**: Density is the mass per unit volume of a substance. It is often used to characterize materials and can vary with temperature and pressure.
   - **Unit of Measurement**: g/cm³ (grams per cubic centimeter)

7. **Reactivity**
   - **Description**: Reactivity describes how readily a substance undergoes a chemical reaction with other substances. It can depend on factors like the substance's chemical structure, the presence of other chemicals, temperature, and pressure.
   - **Unit of Measurement**: None (qualitative property)

These properties help characterize the physical and chemical nature of substances, providing important information for understanding their behavior and interactions in different contexts.

### Molecule Properties Table
This table lists the values of these properties for specific molecules. Each entry is uniquely identified by `MoleculePropertyID`. The table includes the `MoleculeID`, the `PropertyID` corresponding to the `PropertyName` from the first table, and the actual `Value` of the property for the given molecule.

| MoleculePropertyID | MoleculeID | PropertyID | Value   |
|--------------------|------------|------------|---------|
| 1                  | 14         | 1          | 151.16  |
| 2                  | 14         | 2          | 1       |
| 3                  | 14         | 3          | 1       |
| 4                  | 14         | 4          | 1       |
| 5                  | 14         | 5          | 100.00  |
| 6                  | 14         | 6          | 1       |
| 7                  | 14         | 7          | 1       |
| 15                 | 15         | 1          | 151.16  |
| 16                 | 15         | 2          | 2       |
| 17                 | 15         | 3          | 1       |
| 18                 | 15         | 4          | 1       |
| 19                 | 15         | 5          | -161.00 |
| 20                 | 15         | 6          | 1       |
| 21                 | 15         | 7          | 1       |
| 22                 | 10         | 1          | 151.16  |
| 23                 | 10         | 2          | 2       |
| 24                 | 10         | 3          | 1       |
| 25                 | 10         | 4          | 1       |
| 26                 | 10         | 5          | 78.00   |
| 27                 | 10         | 6          | 1       |

### Detailed Breakdown
- **MoleculeID**: Identifies the molecule.
- **PropertyID**: Identifies which property of the molecule is being described (linked to the Properties Table).
- **Value**: The specific value of the property for the molecule.

### Example Entries
1. **First Entry (MoleculePropertyID 1)**
   - **MoleculeID**: 14
   - **PropertyID**: 1 (Molecular Weight)
   - **Value**: 151.16 g/mol

2. **Entry with MoleculeID 15 and PropertyID 5**
   - **MoleculeID**: 15
   - **PropertyID**: 5 (Boiling Point)
   - **Value**: -161.00 °C

This data can be used to look up the properties of various molecules and understand their physical and chemical characteristics. For instance, if you want to know the boiling point of the molecule with `MoleculeID 15`, you find the entry with `PropertyID 5`, which tells you that its boiling point is -161.00 °C.
