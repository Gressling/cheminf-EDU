<?php
$host = 'den1.mysql6.gear.host'; // Replace with the host you want to ping
$pingResult = array();
exec("ping " . escapeshellarg($host), $pingResult);

// Output the result
foreach ($pingResult as $line) {
    echo $line . "<br>";
}
?>
