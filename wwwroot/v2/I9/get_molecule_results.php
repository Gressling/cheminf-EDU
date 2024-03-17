<?php
include 'config.php';

if (isset($_GET['moleculeId'])) {
    $moleculeId = $_GET['moleculeId'];

    try {
        // Molecule ID from Properties
        $stmtProperties = $conn->prepare("
            SELECT i9_moleculeproperties.MoleculeID, i9_properties.PropertyName, i9_moleculeproperties.Value, i9_properties.UnitMeasurement
            FROM i9_moleculeproperties
            JOIN i9_properties ON i9_moleculeproperties.PropertyID = i9_properties.PropertyID
            WHERE i9_moleculeproperties.MoleculeID = :moleculeId
        ");
        $stmtProperties->bindParam(':moleculeId', $moleculeId);
        $stmtProperties->execute();

        // Molecule ID Title
        echo "<h2 style='font-size: 16px;'>Molecule ID: $moleculeId";

        // Molecule Name data from b2_molecules
        $stmtMoleculeName = $conn->prepare("
            SELECT MoleculeName
            FROM b2_molecules
            WHERE MoleculeID = :moleculeId
            LIMIT 1
        ");
        $stmtMoleculeName->bindParam(':moleculeId', $moleculeId);
        $stmtMoleculeName->execute();

        // Print Molecule Name
        if ($rowMoleculeName = $stmtMoleculeName->fetch(PDO::FETCH_ASSOC)) {
            echo " - Molecule Name: " . $rowMoleculeName['MoleculeName'];
        }

        echo "</h2>";

        echo "<table border='1'>";
        echo "<tr><th>Property Name</th><th>Value</th></tr>";

        while ($rowProperties = $stmtProperties->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$rowProperties['PropertyName']}</td>";
            echo "<td>{$rowProperties['Value']} {$rowProperties['UnitMeasurement']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
