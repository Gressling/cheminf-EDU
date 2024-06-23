<?php
echo "<h3>Hello, World! Welcome to the C3 Group's LIMS-Device Management Project!</h3>";

// Database credentials
$host = "den1.mysql6.gear.host"; 
$dbname = "situation";    
$username = "situation";                    
$password = "cogni77."; // Doğru şifreyi kullanın

// Establish a new database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to mysql database. <br /><br />";

// Attempt to perform a SELECT query
$query = "SELECT val1, val2 FROM test"; // 'test' tablonuzdaki uygun sütun adlarını kullanın
$result = $conn->query($query);

// Start the HTML table
echo "<table border='1' style='width:100%; text-align:left; background-color:#FDB912;'>";
echo "<tr style='background-color:#A90432;'>";
echo "<th>ID Number</th>";
echo "<th>val1</th>";
echo "<th>val2</th>";
echo "</tr>";

if ($result) {
    // Fetch and display each row of data if results are found
    if ($result->num_rows > 0) {
	// Fetch and display the number of rows if results are found
    	$totalRecords = $result->num_rows;
	echo "<p>Total Records: " . $totalRecords . "</p>";
        $idNumber = 1; // Initialize ID number
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr style='color:red;'>";
            echo "<td>" . $idNumber++ . "</td>"; // Increment ID number for each row
            echo "<td>" . htmlspecialchars($row["val1"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["val2"]) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>0 results found in the database.</td></tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

// End the HTML table
echo "</table>";

// Close the database connection
$conn->close();
?>
