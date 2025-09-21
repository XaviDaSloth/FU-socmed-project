$(document).ready(function() {

    $('#search').keyup(function() {
        var input = $(this).val();

        if(input != "") {
            $.ajax({
                url: '../functions/getUsers.php', 
                method: 'POST',
                data: { input: input },
                success: function(data) {

                    $('#search-results').html(data).css("display", "block");
                    

                    if (data.trim() === "") {
                        $('#search-results').html("<div class='no-results'>No results found</div>");
                    }
                }
            });
        } else {

            $('#search-results').css("display", "none");
        }
    });

});
