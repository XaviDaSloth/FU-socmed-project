<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Create Post</h1>
    <textarea name="post_content" id="user_post_content" rows="4" cols="50" placeholder="Write your post here"></textarea>
    <br>
    <button type="button" id="post_button">Submit</button>
    <br>
    <h2>All Posts</h2>
    <div id="post_list"></div>

    <script>

        const loadPosts = () => {

            $.ajax({

                url: './get_posts.php',
                type: 'GET',
                dataType: 'html',
                success: function(data) {

                    $('#post_list').html(data);

                },
                error: function(xhr, status, error) {

                    console.log('Error:', error);

                }

            });

        }

        const createPost = () => {
            const content = document.getElementById('user_post_content').value.trim(); // Trim whitespace

            // Check if content is not empty
            if (content === '') {
                alert('Post content cannot be empty.');
                return;
            }

            // Optionally, disable the submit button or show a loading spinner while the request is processing
            $('#user-post-submit').prop('disabled', true);  // Disable submit button
            $('#user-post-submit').text('Submitting...');  // Change button text

            $.ajax({
                url: '../functions/create_post.php',
                type: 'POST',
                data: {
                    'content': content
                },
                dataType: 'json', // Use JSON if you're sending/receiving structured data
                success: function(data) {
                    // Check for the response status
                    if (data.status === 'success') {
                        alert('Post created successfully!');
                        $('#user_post_content').val(''); // Clear the textarea
                        loadPosts(); // Reload posts
                    } else {
                        alert('Error: ' + data.message); // Handle any server-side errors
                    }

                    // Re-enable the submit button
                    $('#user-post-submit').prop('disabled', false);
                    $('#user-post-submit').text('SUBMIT');
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('An error occurred while creating the post.');

                    // Re-enable the submit button on error
                    $('#user-post-submit').prop('disabled', false);
                    $('#user-post-submit').text('SUBMIT');
                }
            });
        };


        document.getElementById('user-post-form').addEventListener('submit', createPost);

        loadPosts();

    </script>
</body>
</html>



