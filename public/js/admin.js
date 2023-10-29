$(document).ready(function () {
    // Handle the "Delete" button click
    $('.delete-user').on('click', function () {
        const userId = $(this).data('user-id'); // Get the user ID from the clicked button's data

        // Set the user ID in the modal's "Confirm Delete" button
        $('.confirm-delete').data('user-id', userId);

        // Display the confirmation modal
        $('#confirmDeleteModal').modal('show');
    });

    // Handle the "Confirm Delete" button click within the modal
    $('.confirm-delete').on('click', function () {
        const userId = $(this).data('user-id'); // Get the user ID from the "Confirm Delete" button's data
        const url = `/admin/delete-user/${userId}`;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Get the CSRF token
            },
            success: function (data) {
                // Handle success, e.g., refresh the user list
                location.reload();
            }
        });

        // Close the modal
        $('#confirmDeleteModal').modal('hide');
    });
});
