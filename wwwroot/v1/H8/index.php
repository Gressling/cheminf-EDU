<!DOCTYPE html>
<html lang="en" 
		xmlns="http://www.w3.org/1999/xhtml"
        xmlns:ui="http://xmlns.jcp.org/jsf/facelets"
		xmlns:p="http://primefaces.org/ui"
		xmlns:h="http://java.sun.com/jsf/html">
<head>
    <meta charset="UTF-8">
    <title>Inventory Database</title>
</head>
<body id = "page_body">
<div class = "row" id = "pagetitle">
	<div class = "col-md-12">
		<h1>Inventory Database</h1>
	</div>
</div>

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
		
	}
	caption {
		text-align:left;
		font-weight: bold;
		font-size: 25px;
	}
</style>

<form method = "post">
	<input type = "submit" name = "tableC" value = "Chemicals" />
	<input type = "submit" name = "tableD" value = "Devices" />
	<input type = "submit" name = "tableM" value = "Materials" />
</form>

<?php
$host = "den1.mysql6.gear.host";
$dbname = "situation"; // Database name
$username = "situation"; // Database username
$password = "cogni77."; // Database password
$conn = new mysqli($host, $username, $password, $dbname);
$debug = false;

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($debug) {echo "Connected successfully";}

// Declare some global variables.
$tableName = "";
$table_row_div_str = "";
$table_title = "";
$coloumn_headers = "";

// Show the chosen table.
if (isset($_POST['tableC'])) {
	$tableName = "H8_Chemicals";
	$table_row_div_str = "<div class = 'row' id = 'tableC'>";
	$table_title = "Chemicals";
	$coloumn_headers = "<th>ID</th><th>Name</th><th>Quantity (g)</th><th>Storage Location</th><th>Purchase Price (€)</th><th>Price (€/g)</th><th>Purchase Date</th><th>Expiration Date</th>";
}
else if (isset($_POST['tableD'])) {
	$tableName = "H8_Devices";
	$table_row_div_str = "<div class = 'row' id = 'tableD'>";
	$table_title = "Devices";
	$coloumn_headers = "<th>ID</th><th>Name</th><th>Location</th><th>Type</th><th>Value (€)</th>";	
}
else if (isset($_POST['tableM'])) {
	$tableName = "H8_Materials";
	$table_row_div_str = "<div class = 'row' id = 'tableM'>";
	$table_title = "Materials";
	$coloumn_headers = "<th>ID</th><th>Name</th><th>Quantity (pcs)</th><th>Location</th><th>Value (€)</th>";	
}

// Execute the sql.
$sql = "SELECT * FROM " . $tableName;
$result = $conn->query($sql);
$conn->close();

// Start building the html-table.
echo $table_row_div_str; 
echo "<div class = 'col-md-12'>";
echo "<table>";
echo "<caption>" . $table_title . "</caption>";
echo "<tr>";
echo $coloumn_headers;
echo "</tr>";

// Fill the table with data.
// Triple if structure to switch between the tables.
if (isset($_POST['tableC'])) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['quantity'] . "</td>";
		echo "<td>" . $row['storage_location'] . "</td>";
		echo "<td>" . $row['purchase_price'] . "</td>";
		echo "<td>" . $row['price_per_gram'] . "</td>";
		echo "<td>" . $row['purchase_date'] . "</td>";
		echo "<td>" . $row['expiration_date'] . "</td>";
		echo "</tr>";
	}
} else if (isset($_POST['tableD'])) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['location'] . "</td>";
		echo "<td>" . $row['device_type'] . "</td>";
		echo "<td>" . $row['device_value'] . "</td>";
		echo "</tr>";
	}
} else if (isset($_POST['tableM'])) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['quantity'] . "</td>";
		echo "<td>" . $row['location'] . "</td>";
		echo "<td>" . $row['material_value'] . "</td>";
		echo "</tr>";
	}
}
echo "</table></div></div>"; // End of table.

?>

</body>	
</html>
