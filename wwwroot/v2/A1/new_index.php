<?php
// Start the session
session_start();

// Initialize the selected table variable
$tableSelected = '';

// Check if a table is selected
if (isset($_POST['table'])) {
    $_SESSION['tableSelected'] = $_POST['table'];
}

if (isset($_SESSION['tableSelected'])) {
    $tableSelected = $_SESSION['tableSelected'];
}

$config = include('config.php');

$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle insert operation
if (isset($_POST['insert'])) {
    $table = $_POST['table_to_insert'];
    if ($table == 'a1_experiments') {
        $number = $_POST['Number'];
        $workflow_id = $_POST['Workflow_ID'];
        $create_date = $_POST['CreateDate'];
        $cost = $_POST['Cost'];
        $purpose = $_POST['Purpose'];
        $fkey_user = $_POST['FKEY_USER'];
        $sql = "INSERT INTO a1_experiments (Number, Workflow_ID, CreateDate, Cost, Purpose, FKEY_USER) VALUES ('$number', '$workflow_id', '$create_date', '$cost', '$purpose', '$fkey_user')";
    } elseif ($table == 'a1_reacts') {
        $molecule_id = $_POST['MoleculeID'];
        $experiment_id = $_POST['ExperimentID'];
        $recipe_amount = $_POST['Recipe_amount'];
        $sql = "INSERT INTO a1_reacts (MoleculeID, ExperimentID, Recipe_amount) VALUES ('$molecule_id', '$experiment_id', '$recipe_amount')";
    } elseif ($table == 'a1_results') {
        $experiment_id = $_POST['ExperimentID'];
        $weight = $_POST['Weight'];
        $yield = $_POST['Yield'];
        $sample_desc = $_POST['SampleDesc'];
        $quality_test = $_POST['QualityTest'];
        $spectrum_id = $_POST['Spectrum_ID'];
        $sql = "INSERT INTO a1_results (ExperimentID, Weight, Yield, SampleDesc, QualityTest, Spectrum_ID) VALUES ('$experiment_id', '$weight', '$yield', '$sample_desc', '$quality_test', '$spectrum_id')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle update operation
if (isset($_POST['update'])) {
    $table = $_POST['table_to_update'];
    if ($table == 'a1_experiments') {
        $number = $_POST['Number'];
        $attribute = $_POST['attribute'];
        $new_value = $_POST['newValue'];
        $sql = "UPDATE a1_experiments SET $attribute='$new_value' WHERE Number='$number'";
    } elseif ($table == 'a1_reacts') {
        $experiment_id = $_POST['ExperimentID'];
        $molecule_id = $_POST['MoleculeID'];
        $new_value = $_POST['newValue'];
        $sql = "UPDATE a1_reacts SET Recipe_amount='$new_value' WHERE ExperimentID='$experiment_id' AND MoleculeID='$molecule_id'";
    } elseif ($table == 'a1_results') {
        $experiment_number = $_POST['ExperimentNumber'];
        $attribute = $_POST['attribute'];
        $new_value = $_POST['newValue'];
        $sql = "UPDATE a1_results SET $attribute='$new_value' WHERE ExperimentNumber='$experiment_number'";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete operation
if (isset($_POST['delete'])) {
    $table = $_POST['table_to_delete'];
    $delete_column = $_POST['delete_column'];
    $delete_value = $_POST['delete_value']; // 注意这里
    $sql = "DELETE FROM $table WHERE $delete_column='$delete_value'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
