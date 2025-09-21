$(document).ready(function() {
    // Handle creating a new post
    $('.user-post-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        const postContent = $('textarea[name="post"]').val().trim();

        if (postContent === '') {
            alert('Please enter some content before posting.');
            return;
        }

        $.ajax({
            url: '../pages/homepage.php', // Use the same PHP file for handling the post
            type: 'POST',
            dataType: 'json',  // Expecting a JSON response
            data: {
                'post': postContent,
                'user-post-submit': true // Indicate that this is a post submission
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('textarea[name="post"]').val('');  // Clear the content field
                    showPosts();  // Refresh posts after successful creation
                } else {
                    alert('Error! ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                alert('An error occurred while creating the post.');
            }
        });

    });

    // Function to load and display posts
    const showPosts = () => {
        $('#posts').html('<p>Loading posts...</p>'); // Loading indicator

        $.ajax({
            url: '../functions/get_posts.php', // Ensure this path is correct
            type: 'GET',
            dataType: 'json',  // Expecting a JSON response
            success: function (response) {
                if (response.status === 'success') {
                    $('#posts').html(''); // Clear the posts container
                    response.posts.forEach(post => {
                        $('#posts').append(`
                            <div class="flex-posts">
                                <div class="div-posts-name">
                                    <h3>${post.username}</h3>
                                    <p id="follow">Follow</p>
                                    <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                                    <span class="separator"></span>
                                </div>
                                <div class="div-posts-content">
                                    ${post.content}
                                </div>
                                <div class="div-posts-reactions">
                                    <div><i class="fa-regular fa-thumbs-up fa-xl"></i><p>20</p></div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    alert('Error! ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                alert('An error occurred while fetching posts.');
            }
        });
    };

    // Initial call to load posts
    showPosts();
});