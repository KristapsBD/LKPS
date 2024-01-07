function submitForm(action) {
    // Update the selected parcels input
    var selectedParcels = [];
    Object.keys(localStorage).forEach(function (key) {
        if (key.startsWith('checkbox-') && localStorage.getItem(key) === 'true') {
            var parcelId = key.replace('checkbox-', '');
            selectedParcels.push(parcelId);
        }
    });
    document.getElementById('selected-parcels').value = JSON.stringify(selectedParcels);

    // Set the dynamic action URL based on the button pressed
    var form = document.getElementById('parcel-select-form');
    if (action === 'export-selected') {
        form.action = "/admin/parcels/export-selected";
    } else if (action === 'generate-route') {
        form.action = "/admin/generate-route";
    } else {
        throw new Error('Invalid action specified');
    }

    // Clear local storage for checkboxes after form submission
    clearLocalStorageWithPrefix('checkbox-');

    // Clear local storage for the button state after form submission
    localStorage.removeItem('isButtonEnabled');

    // Submit the form
    form.submit();

    // Reload the page only after exporting parcels
    if (action === 'export-selected') {
        setTimeout(function () {
            location.reload();
        }, 1000);
    }
}

function clearLocalStorageWithPrefix(prefix) {
    Object.keys(localStorage)
        .filter(key => key.startsWith(prefix))
        .forEach(key => localStorage.removeItem(key));
}
