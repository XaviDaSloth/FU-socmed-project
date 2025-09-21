<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo 'Invalid file type. Only JPEG and PNG are allowed.';
        exit;
    }

    // Validate file size (max 2MB)
    $maxSize = 2 * 1024 * 1024; // 2MB
    if ($file['size'] > $maxSize) {
        echo 'File size exceeds the 2MB limit.';
        exit;
    }

    // Move file to a directory (e.g., "uploads/")
    $uploadDir = 'uploads/';
    $fileName = uniqid() . '_' . basename($file['name']);
    $uploadPath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        // Save the file reference to the database
        // Assuming you have a MySQL connection ($conn)
        $conn = new mysqli('localhost', 'username', 'password', 'database');
        
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $sql = "INSERT INTO profile_pictures (user_id, file_path) VALUES (1, '$uploadPath')"; // Adjust for actual user ID
        if ($conn->query($sql) === TRUE) {
            echo 'Image uploaded and saved to database.';
        } else {
            echo 'Error: ' . $conn->error;
        }

        $conn->close();
    } else {
        echo 'Error uploading file.';
    }
} else {
    echo 'No image file received.';
}
?>
