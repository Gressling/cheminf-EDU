<?php
$config = include('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>ChemInformatics EDU - API Call Debug Example</title>
    <meta charset="UTF-8">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const apiKey = '<?php echo $config['api_key']; ?>'; 
            const apiUrl = 'api.php?apiKey=' + apiKey;
            const debugInfo = document.getElementById('debugInfo');

            debugInfo.innerHTML += '<p>Requesting URL: ' + apiUrl + '</p>';

            fetch(apiUrl)
                .then(response => {
                    if (response.ok) return response.json();
                    else throw new Error('Unauthorized');
                })
                .then(data => {
                    console.log(data);
                    debugInfo.innerHTML += '<p>Response: ' + JSON.stringify(data) + '</p>';
                })
                .catch(error => {
                    console.error('Error:', error);
                    debugInfo.innerHTML += '<p>Error: ' + error.message + '</p>';
                });
        });
    </script>
</head>

<body>
    <div class="container">
        <h1 class="title">API Call Debug Example</h1>
        <div class="php-test" id="debugInfo"></div> <!-- Debug information will be displayed here -->
        <div class="license">MIT Licence - no commercial interest</div>
        <div class="links"><a class="link" href="index.php">Home</a><br /></div>
    </div>
</body>

</html>
