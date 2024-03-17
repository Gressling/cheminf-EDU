<?php
include 'config.php';

if (isset($_POST['moleculeId']) && isset($_POST['selectedProperty']) && isset($_POST['newPropertyValue'])) {
    $moleculeId = $_POST['moleculeId'];
    $selectedProperty = $_POST['selectedProperty'];
    $newPropertyValue = $_POST['newPropertyValue'];

    try {
        // Check if the property already exists for the molecule
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
            echo "Error: This property already exists for the selected molecule.";
        } else {
            // Get Property ID based on PropertyName
            $stmtGetPropertyId = $conn->prepare("SELECT PropertyID FROM i9_properties WHERE PropertyName = :propertyName");
            $stmtGetPropertyId->bindParam(':propertyName', $selectedProperty);
            $stmtGetPropertyId->execute();

            if ($rowPropertyId = $stmtGetPropertyId->fetch(PDO::FETCH_ASSOC)) {
                $propertyId = $rowPropertyId['PropertyID'];

                // Insert new property into i9_moleculeproperties
                $stmtInsertProperty = $conn->prepare("INSERT INTO i9_moleculeproperties (MoleculeID, PropertyID, Value) VALUES (:moleculeId, :propertyId, :newValue)");
                $stmtInsertProperty->bindParam(':moleculeId', $moleculeId);
                $stmtInsertProperty->bindParam(':propertyId', $propertyId);
                $stmtInsertProperty->bindParam(':newValue', $newPropertyValue);
                $stmtInsertProperty->execute();

                echo "New Property Added: " . $selectedProperty . " - Value: " . $newPropertyValue;
            } else {
                echo "Error: Property not found.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Incomplete data.";
}

$conn = null;
?>
