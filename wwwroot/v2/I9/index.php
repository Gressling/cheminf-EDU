<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I9 Molecule Properties</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result, .update-property, .add-new-property-container {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>I9 Molecule Properties</h1>

<!-- Molecule Search-->
<label for="molecule_search">Molecule</label>
<input type="text" name="molecule_search" id="molecule_search" placeholder="Enter your molecule ID">
<button onclick="searchMolecule()">Search Molecule</button>

<!-- Property Input-->
<label for="property_input">Property</label>
<select name="property_input" id="property_input">
    <option value="">Select Property</option>
    <?php
    require '../auth.php';
    include 'config.php';

    try {
        $stmtProperties = $conn->prepare("SELECT PropertyName FROM i9_properties");
        $stmtProperties->execute();

        while ($rowProperty = $stmtProperties->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$rowProperty['PropertyName']}'>{$rowProperty['PropertyName']}</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</select>
<button onclick="addProperty()">Edit Property</button>

<!-- Molecule Results -->
<div class="result" id="searchResult">
    <h2>Results</h2>
    <table id="moleculeResultsTable">
        <thead>
            <tr>
                <th>Property Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody id="moleculeResults"></tbody>
    </table>
</div>

<!-- Edit Property Form -->
<div class="update-property" style="display:none;">
    <label for="newPropertyValue">New Property Value:</label>
    <input type="text" name="newPropertyValue" id="newPropertyValue" placeholder="Enter new value">
    <button onclick="updateProperty()">Update Property</button>
</div>
<!-- Add New Property Button -->
<div class="add-new-property-container" style="display:none;">
    <button onclick="addNewProperty()">Add New Property</button>
</div>

<script>
    function addProperty() {
        var selectedProperty = document.getElementById('property_input').value;
        var moleculeId = document.getElementById('molecule_search').value;

        // Check if a molecule has been searched
        if (!moleculeId) {
            alert('Please first search for a molecule you would like to edit.');
            return;
        }
        // After choosing PropertyName, show Edit Property form
        document.querySelector('.update-property').style.display = 'block';
        document.querySelector('.add-new-property-container').style.display = 'block';

        document.getElementById('newPropertyValue').placeholder = 'Edit ' + selectedProperty;
    }

    function updateProperty() {
        var selectedProperty = document.getElementById('property_input').value;
        var newPropertyValue = document.getElementById('newPropertyValue').value;
        var moleculeId = document.getElementById("molecule_search").value;

        if (selectedProperty && newPropertyValue !== '') {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);

                    // Refresh and hide the form after updating
                    document.getElementById('newPropertyValue').value = '';
                    document.querySelector('.update-property').style.display = 'none';
                    // Search again for Molecule ID (Refresh the table)
                    var moleculeId = document.getElementById("molecule_search").value;
                    searchMolecule(moleculeId);
                }
            };

            xhr.open("POST", "update_property.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(
                "moleculeId=" + moleculeId +
                "&selectedProperty=" + selectedProperty +
                "&newPropertyValue=" + newPropertyValue
            );
        } else {
            alert('Please select a property and enter a new value.');
        }
    }

    function addNewProperty() {
        var moleculeId = document.getElementById("molecule_search").value;
        var selectedProperty = document.getElementById("property_input").value;
        var newPropertyValue = document.getElementById("newPropertyValue").value;

        if (moleculeId && selectedProperty && newPropertyValue !== "") {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    searchMolecule(moleculeId);
                }
            };

            xhr.open("POST", "add_property.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(
                "moleculeId=" + moleculeId +
                "&selectedProperty=" + selectedProperty +
                "&newPropertyValue=" + newPropertyValue
            );
        } else {
            alert("Please select a property and enter a new value.");
        }
    }

    function searchMolecule() {
        var moleculeId = document.getElementById("molecule_search").value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var resultContainer = document.getElementById("moleculeResults");
                resultContainer.innerHTML = this.responseText;
                // Hide the Add New Property button initially
                document.querySelector('.add-new-property-container').style.display = 'none';
                // Show the Edit Property form after search results are displayed
                document.querySelector('.update-property').style.display = 'none';
            }
        };

        xhr.open("GET", "get_molecule_results.php?moleculeId=" + moleculeId, true);
        xhr.send();
    }
</script>
</body>
</html>
