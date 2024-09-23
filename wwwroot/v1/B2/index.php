<?php
// Database connection
$servername = "den1.mysql6.gear.host";
$username = "situation";
$password = "cogni77.";
$dbname = "situation";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the molecule data from the database
    if (isset($_GET['moleculeID'])) {
        $moleculeID = $_GET['moleculeID'];
        $sql = "SELECT * FROM b2_molecules WHERE MoleculeID = '" . $moleculeID . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $molecule = $row;
            }
            // Encode the molecule data as JSON and output it
            echo json_encode($molecule);
        } else {
            echo json_encode("No results");
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>JSME Molecule Editor</title>
    <script type="text/javascript" src="./jsme/JSME_2023-07-31/jsme/jsme.nocache.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h2>Molecule Editor</h2>

<!-- JSME container -->
<div id="jsme_container"></div>

<!-- Form for molecule ID -->
<form id="molecule_form">
    <label for="molecule_id">Molecule ID:</label>
    <input type="text" id="molecule_id" name="molecule_id" required>
    <button type="button" onclick="loadMolecule()">Load Molecule</button>
</form>

<!-- Container for molecule data -->
<div id="molecule_data"></div>

<script>
    // This function will be called after the JSME library has finished loading
    function jsmeOnLoad() {
        // Initialize JSME editor
        window.jsmeApplet = new JSApplet.JSME("jsme_container", "400px", "400px");
    }

    // Function to load molecule into the JSME editor and display the data
    function loadMolecule() {
        var moleculeID = document.getElementById('molecule_id').value;

        // Fetch molecule data from the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_molecule.php?moleculeID=' + moleculeID, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var molecule = JSON.parse(xhr.responseText);

                // Load the molecule into the JSME editor
                jsmeApplet.readMolFile(molecule.MOLFile);

                // Display the molecule data in a table
                var output = '<table>';
                output += '<tr><th>Molecule ID</th><td>' + molecule.MoleculeID + '</td></tr>';
                output += '<tr><th>Molecule Name</th><td>' + molecule.MoleculeName + '</td></tr>';
                output += '<tr><th>Canonical SMILES Format</th><td>' + molecule.CanonicalSmileFormat + '</td></tr>';
                output += '<tr><th>CAS ID</th><td>' + molecule.CasId + '</td></tr>';
                output += '<tr><th>Formula</th><td>' + molecule.Formular + '</td></tr>';
                output += '</table>';
                document.getElementById('molecule_data').innerHTML = output;
            }
        };
        xhr.send();
    }
</script>

</body>
</html>
