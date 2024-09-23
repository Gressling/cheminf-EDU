<?php
include 'config.php';

if (isset($_GET['moleculeId'])) {
    $moleculeId = filter_input(INPUT_GET, 'moleculeId', FILTER_SANITIZE_NUMBER_INT);

    try {
        // Prepare the SQL statement to fetch molecule properties
        $stmtProperties = $conn->prepare("
            SELECT i9_properties.PropertyName, i9_moleculeproperties.Value, i9_properties.UnitMeasurement
            FROM i9_moleculeproperties
            JOIN i9_properties ON i9_moleculeproperties.PropertyID = i9_properties.PropertyID
            WHERE i9_moleculeproperties.MoleculeID = :moleculeId
        ");
        $stmtProperties->bindParam(':moleculeId', $moleculeId, PDO::PARAM_INT);
        $stmtProperties->execute();

        // Start outputting table rows
        $response = '';
        while ($rowProperties = $stmtProperties->fetch(PDO::FETCH_ASSOC)) {
            $response .= "<tr>";
            $response .= "<td>" . htmlspecialchars($rowProperties['PropertyName']) . "</td>";
            $response .= "<td>" . htmlspecialchars($rowProperties['Value']) . " " . htmlspecialchars($rowProperties['UnitMeasurement']) . "</td>";
            $response .= "</tr>";
        }

        // Output the rows
        echo $response;

    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        echo "Error: Something went wrong. Please try again later.";
    }
}

$conn = null;
?>
