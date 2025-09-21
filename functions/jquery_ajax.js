$(document).ready(function(){


const loadPosts = () => {

    $.ajax({

        url: '../functions/get_posts.php',
        type: 'GET',
        dataType: 'html',
        success: function(data) {

            $('#posts').html(data);

        },
        error: function(xhr, status, error) {

            console.log('Error:', error);

        }

    });

}

const createPost = (event) => {
    event.preventDefault();
    const content = document.getElementById('user_post_content').value;

    if (!content.trim()) {
        alert('Post content cannot be empty.');
        return;
    }
    
    $.ajax({

        url: '../functions/create_post.php',
        type: 'POST',
        data: {
            'content' : content
        },
        dataType: 'html',
        success: function(data) {

            alert('Post created successfully!');
            $('#user_post_content').val('');
            loadPosts();
        },
        error: function(xhr, status, error) {

            console.log('Error:', error);

        }

    });

}


document.getElementById('postForm').addEventListener('submit', createPost);

loadPosts();


})