<?php
include 'config.php';

if (isset($_POST['moleculeId']) && isset($_POST['selectedProperty']) && isset($_POST['newPropertyValue'])) {
    $moleculeId = filter_input(INPUT_POST, 'moleculeId', FILTER_SANITIZE_NUMBER_INT);
    $selectedProperty = filter_input(INPUT_POST, 'selectedProperty', FILTER_SANITIZE_STRING);
    $newPropertyValue = filter_input(INPUT_POST, 'newPropertyValue', FILTER_SANITIZE_STRING);

    try {
        // Check if the property already exists for the molecule
        $stmtCheckProperty = $conn->prepare("
            SELECT COUNT(*) as count
            FROM i9_moleculeproperties
            WHERE MoleculeID = :moleculeId
            AND PropertyID IN (SELECT PropertyID FROM i9_properties WHERE PropertyName = :propertyName)
        ");
        $stmtCheckProperty->bindParam(':moleculeId', $moleculeId, PDO::PARAM_INT);
        $stmtCheckProperty->bindParam(':propertyName', $selectedProperty, PDO::PARAM_STR);
        $stmtCheckProperty->execute();

        $propertyCount = $stmtCheckProperty->fetch(PDO::FETCH_ASSOC)['count'];

        if ($propertyCount > 0) {
            echo "Error: This property already exists for the selected molecule.";
        } else {
            // Get Property ID based on PropertyName
            $stmtGetPropertyId = $conn->prepare("SELECT PropertyID FROM i9_properties WHERE PropertyName = :propertyName");
            $stmtGetPropertyId->bindParam(':propertyName', $selectedProperty, PDO::PARAM_STR);
            $stmtGetPropertyId->execute();

            if ($rowPropertyId = $stmtGetPropertyId->fetch(PDO::FETCH_ASSOC)) {
                $propertyId = $rowPropertyId['PropertyID'];

                // Insert new property into i9_moleculeproperties
                $stmtInsertProperty = $conn->prepare("INSERT INTO i9_moleculeproperties (MoleculeID, PropertyID, Value) VALUES (:moleculeId, :propertyId, :newValue)");
                $stmtInsertProperty->bindParam(':moleculeId', $moleculeId, PDO::PARAM_INT);
                $stmtInsertProperty->bindParam(':propertyId', $propertyId, PDO::PARAM_INT);
                $stmtInsertProperty->bindParam(':newValue', $newPropertyValue, PDO::PARAM_STR);
                $stmtInsertProperty->execute();

                echo "New Property Added: " . htmlspecialchars($selectedProperty) . " - Value: " . htmlspecialchars($newPropertyValue);
            } else {
                echo "Error: Property not found.";
            }
        }
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        echo "Error: Something went wrong. Please try again later.";
    }
} else {
    echo "Error: Incomplete data.";
}

$conn = null;
?>

