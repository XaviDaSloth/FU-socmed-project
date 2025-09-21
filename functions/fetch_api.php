<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Example</title>
</head>

<body>
    <h1>Create Post</h1>
    <textarea name="post_content" id="post_content" rows="4" cols="50" placeholder="Write your post here"></textarea>
    <br>
    <button type="button" id="post_button">Submit</button>
    <br>
    <h2>All Posts</h2>
    <div id="post_list"></div>

    <script>
        
        const loadPosts = async () => {

            try {

                const response = await fetch('./get_posts.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'text/html',
                        //"Content-Type": "application/json",
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.text();
                //const responseData = await response.json();
                
                document.getElementById('post_list').innerHTML = data;

            } catch (error) {

                console.log('Error:', error);

            }

        };

        const createPost = async () => {

            const content = document.getElementById('post_content').value;

            try {

                const response = await fetch('./create_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        //"Content-Type": "application/json",
                    },
                    body: new URLSearchParams({'content': content}),
                    //body: JSON.stringify({ 'content': content })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const responseData = await response.text();
                //const responseData = await response.json();

                alert('Post created successfully!');
                document.getElementById('post_content').value = '';
                loadPosts();

            } catch (error) {

                console.log('Error:', error);

            }

        };

        document.getElementById('post_button').addEventListener('click', createPost);

        loadPosts();

    </script>
</body>
</html>