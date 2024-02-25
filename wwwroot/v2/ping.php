<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>ChemInformatics EDU</title>
</head>
<body>
    <div class="container">
        <div class="php-test">Check DB, via environment variables ... <br/> 

<?php
// DB
$connStr = getenv('CUSTOMCONNSTR_strConn');
list($host, $dbname, $user, $password) = explode(';', $connStr);

$pingResult = array();
exec("ping " . escapeshellarg($host), $pingResult);

// Output the result
foreach ($pingResult as $line) {
    echo $line . "<br>";
}
?>


        </div>
        <div class="license">MIT Licence - no commercial interest</div>
    </div>

</body>
</html>
