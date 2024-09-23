<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <script src="https://cdn.plot.ly/plotly-2.27.0.min.js" charset="utf-8"></script>
</head>
<body>
    <div id="chart"></div>  

    <?php
        require '../auth.php';
        $config = include(__DIR__ . '/../config.php');
        $host = $config['db_host'];
        $dbname = $config['db_name'];
        $username = $config['db_user'];
        $password = $config['db_pass'];
        $conn = new mysqli($host, $username, $password, $dbname);

        if($conn->connect_error){
            die("". $conn->connect_error);
        }

        $sqlquery = "SELECT * FROM test";
        $result = $conn->query($sqlquery);

        $chartData = [
            'x' => [],
            'y' => []
        ];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $chartData['x'][] = $row["val1"];
                $chartData['y'][] = $row["val2"];
            }
        }

        $conn->close();
    ?>

    <script>
        var data = [
            {
                x: <?php echo json_encode($chartData['x']); ?>,
                y: <?php echo json_encode($chartData['y']); ?>,
                type: 'bar'
            }
        ];

        var layout = {
            title: 'Bar Chart Example with Database'
        };

        Plotly.newPlot('chart', data, layout);
    </script>
</body>
</html>
