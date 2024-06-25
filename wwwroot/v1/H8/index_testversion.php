<?php
// print "Inventory Database<br>";

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

$sql_chemicals = "SELECT * FROM H8_Chemicals";
$sql_devices = "SELECT * FROM H8_Devices";
$sql_materials = "SELECT * FROM H8_Materials";
$result_chemicals = $conn->query($sql_chemicals);
$result_devices = $conn->query($sql_devices);
$result_materials = $conn->query($sql_materials);
$show_table_C = true;
$show_table_D = false;
$show_table_M = false;


$conn->close();
?>

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
	<!-- Buttons to change the table-->
	<!--div class = "row" id = "table_selector">
		<div class = "col-md-12">
			<input type="submit" value="Chemicals" class = "button" name = "buttonC"/>
			<input type="submit" value="Devices" class = "button" name = "buttonD"/>
			<input type="submit" value="Materials" class = "button" name = "buttonM" onclick="javascript:refreshTable();"/>
			
			<?php
				if(array_key_exists('buttonC', $_POST)) { 
					reset_tables();
					buttonC(); 
				} 
				else if(array_key_exists('buttonD', $_POST)) { 
					reset_tables();
					buttonD(); 
				}  
				else if(array_key_exists('buttonM', $_POST)) { 
					reset_tables();
					buttonM(); 
				} 
				function reset_tables() {
					$show_table_C = false;
					$show_table_D = false;
					$show_table_M = false;
				}
				function buttonC() { 
					$show_table_C = true;
				} 
				function buttonD() { 
					$show_table_D = true;
				} 
				function buttonM() { 
					$show_table_M = true;
				} 
			?> 
			<script>
				function refreshTable() {
					$show_table_M = true;
					$('#tables').load(location.href + ' #tables');
				}
			</script>
		</div>
	</div-->
	
	<!-- Styling for the tables. -->
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
	
	<!-- Here are the tables -->
	<div id = "tables">
	<ui:fragment rendered = "#{$show_table_C}">
	<div class = "row" id = "tableC" rendered = "#{$show_table_C}">
		<div class = "col-md-12">
			<table>
				<caption>Chemicals</caption>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Quantity (g)</th>
					<th>Storage Location</th>
					<th>Purchase Price (€)</th>
					<th>Price (€/g)</th>
					<th>Purchase Date</th>
					<th>Expiration Date</th>
				</tr>
				
				<!-- load entries into table -->
				<?php
				while ($row = $result_chemicals->fetch_assoc()) {
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
				?>
			</table>
		</div>
	</div>
	</ui:fragment>
	
	<ui:fragment rendered = "#{$show_table_D}">
	<div class = "row" id = "tableD" rendered = "#{$show_table_D}">
		<div class = "col-md-12">
			<table>
				<caption>Devices</caption>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Location</th>
					<th>Type</th>
					<th>Value (€)</th>
				</tr>
				
				<!-- load entries into table -->
				<?php
				while ($row = $result_devices->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['location'] . "</td>";
					echo "<td>" . $row['device_type'] . "</td>";
					echo "<td>" . $row['device_value'] . "</td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>
	</div>
	</ui:fragment>
	
	<ui:fragment rendered = "#{$show_table_M}">
	<div class = "row" id = "tableM" rendered = "#{$show_table_M}">
		<div class = "col-md-12">
			<table>
				<caption>Materials</caption>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Quantity (pcs)</th>
					<th>Location</th>
					<th>Value (€)</th>
				</tr>
				
				<!-- load entries into table -->
				<?php
				while ($row = $result_materials->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['quantity'] . "</td>";
					echo "<td>" . $row['location'] . "</td>";
					echo "<td>" . $row['material_value'] . "</td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>
	</div>
	</ui:fragment>
	</div>

</body>
</html>



