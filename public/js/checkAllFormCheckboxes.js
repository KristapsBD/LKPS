// Handle checkbox click event for the table header checkbox
document.getElementById('checkbox-all-search').addEventListener('change', function (event) {
    // Get all checkboxes in the table body
    var checkboxes = document.querySelectorAll('[id^="checkbox-table-search-"]');

    // Update the state of each checkbox in the table body
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = event.target.checked;
    });
});
