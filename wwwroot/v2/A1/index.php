<?php

$connStr = getenv('CUSTOMCONNSTR_strConn');
list($dbhost, $dbname, $dbusername, $dbpassword) = explode(';', $connStr);

// Start the session
session_start();

//to store messages
$message = '';

//Database connection
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

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
    // Fetch and display the table data when the page loads or the reload button is pressed
    if ($tableSelected) {
        $sql = "SELECT * FROM " . $tableSelected;
        $result = $conn->query($sql);

        if ($result) {
            $showAllResults = "<div class='table-container'><table border='1'><tr>";

            // Determine which table we're dealing with and set up headers
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
        // Update for a1_experiments
        $number = $_POST['Number'];
        $attribute = $_POST['attribute'];
        $newValue = $_POST['newValue'];

        $sql = "UPDATE a1_experiments SET $attribute = ? WHERE Number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newValue, $number);

    } elseif ($tableToUpdate == 'a1_reacts') {
        // Update for a1_reacts
        $experimentID = $_POST['ExperimentID'];
        $moleculeID = $_POST['MoleculeID'];
        $newRecipeAmount = $_POST['new_Recipe_amount'];

        $sql = "UPDATE a1_reacts SET Recipe_amount = ? WHERE ExperimentID = ? AND MoleculeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dii", $newRecipeAmount, $experimentID, $moleculeID);

    } elseif ($tableToUpdate == 'a1_results') {
        // Update for a1_results
        $experimentNumber = $_POST['ExperimentNumber'];
        $attribute = $_POST['attribute'];
        $newValue = $_POST['newValue'];

        $sql = "UPDATE a1_results SET $attribute = ? WHERE ExperimentNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newValue, $experimentNumber);
    }

    // Execute the statement
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
    // Prepare an SQL statement based on the table
    switch ($table) {
        case 'a1_experiments':
            $number = $_POST['Number'];
            $workflowID = $_POST['Workflow_ID'];
            $createDate = $_POST['CreateDate'];
            $cost = $_POST['Cost'];
            $purpose = $_POST['Purpose'];
            $fkeyUser = $_POST['FKEY_USER'];

            $sql = "INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, Purpose, FKEY_USER) VALUES ('$number', '$workflowID', '$createDate', '$cost', '$purpose', '$fkeyUser')";

            // Printing the query for debugging
            // $message = "Debug SQL: " . $sql;

            // Prepare and bind parameters as usual
            $stmt = $conn->prepare("INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, Purpose, FKEY_USER) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisdsi", $number, $workflowID, $createDate, $cost, $purpose, $fkeyUser);
            break;
        case 'a1_reacts':
            $moleculeID = $_POST['MoleculeID'];
            $experimentID = $_POST['ExperimentID'];
            $recipeAmount =  $_POST['Recipe_amount'];
            $sql = "INSERT INTO a1_reacts (MoleculeID, ExperimentID, Recipe_amount) VALUES ('$moleculeID', '$experimentID', '$recipeAmount')";

            // Printing the query for debugging
            // $message = "Debug SQL: " . $sql;


            $stmt = $conn->prepare("INSERT INTO a1_reacts (MoleculeID, ExperimentID, Recipe_amount) VALUES (?, ?, ?)");
            $stmt->bind_param("iid", $_POST['MoleculeID'], $_POST['ExperimentID'], $_POST['Recipe_amount']);
            break;
        case 'a1_results':
            $experimentID = $_POST['ExperimentID'];
            $weight = $_POST['Weight'];
            $yield = $_POST['Yield'];
            $sampleDesc = $_POST['SampleDesc'];
            $qualityTest = $_POST['QualityTest'];
            $spectrumID = $_POST['Spectrum_ID'];

            $sql = "INSERT INTO a1_results (ExperimentNumber, Weight, Yield, SampleDesc, QualityTest, Spectrum_ID) VALUES ('$experimentID','$weight','$yield','$sampleDesc','$qualityTest','$spectrumID')";

            // Printing the query for debugging
            // $message = "Debug SQL: " . $sql;

            $stmt = $conn->prepare("INSERT INTO a1_results (ExperimentNumber, Weight, Yield, SampleDesc, QualityTest, Spectrum_ID) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("idisii", $_POST['ExperimentNumber'], $_POST['Weight'], $_POST['Yield'], $_POST['SampleDesc'], $_POST['QualityTest'], $_POST['Spectrum_ID']);
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

    // Check if the table and column are allowed
    //if (in_array($table) && in_array($search_column)) {
        if($search_column = 'Purpose'){
            $sql = "SELECT * FROM $table WHERE $search_column LIKE \"%$search_value%\"";
        }else{
            $sql = "SELECT * FROM $table WHERE $search_column = $search_value";
        }
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("s", $search_value);
        $stmt->execute();
        $result = $stmt->get_result();

        // Start building the HTML table
        $searchResults = "<div class='table-container'><table border='1'><tr>";

        // Add table headers based on the selected table
        // You should modify this part based on your table structure
        if ($table == 'a1_experiments') {
            $searchResults .= "<th>Number</th><th>Workflow_ID</th><th>CreateDate</th><th>Cost</th><th>Purpose</th><th>FKEY_USER</th>";
        } elseif ($table == 'a1_reacts') {
            $searchResults .= "<th>MoleculeID</th><th>ExperimentID</th><th>Recipe_amount</th>";
        } elseif ($table == 'a1_results') {
            $searchResults .= "<th>ExperimentNumber</th><th>Weight</th><th>Yield</th><th>SampleDesc</th><th>QualityTest</th><th>Spectrum_ID</th>";
        }

        $searchResults .= "</tr>";

        if ($result->num_rows > 0) {
            // Fetch each row and add to the table
            while ($row = $result->fetch_assoc()) {
                $searchResults .= "<tr>";
                foreach ($row as $value) {
                    $searchResults .= "<td>" . htmlspecialchars($value) . "</td>";
                }
                $searchResults .= "</tr>";
            }
        } else {
            $searchResults .= "<tr><td colspan='5'>No results found.</td></tr>"; // Adjust the colspan based on the number of columns
        }

        $searchResults .= "</table></div>";
        $stmt->close();
}


  // Handle delete
    if (isset($_POST['delete'])) {
        $table = $_POST['table_to_delete'];

        if ($table == 'a1_experiments' ) {
            $id = $_POST['id'];
            $sql = "DELETE FROM $table WHERE Number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
        }elseif ($table == 'a1_results') {
            $id = $_POST['id'];
            $sql = "DELETE FROM $table WHERE ExperimentNumber = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
        }elseif ($table == 'a1_reacts') {
            $experimentID = $_POST['ExperimentID'];
            $moleculeID = $_POST['MoleculeID'];
            $sql = "DELETE FROM $table WHERE ExperimentID = ? AND MoleculeID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $experimentID, $moleculeID);
        }

        if ($stmt) {
            if ($stmt->execute()) {
                 $message = "Record deleted successfully.";
            } else {
                 $message = "Error deleting record: " . $stmt->error;
            }
            $stmt->close();
        } else {
             $message = "Error preparing statement.";
        }
    }


  }

  $conn->close();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>ELN Experiment</title>
  <link rel="stylesheet" type="text/css" href="../../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
  <body>

  <h1> ELN Experiments</h1>

  <div class="container">
  <div class="sidebar">
        <h2>Tables</h2>
        <form method="post" action="">
            <input type="submit" name="table" value="a1_experiments" class="big-button">
            <input type="submit" name="table" value="a1_reacts" class="big-button">
            <input type="submit" name="table" value="a1_results" class="big-button">
        </form>
    </div>


    <?php if (!empty($tableSelected)): ?>
        <!-- Main content area -->
        <div class="main-content">
        <!-- Reload button form -->
        <form method="post" action="">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <button type="submit" name="reload" class="reload-button"><i class="fas fa-sync-alt"></i></button>
        </form>

        <!-- Display the result of show all operation -->
        <?php if (isset($showAllResults)): ?>
            <?php echo $showAllResults; ?>
        <?php endif; ?>

        <!-- Display the search results -->
        <?php if (isset($searchResults)): ?>
            <?php echo $searchResults; ?>
        <?php endif; ?>

        <!-- Message area -->
        <?php if (!empty($message)): ?>
            <div class="message-area">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($tableSelected == 'a1_experiments'): ?>

            <h2>Update experiments</h2>
            <form method="post" action="">
                <input type="hidden" name="table_to_update" value="a1_experiments">
                Number (to identify row): <input type="text" name="Number" required>
                Select attribute to Update:
                <select name="attribute">
                    <option value="Workflow_ID">Workflow_ID</option>
                    <option value="CreateDate">CreateDate</option>
                    <option value="Cost">Cost</option>
                    <option value="Purpose">Purpose</option>
                    <option value="FKEY_USER">FKEY_USER</option>
                </select>
                New Value: <input type="text" name="newValue">
                <input type="submit" name="update" value="Update" class="small-button">
                </form>

                <h2>Search in experiments</h2>

                <form method="post" action="" class="form-section a1_experiments">
                <input type="hidden" name="table_to_search" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <select name="search_column">
                    <option value="Number">Number</option>
                    <option value="Workflow_ID">Workflow_ID</option>
                    <option value="CreateDate">CreateDate</option>
                    <option value="Cost">Cost</option>
                    <option value="Purpose">Purpose</option>
                    <option value="FKEY_USER">FKEY_USER</option>
                </select>
                <input type="text" name="search_value" placeholder="Value to search for">
                <input type="submit" name="search" value="Search" class="small-button">
                </form>

                <h2>Insert into experiments</h2>
                <!-- Repeat this block for 'a1_reacts' and 'a1_results' with appropriate fields -->
                <form method="post" action="">
                <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
                Number: <input type="text" name="Number" placeholder="Experiment ID">
                Workflow_ID: <input type="text" name="Workflow_ID" placeholder="new Workflow ID">
                CreateDate: <input type="text" name="CreateDate" placeholder="yyyy-mm-dd hh:mm:ss">
                Cost: <input type="text" name="Cost" placeholder="Cost [€]">
                Purpose: <input type="text" name="Purpose" placeholder="Describe the purpose of the experiment">
                FKEY_USER: <input type="text" name="FKEY_USER" placeholder="FKEY_USER">
                <input type="submit" name="insert" value="Insert" class="small-button">
                </form>

                <h2>Delete from experiments</h2>
                <form method="post" action="">
                <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <input type="text" name="id" placeholder="Number to delete">
                <input type="submit" name="delete" value="Delete" class="small-button">
                </form>
        <?php elseif ($tableSelected == 'a1_reacts'): ?>

            <h2>Update reacts</h2>
            <form method="post" action="">
                <input type="hidden" name="table_to_update" value="a1_reacts">
                ExperimentID (to identify the row): <input type="text" name="ExperimentID" placeholder="ExperimentID">
                MoleculeID (to identify the row): <input type="text" name="MoleculeID" placeholder="MoleculeID">
                New Recipe Amount: <input type="text" name="new_Recipe_amount" placeholder="New Recipe Amount">
                <input type="submit" name="update" value="Update" class="small-button">
            </form>

            <h2>Search in reacts</h2>
            <form method="post" action="" class="form-section a1_reacts">
                <input type="hidden" name="table_to_search" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <select name="search_column">
                    <option value="MoleculeID">MoleculeID</option>
                    <option value="ExperimentID">ExperimentID</option>
                    <option value="Recipe_amount">Recipe_amount</option>
                </select>
                <input type="text" name="search_value" placeholder="Value to search for">
                <input type="submit" name="search" value="Search" class="small-button">
                </form>

            <h2>Insert into reacts</h2>
            <form method="post" action="">
            <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
                MoleculeID: <input type="text" name="MoleculeID" placeholder="Molecule ID">
                ExperimentID: <input type="text" name="ExperimentID" placeholder="Experiment ID">
                Recipe_amount: <input type="text" name="Recipe_amount" placeholder="Recipe amount [g]">
                <input type="submit" name="insert" value="Insert" class="small-button">
            </form>

            <h2>Delete from reacts</h2>
            <form method="post" action="">
                <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <input type="text" name="ExperimentID" placeholder="ExperimentID to delete">
                <input type="text" name="MoleculeID" placeholder="MoleculeID to delete">
                <input type="submit" name="delete" value="Delete" class="small-button">
            </form>
        <?php elseif ($tableSelected == 'a1_results'): ?>

            <h2>Update Results</h2>
            <form method="post" action="">
                <input type="hidden" name="table_to_update" value="a1_results">
                ExperimentNumber (to identify the row): <input type="text" name="ExperimentNumber" placeholder="ExperimentNumber">
                Select attribute to Update:
                <select name="attribute">
                    <option value="ExperimentNumber">ExperimentNumber</option>
                    <option value="Weight">Weight</option>
                    <option value="Yield">Yield</option>
                    <option value="SampleDesc">SampleDesc</option>
                    <option value="QualityTest">QualityTest</option>
                    <option value="Spectrum_ID">Spectrum_ID</option>
                </select>
                New Value: <input type="text" name="newValue">
                <input type="submit" name="update" value="Update" class="small-button">
            </form>

            <h2>Search in results</h2>
            <form method="post" action="" class="form-section a1_results">
                <input type="hidden" name="table_to_search" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <select name="search_column">
                    <option value="ExperimentNumber">ExperimentNumber</option>
                    <option value="Weight">Weight</option>
                    <option value="Yield">Yield</option>
                    <option value="SampleDesc">SampleDesc</option>
                    <option value="QualityTest">QualityTest</option>
                    <option value="Spectrum_ID">Spectrum_ID</option>
                </select>
                <input type="text" name="search_value" placeholder="Value to search for">
                <input type="submit" name="search" value="Search" class="small-button">
                </form>

            <h2>Insert into results</h2>
            <form method="post" action="">
            <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
                ExperimentNumber: <input type="text" name="ExperimentNumber" placeholder="Experiment ID">
                Weight: <input type="text" name="Weight" placeholder="Weight [g]">
                Yield: <input type="text" name="Yield" placeholder="Yield [%]">
                SampleDesc: <input type="text" name="SampleDesc" placeholder="SampleDesc">
                QualityTest: <input type="text" name="QualityTest" placeholder="QualityTest [0,1]">
                Spectrum_ID: <input type="text" name="Spectrum_ID" placeholder="Spectrum ID">
                <input type="submit" name="insert" value="Insert" class="small-button">
            </form>

            <h2>Delete from results</h2>
            <form method="post" action="">
                <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
                <input type="text" name="id" placeholder="ExperimentNumber to delete">
                <input type="submit" name="delete" value="Delete" class="small-button">
            </form>
            <?php endif; ?>
            </div>
    <?php endif; ?>

    <div class="links">
        <a href="../index.php">Home</a><br>
        <a href="../logout.php">Logout</a> <!-- Ensure you have a logout.php to handle session destruction -->
    </div>
    <div class="license">MIT Licence - no commercial interest</div>


    </div>

    </body>
    </html>