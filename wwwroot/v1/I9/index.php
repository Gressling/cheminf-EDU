<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I9 Molecule Properties</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, button {
            padding: 8px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 10px;
        }
        input {
            width: calc(100% - 18px);
        }
        button {
            min-width: 80px; /* Minimum genişlik değeri */
            min-height: 40px; /* Minimum yükseklik değeri */
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
        }
        .properties {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>I9 Molecule Properties</h1>

<!-- Molekül Search-->
<label for="molecule_search">Molecule</label>
<input type="text" name="molecule_search" id="molecule_search" placeholder="Enter your molecule ID">
<button onclick="searchMolecule()">Search Molecule</button>

<!-- Property Input-->
<label for="property_input">Property</label>
<input type="text" name="property_input" id="property_input" placeholder="Enter the property here">
<button onclick="addProperty()">Add Property</button>
<button onclick="searchProperty()">Search Property</button>

<!-- Molecule Results -->
<div class="result" id="searchResult">
     <h2>Results</h2>
     <ul id="moleculeResults"></ul>
 </div>

 <script>
     function searchMolecule() {
         var moleculeId = document.getElementById("molecule_search").value;

         // AJAX ile PHP script'i çağırarak veritabanından sonuçları al
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 var resultContainer = document.getElementById("moleculeResults");
                 resultContainer.innerHTML = this.responseText;
             }
         };

         xhr.open("GET", "get_molecule_results.php?moleculeId=" + moleculeId, true);
         xhr.send();
     }
 </script>


 </body>
 </html>
