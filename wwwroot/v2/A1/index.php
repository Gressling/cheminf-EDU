<?php
// 引入验证页面
require '../auth.php';

$config = include('../config.php');

$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// Start the session
session_start();

// to store messages
$message = '';

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize or retrieve the currently selected table
if (isset($_POST['table'])) {
    if (in_array($_POST['table'], ['a1_experiments', 'a1_reacts', 'a1_results'])) {
        $_SESSION['tableSelected'] = $_POST['table'];
    } else {
        unset($_SESSION['tableSelected']);
    }
}
$tableSelected = isset($_SESSION['tableSelected']) ? $_SESSION['tableSelected'] : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST['reload'])) {
    if ($tableSelected) {
        $sql = "SELECT * FROM " . $tableSelected;
        $result = $conn->query($sql);

        if ($result) {
            $showAllResults = "<div class='table-container'><table border='1'><tr>";

            if ($tableSelected == 'a1_experiments') {
                $showAllResults .= "<th>Number</th><th>Workflow_ID</th><th>CreateDate</th><th>Cost</th><th>Purpose</th><th>FKEY_USER</th>";
            } elseif ($tableSelected == 'a1_reacts') {
                $showAllResults .= "<th>MoleculeID</th><th>ExperimentID</th><th>Recipe_amount</th>";
            } elseif ($tableSelected == 'a1_results') {
                $showAllResults .= "<th>ExperimentNumber</th><th>Weight</th><th>Yield</th><th>SampleDesc</th><th>QualityTest</th><th>Spectrum_ID</th>";
            }

            $showAllResults .= "</tr>";

            while ($row = $result->fetch_assoc()) {
                $showAllResults .= "<tr>";
                foreach ($row as $value) {
                    $showAllResults .= "<td>" . htmlspecialchars($value) . "</td>";
                }
                $showAllResults .= "</tr>";
            }
            $showAllResults .= "</table></div>";
        } else {
            $message = "Error retrieving records: " . $conn->error;
        }
    }

    // Handle the update request
    if (isset($_POST['update'])) {
        $tableToUpdate = $_POST['table_to_update'];

        if ($tableToUpdate == 'a1_experiments') {
            $number = $_POST['Number'];
            $attribute = $_POST['attribute'];
            $newValue = $_POST['newValue'];

            $sql = "UPDATE a1_experiments SET $attribute = ? WHERE Number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newValue, $number);
        } elseif ($tableToUpdate == 'a1_reacts') {
            $experimentID = $_POST['ExperimentID'];
            $moleculeID = $_POST['MoleculeID'];
            $newRecipeAmount = $_POST['new_Recipe_amount'];

            $sql = "UPDATE a1_reacts SET Recipe_amount = ? WHERE ExperimentID = ? AND MoleculeID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dii", $newRecipeAmount, $experimentID, $moleculeID);
        } elseif ($tableToUpdate == 'a1_results') {
            $experimentNumber = $_POST['ExperimentNumber'];
            $attribute = $_POST['attribute'];
            $newValue = $_POST['newValue'];

            $sql = "UPDATE a1_results SET $attribute = ? WHERE ExperimentNumber = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newValue, $experimentNumber);
        }

        if ($stmt) {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $message = "Record updated successfully.";
            } else {
                $message = "Error updating record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    }

    if (isset($_POST['insert'])) {
        $table = $_POST['table_to_insert'];
        switch ($table) {
            case 'a1_experiments':
                $number = $_POST['Number'];
                $workflowID = $_POST['Workflow_ID'];
                $createDate = $_POST['CreateDate'];
                $cost = $_POST['Cost'];
                $purpose = $_POST['Purpose'];
                $fkeyUser = $_POST['FKEY_USER'];

                $stmt = $conn->prepare("INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, Purpose, FKEY_USER) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iisdsi", $number, $workflowID, $createDate, $cost, $purpose, $fkeyUser);
                break;
            case 'a1_reacts':
                $moleculeID = $_POST['MoleculeID'];
                $experimentID = $_POST['ExperimentID'];
                $recipeAmount =  $_POST['Recipe_amount'];

                $stmt = $conn->prepare("INSERT INTO a1_reacts (MoleculeID, ExperimentID, Recipe_amount) VALUES (?, ?, ?)");
                $stmt->bind_param("iid", $moleculeID, $experimentID, $recipeAmount);
                break;
            case 'a1_results':
                $experimentID = $_POST['ExperimentID'];
                $weight = $_POST['Weight'];
                $yield = $_POST['Yield'];
                $sampleDesc = $_POST['SampleDesc'];
                $qualityTest = $_POST['QualityTest'];
                $spectrumID = $_POST['Spectrum_ID'];

                $stmt = $conn->prepare("INSERT INTO a1_results (ExperimentNumber, Weight, Yield, SampleDesc, QualityTest, Spectrum_ID) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("idisii", $experimentID, $weight, $yield, $sampleDesc, $qualityTest, $spectrumID);
                break;
        }
        if ($stmt) {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $message = "Record inserted successfully.";
            } else {
                $message = "Error inserting record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    }

    // Handle search
    if (isset($_POST['search'])) {
        $table = $_POST['table_to_search'];
        $search_column = $_POST['search_column'];
        $search_value = $_POST['search_value'];

        if ($search_column == 'Purpose') {
            $sql = "SELECT * FROM $table WHERE $search_column LIKE ?";
            $stmt = $conn->prepare($sql);
            $search_value = "%" . $search_value . "%"; // Use wildcard for LIKE
            $stmt->bind_param("s", $search_value);
        } else {
            $sql = "SELECT * FROM $table WHERE $search_column = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $search_value);
        }

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $searchResults = "<div class='table-container'><table border='1'><tr>";

        if ($table == 'a1_experiments') {
            $searchResults .= "<th>Number</th><th>Workflow_ID</th><th>CreateDate</th><th>Cost</th><th>Purpose</th><th>FKEY_USER</th>";
        } elseif ($table == 'a1_reacts') {
            $searchResults .= "<th>MoleculeID</th><th>ExperimentID</th><th>Recipe_amount</th>";
        } elseif ($table == 'a1_results') {
            $searchResults .= "<th>ExperimentNumber</th><th>Weight</th><th>Yield</th><th>SampleDesc</th><th>QualityTest</th><th>Spectrum_ID</th>";
        }

        $searchResults .= "</tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults .= "<tr>";
                foreach ($row as $value) {
                    $searchResults .= "<td>" . htmlspecialchars($value) . "</td>";
                }
                $searchResults .= "</tr>";
            }
        } else {
            $searchResults .= "<tr><td colspan='5'>No results found.</td></tr>";
        }

        $searchResults .= "</table></div>";
        $stmt->close();
    }

    // Handle delete
    if (isset($_POST['delete'])) {
        $table = $_POST['table_to_delete'];

        if ($table == 'a1_experiments') {
            $number = $_POST['Number'];
            $sql = "DELETE FROM a1_experiments WHERE Number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $number);
        } elseif ($table == 'a1_reacts') {
            $moleculeID = $_POST['MoleculeID'];
            $experimentID = $_POST['ExperimentID'];
            $sql = "DELETE FROM a1_reacts WHERE MoleculeID = ? AND ExperimentID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $moleculeID, $experimentID);
        } elseif ($table == 'a1_results') {
            $experimentNumber = $_POST['ExperimentNumber'];
            $sql = "DELETE FROM a1_results WHERE ExperimentNumber = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $experimentNumber);
        }

        if ($stmt) {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $message = "Record deleted successfully.";
            } else {
                $message = "Error deleting record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table-container { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Database Management</h1>
    <form method="post">
        <label for="table">Select Table:</label>
        <select name="table" id="table">
            <option value="a1_experiments" <?php if ($tableSelected == 'a1_experiments') echo 'selected'; ?>>Experiments</option>
            <option value="a1_reacts" <?php if ($tableSelected == 'a1_reacts') echo 'selected'; ?>>Reacts</option>
            <option value="a1_results" <?php if ($tableSelected == 'a1_results') echo 'selected'; ?>>Results</option>
        </select>
        <button type="submit">Select</button>
    </form>

    <?php if ($message): ?>
        <div style="color: red;"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($tableSelected): ?>
        <h2>Records in <?php echo htmlspecialchars($tableSelected); ?></h2>
        <form method="post">
            <input type="hidden" name="table_to_update" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <label for="attribute">Attribute:</label>
            <input type="text" name="attribute" required>
            <label for="newValue">New Value:</label>
            <input type="text" name="newValue" required>
            <label for="Number">Number:</label>
            <input type="number" name="Number" required>
            <button type="submit" name="update">Update Record</button>
        </form>
        
        <form method="post">
            <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <label for="insertValues">Insert New Record:</label>
            <input type="text" name="insertValues" placeholder="Comma-separated values" required>
            <button type="submit" name="insert">Insert Record</button>
        </form>

        <form method="post">
            <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <label for="Number">Number:</label>
            <input type="number" name="Number" required>
            <button type="submit" name="delete">Delete Record</button>
        </form>

        <?php if (isset($showAllResults)): ?>
            <?php echo $showAllResults; ?>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="table_to_search" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <label for="search_column">Search Column:</label>
            <input type="text" name="search_column" required>
            <label for="search_value">Search Value:</label>
            <input type="text" name="search_value" required>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (isset($searchResults)): ?>
            <?php echo $searchResults; ?>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
