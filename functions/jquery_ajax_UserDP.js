$(document).ready(function() {
    const userID = $('#hiddenUserID').val();
    $.ajax({
        url: '../functions/getUserPost.php',
        type: 'GET',
        data: {userID},
        dataType: 'html',
        success: function(data) {
            $('#posts').html(data);
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }

    });
});