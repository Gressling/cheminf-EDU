<?php
include 'config.php';

if (isset($_POST['selectedProperty']) && isset($_POST['newPropertyValue']) && isset($_POST['moleculeId'])) {
    $selectedProperty = $_POST['selectedProperty'];
    $newPropertyValue = $_POST['newPropertyValue'];
    $moleculeId = $_POST['moleculeId'];

    try {
        // Check if the property exists in the table for the specific molecule
        $stmtCheckProperty = $conn->prepare("
            SELECT COUNT(*) as count
            FROM i9_moleculeproperties
            WHERE MoleculeID = :moleculeId
            AND PropertyID IN (SELECT PropertyID FROM i9_properties WHERE PropertyName = :propertyName)
        ");
        $stmtCheckProperty->bindParam(':moleculeId', $moleculeId);
        $stmtCheckProperty->bindParam(':propertyName', $selectedProperty);
        $stmtCheckProperty->execute();

        $propertyCount = $stmtCheckProperty->fetch(PDO::FETCH_ASSOC)['count'];

        if ($propertyCount > 0) {
            // SQL Update
            $stmtUpdate = $conn->prepare("UPDATE i9_moleculeproperties SET Value = :newValue WHERE MoleculeID = :moleculeId AND PropertyID IN (SELECT PropertyID FROM i9_properties WHERE PropertyName = :propertyName)");
            $stmtUpdate->bindParam(':newValue', $newPropertyValue);
            $stmtUpdate->bindParam(':moleculeId', $moleculeId);
            $stmtUpdate->bindParam(':propertyName', $selectedProperty);
            $stmtUpdate->execute();

            echo "Property Updated: " . $selectedProperty . " - New Value: " . $newPropertyValue;
        } else {
            echo "Error: Property not found for the selected molecule.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Incomplete data.";
}

$conn = null;
?>

