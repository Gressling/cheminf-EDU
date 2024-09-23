<?php
require '../auth.php';
$config = include('../config.php');

// Database connection details
$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the molecule data from the database
$molecule = [];
if (isset($_GET['moleculeID']) && is_numeric($_GET['moleculeID'])) {
    $moleculeID = intval($_GET['moleculeID']);
    $stmt = $conn->prepare("SELECT * FROM b2_molecules WHERE MoleculeID = ?");
    $stmt->bind_param("i", $moleculeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $molecule = $result->fetch_assoc();
    } else {
        $molecule = ["message" => "No results"];
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>JSME Molecule Editor</title>
    <script type="text/javascript" src="./jsme/JSME_2023-07-31/jsme/jsme.nocache.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <style>
        /* CSS Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            display: grid;
            grid-template-columns: 1fr auto;
            grid-template-rows: auto 1fr auto;
            gap: 20px;
        }

        .title {
            grid-column: 1 / 3;
            text-align: center;
            color: #333;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1000;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .jsme-container {
            grid-column: 1 / 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .jsme {
            width: 100%;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .molecule-form {
            grid-column: 1 / 2;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .molecule-data {
            margin-top: 20px;
        }

        .button-group {
            grid-column: 2 / 3;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 70px;
        }

        .button-group button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;
        }

        .button-group button:hover {
            background-color: #0056b3;
        }

        .molecules-list {
            grid-column: 1 / 3;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            max-height: 400px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .error {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #d9534f;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .links {
            grid-column: 1 / 3;
            text-align: center;
            margin-top: 20px;
        }

        .link {
            color: #007bff;
            text-decoration: none;
            font-weight: 700;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Molecule Editor</h1>

        <!-- JSME container -->
        <div class="jsme-container">
            <div id="jsme_container" class="jsme"></div>
        </div>

        <!-- Form for molecule ID -->
        <div class="molecule-form">
            <form id="molecule_form">
                <label for="molecule_id">Molecule ID:</label>
                <input type="text" id="molecule_id" name="molecule_id" required>
                <button type="button" onclick="loadMolecule()">Load Molecule</button>
            </form>
            <!-- Container for molecule data -->
            <div id="molecule_data" class="molecule-data"></div>
        </div>

        <!-- Button group for showing and hiding molecule list -->
        <div class="button-group">
            <button type="button" onclick="showMolecules()">Show Molecules List</button>
            <button type="button" onclick="hideMolecules()">Hide Molecules List</button>
        </div>

        <!-- Container for molecules list -->
        <div id="molecules_list" class="molecules-list" style="display:none;"></div>

        <div class="links">
            <a class="link" href="../index.php">Home</a>
        </div>
    </div>

    <script>
        // Initialize JSME editor
        function jsmeOnLoad() {
            // Only initialize if JSME has not been initialized before
            if (!window.jsmeApplet) {
                window.jsmeApplet = new JSApplet.JSME("jsme_container", "500px", "500px");
            }
        }

        // Function to load molecule into the JSME editor and display the data
        function loadMolecule() {
            var moleculeID = document.getElementById('molecule_id').value;

            if (!moleculeID) {
                alert('Please enter a Molecule ID.');
                return;
            }

            console.log('Loading molecule with ID:', moleculeID);

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_molecule.php?moleculeID=' + encodeURIComponent(moleculeID), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log('Response received:', xhr.responseText);
                        try {
                            var molecule = JSON.parse(xhr.responseText);

                            if (molecule.error) {
                                console.error('Error from backend:', molecule.error, molecule.details);
                                document.getElementById('molecule_data').innerHTML = '<p class="error">' + molecule.error + ': ' + molecule.details + '</p>';
                                return;
                            }

                            if (molecule.MOLFile) {
                                if (window.jsmeApplet) {
                                    window.jsmeApplet.readMolFile(molecule.MOLFile);
                                } else {
                                    console.error('JSME not initialized');
                                }
                            }

                            var output = '<table>';
                            output += '<tr><th>Molecule ID</th><td>' + molecule.MoleculeID + '</td></tr>';
                            output += '<tr><th>Molecule Name</th><td>' + molecule.MoleculeName + '</td></tr>';
                            output += '<tr><th>Canonical SMILES Format</th><td>' + molecule.CanonicalSmileFormat + '</td></tr>';
                            output += '<tr><th>CAS ID</th><td>' + molecule.CasId + '</td></tr>';
                            output += '<tr><th>Formula</th><td>' + molecule.Formular + '</td></tr>';
                            output += '</table>';
                            document.getElementById('molecule_data').innerHTML = output;
                        } catch (e) {
                            console.error('Failed to parse JSON response:', e);
                            document.getElementById('molecule_data').innerHTML = '<p class="error">Failed to load molecule data. Please check the console for details.</p>';
                        }
                    } else {
                        console.error('AJAX request failed with status:', xhr.status, xhr.statusText);
                        document.getElementById('molecule_data').innerHTML = '<p class="error">Failed to load molecule data. Please check the console for details.</p>';
                    }
                }
            };
            xhr.send();
        }

        // Function to show the molecules list
        function showMolecules() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'show_molecules.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Molecules list response:', xhr.responseText);
                    try {
                        var molecules = JSON.parse(xhr.responseText);

                        var output = '<table>';
                        output += '<tr><th>Molecule ID</th><th>Name</th><th>Canonical SMILES</th><th>CAS ID</th><th>Formula</th></tr>';

                        if (molecules.length > 0) {
                            molecules.forEach(function (molecule) {
                                output += '<tr>';
                                output += '<td>' + molecule.MoleculeID + '</td>';
                                output += '<td>' + molecule.MoleculeName + '</td>';
                                output += '<td>' + molecule.CanonicalSmileFormat + '</td>';
                                output += '<td>' + molecule.CasId + '</td>';
                                output += '<td>' + molecule.Formular + '</td>';
                                output += '</tr>';
                            });
                        } else {
                            output += '<tr><td colspan="5">No results</td></tr>';
                        }

                        output += '</table>';
                        document.getElementById('molecules_list').innerHTML = output;
                        document.getElementById('molecules_list').style.display = 'block'; // Show the list
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
                        document.getElementById('molecules_list').innerHTML = '<p class="error">Failed to load molecules list. Please check the console for details.</p>';
                    }
                } else if (xhr.readyState === 4) {
                    console.error('AJAX request failed with status:', xhr.status, xhr.statusText);
                    document.getElementById('molecules_list').innerHTML = '<p class="error">Failed to load molecules list. Please check the console for details.</p>';
                }
            };
            xhr.send();
        }

        // Function to hide the molecules list
        function hideMolecules() {
            document.getElementById('molecules_list').style.display = 'none'; // Hide the list
        }

        // Initialize JSME editor on window load
        window.onload = jsmeOnLoad;
    </script>
</body>
</html>
