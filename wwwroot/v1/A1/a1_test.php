<?php

//Database access
$dbhost = "den1.mysql6.gear.host";
$dbname = "situation";
$dbusername = "situation";
$dbpassword = "cogni77.";

//Database connection
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    // Variable to store which table's forms to show
    $tableSelected = '';

    // Check which table was selected
    if (isset($_POST['table'])) {
        $tableSelected = $_POST['table'];
    }
  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Depending on which form was submitted, set the table name
    $table = isset($_POST['table']) ? $_POST['table'] : '';

  // Display "Show All" table when a table is selected
if ($tableSelected) {
    $sql = "SELECT * FROM " . $tableSelected;
    $result = $conn->query($sql);

    if ($result) {
        $showAllResults = "<div class='table-container'><table border='1'><tr>";

        // Determine which table we're dealing with and set up headers
        if ($tableSelected == 'a1_experiments') {
            $showAllResults .= "<th>Number</th><th>Workflow_ID</th><th>CreateDate</th><th>Cost</th><th>FKEY_USER</th>";
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


if (isset($_POST['insert'])) {
    $table = $_POST['table_to_insert'];
    // Prepare an SQL statement based on the table
    switch ($table) {
        case 'a1_experiments':
            $number = $_POST['Number'];
            $workflowID = $_POST['Workflow_ID'];
            $createDate = $_POST['CreateDate'];
            $cost = $_POST['Cost'];
            $fkeyUser = $_POST['FKEY_USER'];

            $sql = "INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, FKEY_USER) VALUES ('$number', '$workflowID', '$createDate', '$cost', '$fkeyUser')";

            // Printing the query for debugging
            echo "Debug SQL: " . $sql;

            // Prepare and bind parameters as usual
            $stmt = $conn->prepare("INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, FKEY_USER) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisdi", $number, $workflowID, $createDate, $cost, $fkeyUser);
            break;
        case 'a1_reacts':
            $moleculeID = $_POST['MoleculeID'];
            $experimentID = $_POST['ExperimentID'];
            $recipeAmount =  $_POST['Recipe_amount'];
            $sql = "INSERT INTO a1_reacts (MoleculeID, ExperimentID, Recipe_amount) VALUES ('$moleculeID', '$experimentID', '$recipeAmount')";

            // Printing the query for debugging
            echo "Debug SQL: " . $sql;


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
            echo "Debug SQL: " . $sql;

            $stmt = $conn->prepare("INSERT INTO a1_results (ExperimentNumber, Weight, Yield, SampleDesc, QualityTest, Spectrum_ID) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("idisii", $_POST['ExperimentNumber'], $_POST['Weight'], $_POST['Yield'], $_POST['SampleDesc'], $_POST['QualityTest'], $_POST['Spectrum_ID']);
            break;
    }
    if ($stmt) {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

  // Handle search
if (isset($_POST['search'])) {
    $table = $_POST['table_to_search'];
    $search_column = $_POST['search_column'];
    $search_value = $_POST['search_value'];

    // Check if the table and column are allowed
    //if (in_array($table) && in_array($search_column)) {
        $sql = "SELECT * FROM $table WHERE $search_column = $search_value";
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
            $searchResults .= "<th>Number</th><th>Workflow_ID</th><th>CreateDate</th><th>Cost</th><th>FKEY_USER</th>";
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
    $id_to_delete = $_POST['id_to_delete'];
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    echo $stmt->affected_rows > 0 ? "Record deleted successfully." : "Error deleting record: " . $stmt->error;
    $stmt->close();
    }

  }

  $conn->close();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>ELN Experiment</title>
  <style href="../style.css">
  </style>
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
    <div class="main-content">
        <?php
            // Display the result of show all operation
            if (isset($showAllResults)) {
                echo $showAllResults;
            }

            // Display the search results
            if (isset($searchResults)) {
                echo $searchResults;
            }
        ?>

  <?php if ($tableSelected == 'a1_experiments'): ?>

        <h2>Insert into experiments</h2>
        <!-- Repeat this block for 'a1_reacts' and 'a1_results' with appropriate fields -->
        <form method="post" action="">
        <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
        Number: <input type="text" name="Number" placeholder="Experiment ID">
        Workflow_ID: <input type="text" name="Workflow_ID" placeholder="new Workflow ID">
        CreateDate: <input type="text" name="CreateDate" placeholder="yyyy-mm-dd hh:mm:ss">
        Cost: <input type="text" name="Cost" placeholder="Cost [€]">
        FKEY_USER: <input type="text" name="FKEY_USER" placeholder="FKEY_USER">
        <input type="submit" name="insert" value="Insert" class="small-button">
        </form>

        <h2>Search in experiments</h2>

        <form method="post" action="" class="form-section a1_experiments">
        <input type="hidden" name="table_to_search" value="<?php echo htmlspecialchars($tableSelected); ?>">
        <select name="search_column">
            <option value="Number">Number</option>
            <option value="Workflow_ID">Workflow_ID</option>
            <option value="CreateDate">CreateDate</option>
            <option value="Cost">Cost</option>
            <option value="FKEY_USER">FKEY_USER</option>
        </select>
        <input type="text" name="search_value" placeholder="Value to search for">
        <input type="submit" name="search" value="Search" class="small-button">
        </form>

        <h2>Delete from experiments</h2>
        <form method="post" action="">
        <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
            <input type="text" name="id_to_delete" placeholder="ID to delete">
            <input type="submit" name="delete" value="Delete" class="small-button">
        </form>
    <?php elseif ($tableSelected == 'a1_reacts'): ?>

    <h2>Insert into reacts</h2>
    <form method="post" action="">
    <input type="hidden" name="table_to_insert" value="<?php echo htmlspecialchars($tableSelected); ?>">
        MoleculeID: <input type="text" name="MoleculeID" placeholder="Molecule ID">
        ExperimentID: <input type="text" name="ExperimentID" placeholder="Experiment ID">
        Recipe_amount: <input type="text" name="Recipe_amount" placeholder="Recipe amount [g]">
        <input type="submit" name="insert" value="Insert" class="small-button">
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

    <h2>Delete from reacts</h2>
    <form method="post" action="">
        <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
        <input type="text" name="id_to_delete" placeholder="ID to delete">
        <input type="submit" name="delete" value="Delete" class="small-button">
    </form>
    <?php elseif ($tableSelected == 'a1_results'): ?>

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

    <h2>Delete from results</h2>
    <form method="post" action="">
        <input type="hidden" name="table_to_delete" value="<?php echo htmlspecialchars($tableSelected); ?>">
        <input type="text" name="id_to_delete" placeholder="ID to delete">
        <input type="submit" name="delete" value="Delete" class="small-button">
    </form>
    <?php endif; ?>

</div>

  </body>
  </html>
