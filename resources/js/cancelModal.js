$(document).ready(function () {
    let deleteRoute;
    // Handle the "Delete" button click
    $('.delete-element').on('click', function () {
        // Show the modal
        $('#confirmDeleteModal').css('display', 'block');

        deleteRoute = $(this).data('delete-route');
    });

    // Handle the "Confirm Delete" button click within the modal
    $('#confirmDelete').on('click', function () {

        $.ajax({
            url: deleteRoute,
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
