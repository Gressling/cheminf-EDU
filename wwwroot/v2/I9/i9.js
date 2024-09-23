function searchMolecule() {
    var moleculeId = document.getElementById("molecule_search").value;
    var resultContainer = document.getElementById("moleculeResults");
    resultContainer.innerHTML = ''; // Clear previous results

    if (moleculeId.trim() === '') {
        alert('Please enter a molecule ID.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            resultContainer.innerHTML = this.responseText;
            // Hide the Add New Property button initially
            document.querySelector('.add-new-property-container').style.display = 'none';
            // Show the Edit Property form after search results are displayed
            document.querySelector('.update-property').style.display = 'none';
        }
    };

    xhr.open("GET", "get_molecule_results.php?moleculeId=" + encodeURIComponent(moleculeId), true);
    xhr.send();
}

function addProperty() {
    var selectedProperty = document.getElementById('property_input').value;
    var moleculeId = document.getElementById('molecule_search').value;

    if (!moleculeId) {
        alert('Please first search for a molecule you would like to edit.');
        return;
    }
    // After choosing PropertyName, show Edit Property form
    document.querySelector('.update-property').style.display = 'block';
    document.querySelector('.add-new-property-container').style.display = 'block';

    document.getElementById('newPropertyValue').placeholder = 'Edit ' + selectedProperty;
}

function updateProperty() {
    var selectedProperty = document.getElementById('property_input').value;
    var newPropertyValue = document.getElementById('newPropertyValue').value;
    var moleculeId = document.getElementById("molecule_search").value;

    if (selectedProperty && newPropertyValue !== '') {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);

                // Refresh and hide the form after updating
                document.getElementById('newPropertyValue').value = '';
                document.querySelector('.update-property').style.display = 'none';
                // Search again for Molecule ID (Refresh the table)
                searchMolecule();
            }
        };

        xhr.open("POST", "update_property.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(
            "moleculeId=" + encodeURIComponent(moleculeId) +
            "&selectedProperty=" + encodeURIComponent(selectedProperty) +
            "&newPropertyValue=" + encodeURIComponent(newPropertyValue)
        );
    } else {
        alert('Please select a property and enter a new value.');
    }
}

function addNewProperty() {
    var moleculeId = document.getElementById("molecule_search").value;
    var selectedProperty = document.getElementById("property_input").value;
    var newPropertyValue = document.getElementById("newPropertyValue").value;

    if (moleculeId && selectedProperty && newPropertyValue !== "") {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                searchMolecule(); // Refresh results after adding new property
            }
        };

        xhr.open("POST", "add_property.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(
            "moleculeId=" + encodeURIComponent(moleculeId) +
            "&selectedProperty=" + encodeURIComponent(selectedProperty) +
            "&newPropertyValue=" + encodeURIComponent(newPropertyValue)
        );
    } else {
        alert("Please select a property and enter a new value.");
    }
}
