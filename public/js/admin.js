$(document).ready(function () {
    // Handle the "Delete" button click
    $('.delete-user').on('click', function () {
        // Show the modal
        $('#confirmDeleteModal').css('display', 'block');

        // Store the user ID in a data attribute
        const userId = $(this).data('user-id');
        $('#confirmDeleteModal').data('user-id', userId);
    });

    // Handle the "Confirm Delete" button click within the modal
    $('#confirmDelete').on('click', function () {
        const userId = $('#confirmDeleteModal').data('user-id');
        const url = `/admin/users/${userId}`;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#confirmDeleteModal').css('display', 'none');
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // Handle the "Cancel" button click within the modal
    $('#cancelDelete').on('click', function () {
        // Hide the modal
        $('#confirmDeleteModal').css('display', 'none');
    });
});
