function gatherSelectedParcels() {
    var selectedParcels = [];

    // Iterate over localStorage to find checkboxes that are checked
    Object.keys(localStorage).forEach(function (key) {
        if (key.startsWith('checkbox-') && localStorage.getItem(key) === 'true') {
            // Extract the ID from the key and push it to the selectedParcels array
            var parcelId = key.replace('checkbox-', '');
            selectedParcels.push(parcelId);
        }
    });

    // Update the hidden input field with selected parcel IDs
    document.getElementById('selected-parcels').value = JSON.stringify(selectedParcels);

    // Clear local storage for checkboxes after form submission
    clearLocalStorageWithPrefix('checkbox-');

    // Clear local storage for the button state after form submission
    localStorage.removeItem('isButtonEnabled');

    // Submit the form
    document.getElementById('generate-route-form').submit();
}

function clearLocalStorageWithPrefix(prefix) {
    Object.keys(localStorage)
        .filter(key => key.startsWith(prefix))
        .forEach(key => localStorage.removeItem(key));
}
