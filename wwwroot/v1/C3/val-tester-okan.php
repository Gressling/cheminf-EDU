<?php
echo "VAL TESTER val1, val2 (V1) <br /><br />"; 

// Extract GET parameters
$getval1 = $_GET['val1'] ?? null;
$getval2 = $_GET['val2'] ?? null;

// Echo GET parameter values
echo "GET Parameters:<br />";
echo "val1: " . $getval1 . "<br />";
echo "val2: " . $getval2 . "<br />";

echo "<br />"; 

// Extract PUT parameters
parse_str(file_get_contents("php://input"), $putParams);
$putval1 = $putParams['val1'] ?? null;
$putval2 = $putParams['val2'] ?? null;

// Echo PUT parameter values
echo "PUT Parameters:<br />";
echo "val1: " . $putval1 . "<br />";
echo "val2: " . $putval2 . "<br />";

?>
