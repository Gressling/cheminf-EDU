<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Inventory Database</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        td {
            background-color: #f2f2f2;
        }
        th {
            background-color: #f2f2f2;
        }
        caption {
            text-align: left;
            font-weight: bold;
            font-size: 25px;
        }
        .action-buttons {
            margin-top: 15px;
        }
        .action-buttons input {
            margin-right: 10px;
        }
        .form-inline {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .form-inline label {
            margin-right: 10px;
        }
        .form-inline input[type="text"] {
            margin-right: 10px;
        }
        #editSection, #inventoryTable {
            display: none; /* Initially hide the edit section and inventory table */
        }
    </style>
    <script>
        function toggleTable(display) {
            document.getElementById('inventoryTable').style.display = display ? 'block' : 'none';
        }
    </script>
</head>
<body id="page_body">
    <div class="row" id="pagetitle">
        <div class="col-md-12">
            <h1>Inventory Database</h1>
        </div>
    </div>

    <!-- Form to input ID and fetch the record -->
    <div class="form-inline">
        <form method="post" action="">
            <label for="update_id">Enter ID to Update:</label>
            <input type="text" name="update_id" id="update_id" value="<?php echo isset($_POST['update_id']) ? htmlspecialchars($_POST['update_id']) : ''; ?>" required />
            <input type="submit" value="Fetch Record" />
        </form>
    </div>

    <!-- Form for selecting the table -->
    <form method="post" action="">
        <input type="submit" name="show_inventory" value="Inventory" onclick="toggleTable(true); return false;" />
        <input type="button" value="Hide" onclick="toggleTable(false);" />
    </form>

    <?php
    require '../auth.php';
    // Database connection details
    $host = "den1.mysql6.gear.host";
    $dbname = "situation"; // Database name
    $username = "situation"; // Database username
    $password = "aichem567."; // Database password

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle the show inventory button to display the table
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_inventory'])) {
        $query = "SELECT * FROM h8_chemical_inventory_usage";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div id='inventoryTable' class='row'>";
            echo "<div class='col-md-12'>";
            echo "<table>";
            echo "<caption>Inventory Table</caption>";
            echo "<tr><th>ID</th><th>Quantity Used</th><th>Unit</th><th>Usage Location</th><th>Chemical Name</th><th>CAS</th><th>Reason</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table></div></div>";

            echo "<script>document.getElementById('inventoryTable').style.display = 'block';</script>";
        } else {
            echo "<p>No inventory records found.</p>";
        }
    }

    // Handle the update ID submission to fetch the record
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id']) || isset($_POST['edit'])) {
        $id = intval(isset($_POST['update_id']) ? $_POST['update_id'] : $_POST['id']);
        $query = "SELECT * FROM h8_chemical_inventory_usage WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tableHeaders = "<th>ID</th><th>Quantity Used</th><th>Unit</th><th>Usage Location</th><th>Chemical Name</th><th>CAS</th><th>Reason</th>";

            echo "<div id='table' class='row'>";
            echo "<div class='col-md-12'>";
            echo "<table>";
            echo "<caption>Record for ID $id</caption>";
            echo "<tr>$tableHeaders</tr>";
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
            echo "</table></div></div>";

            // Show the edit section below the record
            echo "<div class='form-inline' id='editSection'>";
            echo "<form method='post' action=''>";
            echo "<label for='id'>ID: $id</label>";
            echo "<input type='hidden' name='id' value='$id' />";
            echo "<label for='field'>Select Field to Update:</label>";
            echo "<select name='field'>";
            echo "<option value='Quantity_Used'>Quantity Used</option>";
            echo "<option value='Unit'>Unit</option>";
            echo "<option value='Usage_Location'>Usage Location</option>";
            echo "<option value='Chemical_Name'>Chemical Name</option>";
            echo "<option value='CAS'>CAS</option>";
            echo "<option value='Reason'>Reason</option>";
            echo "</select>";
            echo "<input type='text' name='new_value' placeholder='Enter new value' required />";
            echo "<input type='submit' name='edit' value='Edit' />";
            echo "</form>";
            echo "</div>";

            echo "<script>document.getElementById('editSection').style.display = 'block';</script>";
        } else {
            echo "<p>No record found with ID $id</p>";
        }
        $stmt->close();
    }

    // Handle the edit action to update the record
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
        $id = intval($_POST['id']);
        $field = $_POST['field'];
        $new_value = $_POST['new_value'];

        $allowed_fields = ['Quantity_Used', 'Unit', 'Usage_Location', 'Chemical_Name', 'CAS', 'Reason'];

        if (in_array($field, $allowed_fields)) {
            $query = "UPDATE h8_chemical_inventory_usage SET $field = ? WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_value, $id);

            if ($stmt->execute()) {
                echo "<p>Record updated successfully.</p>";

                // Fetch and display the updated record immediately
                $query = "SELECT * FROM h8_chemical_inventory_usage WHERE ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $tableHeaders = "<th>ID</th><th>Quantity Used</th><th>Unit</th><th>Usage Location</th><th>Chemical Name</th><th>CAS</th><th>Reason</th>";

                    echo "<div id='table' class='row'>";
                    echo "<div class='col-md-12'>";
                    echo "<table>";
                    echo "<caption>Updated Record for ID $id</caption>";
                    echo "<tr>$tableHeaders</tr>";
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                    echo "</table></div></div>";

                    echo "<script>document.getElementById('editSection').style.display = 'block';</script>";
                }
                $stmt->close();
            } else {
                echo "<p>Error updating record: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p>Invalid field selected.</p>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
