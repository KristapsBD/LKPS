document.addEventListener('DOMContentLoaded', function () {
    // Get references to the buttons
    var generateRouteButton = document.getElementById('generate-route-button');
    var exportParcelsButton = document.getElementById('export-parcels-button');

    // Get all checkboxes, excluding the header checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#checkbox-all-search)');

    // Function to enable or disable buttons based on checkbox status
    function updateButtonState() {
        // Update the "Generate Route" button
        generateRouteButton.disabled = !Array.from(checkboxes).some(checkbox => checkbox.checked);

        // Update the "Export Parcels" button
        exportParcelsButton.disabled = !Array.from(checkboxes).some(checkbox => checkbox.checked);

        // Update the button state based on checkbox changes
        var isAnyCheckboxChecked = Object.keys(localStorage).some(function (key) {
            return key.startsWith('checkbox-') && localStorage.getItem(key) === 'true';
        });

        localStorage.setItem('isButtonEnabled', isAnyCheckboxChecked);

        generateRouteButton.disabled = !(localStorage.getItem('isButtonEnabled') === 'true');
        exportParcelsButton.disabled = !(localStorage.getItem('isButtonEnabled') === 'true');
    }

    // Attach an event listener to each checkbox, including the header checkbox
    checkboxes.forEach(function (checkbox) {
        // Load checkbox state from local storage on page load
        var checkboxKey = 'checkbox-' + checkbox.value;
        var isChecked = localStorage.getItem(checkboxKey) === 'true';
        checkbox.checked = isChecked;

        checkbox.addEventListener('change', function () {
            // Save checkbox state to local storage
            localStorage.setItem(checkboxKey, checkbox.checked);

            // Enable or disable buttons based on checkbox status
            updateButtonState();
        });
    });

    // Attach an event listener to the header checkbox for select/deselect all
    var headerCheckbox = document.getElementById('checkbox-all-search');
    headerCheckbox.addEventListener('change', function () {
        // Update the state of each checkbox in the table body
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = headerCheckbox.checked;

            // Save checkbox state to local storage
            var checkboxKey = 'checkbox-' + checkbox.value;
            localStorage.setItem(checkboxKey, checkbox.checked);
        });

        // Enable or disable buttons based on checkbox status
        updateButtonState();
    });

    // Initial call to set button state on page load
    updateButtonState();
});
