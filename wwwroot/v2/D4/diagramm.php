<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Generator</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

<h2>Chart Generator</h2>

<form method="post">
    <input type="submit" name="generateBarChart" value="Generate Bar Chart">
    <input type="submit" name="generateScatterPlot" value="Generate Scatter Plot">
    <input type="submit" name="generateLineChart" value="Generate Line Chart">
</form>

<?php
if (isset($_POST['generateBarChart'])) {
    // Generate Bar Chart
    $labels = ['Category 1', 'Category 2', 'Category 3'];
    $values = [10, 20, 15];
    generateChart('bar', $labels, $values);
}

if (isset($_POST['generateScatterPlot'])) {
    // Generate Scatter Plot
    $xValues = [1, 2, 3, 4, 5];
    $yValues = [10, 15, 7, 25, 18];
    generateChart('scatter', $xValues, $yValues);
}

if (isset($_POST['generateLineChart'])) {
    // Generate Line Chart
    $xValues = [1, 2, 3, 4, 5];
    $yValues = [10, 15, 7, 25, 18];
    generateChart('line', $xValues, $yValues);
}

function generateChart($type, $xData, $yData) {
    $plotlyConfig = [
        'x' => $xData,
        'y' => $yData,
        'mode' => ($type === 'scatter') ? 'markers' : 'lines',
        'type' => $type,
        'name' => 'Chart',
    ];

    echo '<div id="chart"></div>';
    echo '<script>Plotly.newPlot("chart", [' . json_encode($plotlyConfig) . ']);</script>';
}
?>

</body>
</html>
