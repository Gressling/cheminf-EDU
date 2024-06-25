<?php
include 'config.php';

if (isset($_GET['moleculeId'])) {
    $moleculeId = $_GET['moleculeId'];

    try {
        // Molekül ID'ye göre ilgili Property'leri ve değerlerini al
        $stmt = $conn->prepare("
            SELECT i9_moleculeproperties.MoleculeID, i9_properties.PropertyName, i9_moleculeproperties.Value, i9_properties.UnitMeasurement
            FROM i9_moleculeproperties
            JOIN i9_properties ON i9_moleculeproperties.PropertyID = i9_properties.PropertyID
            WHERE i9_moleculeproperties.MoleculeID = :moleculeId
        ");
        $stmt->bindParam(':moleculeId', $moleculeId);
        $stmt->execute();

        // Molecule ID değerini başlık olarak ekle
        echo "<h2 style='font-size: 16px;'>Molecule ID: $moleculeId</h2>";

        // Sonuçları ekrana yazdır
        echo "<table border='1'>";
        echo "<tr><th>Property Name</th><th>Value</th><th>Unit Measurement</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['PropertyName']}</td>";
            echo "<td>{$row['Value']}</td>";
            echo "<td>{$row['UnitMeasurement']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
