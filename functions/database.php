<?php
class Database
{
    private $conn;

    // Constructor to establish the database connection
    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function getUserID($username){
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE username = ?");
    
        // Bind the username (which can be either email or username)
        $stmt->bind_param('s', $username);
    
        // Bind result
        $stmt->bind_result($user_id);
    
        // Execute query
        if ($stmt->execute()) {
            // Fetch result
            if ($stmt->fetch()) {
                return $user_id;
            } 
        } else {
            // Log error for debugging
            error_log("Database query failed: " . $stmt->error);
            return 'An error occurred during login'; // Generic error message
        }
    }

    public function getUserInfo($userID) {
        $stmt = $this->conn->prepare("
            SELECT 
                username, firstname, lastname, date_of_birth, sex, email, 
                password, profile_picture, college_name, school_id 
            FROM 
                users 
            INNER JOIN 
                college 
            ON 
                users.college_id = college.college_ID 
            WHERE 
                users.user_ID = ?;
        ");
    
        if (!$stmt) {
            die('Query preparation failed: ' . $this->conn->error);
        }
    
        $stmt->bind_param('i', $userID); 
    

        $stmt->execute();
    

        $stmt->bind_result($username, $fname, $lname, $dob, $gender, $email, $password, $p_picture, $college_name, $school_id);
    

        if ($stmt->fetch()) {
            return [
                'username' => $username,
                'first_name' => $fname,
                'last_name' => $lname,
                'dob' => $dob,
                'gender' => $gender,
                'email' => $email,
                'password' => $password,
                'profile_picture' => $p_picture,
                'college_name' => $college_name,
                'school_id' => $school_id,
            ];
        } else {
            return 'No user found with the given user ID.';
        }
    }
    

    public function loginUser ($username, $user_password)
{
    // Prepare query: Search by either email or username
    $stmt = $this->conn->prepare("SELECT password FROM users WHERE username = ?");
    
    // Bind the username (which can be either email or username)
    $stmt->bind_param('s', $username);

    // Bind result
    $stmt->bind_result($dbpassword);

    // Execute query
    if ($stmt->execute()) {
        // Fetch result
        if ($stmt->fetch()) {
            // Password match check
            if (password_verify($user_password, $dbpassword)) {
                return true;  // Successful login
            } else {
                return 'Incorrect password'; // Incorrect password
            }
        } else {
            return 'No user found with the given email/username'; // No user found
        }
    } else {
        // Log error for debugging
        error_log("Database query failed: " . $stmt->error);
        return 'An error occurred during login'; // Generic error message
    }
}

    public function registerUser($username, $fname, $lname, $dob, $gender, $fu_email, $school_id, $hashedPassword, $collegeID)
    {
        $stmt = $this->conn->prepare('
        INSERT INTO users (username, firstname, lastname, date_of_birth, sex, email, password, College_id, school_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        // Bind the input parameters to the prepared statement
        $stmt->bind_param('ssssssssi', $username, $fname, $lname, $dob, $gender, $fu_email, $hashedPassword, $collegeID, $school_id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            return true;
        } else {
            // Check if error is duplicate entry
            if ($stmt->errno == 1062) {
                // Return custom error message
                return ["status" => "error", "message" => "Error: The username or email already exists."];
            } else {
                // Return other errors
                return ["status" => "error", "message" => "Error: " . $stmt->error];
            }
        }
    }



    public function getStudentRow($student_id)
    {

        $sql = "SELECT * FROM `student` WHERE `id` = '$student_id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            return $result->fetch_assoc();

        }

        return [];

    }

   public function postUser ($userID, $postContent) {
        // Validate inputs
        if (!is_numeric($userID) || empty($postContent)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        }

        // Prepare the SQL statement
        $query = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            return json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement.']);
        }

        // Bind parameters
        $stmt->bind_param("is", $userID, $postContent);

        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            return json_encode(['status' => 'success', 'message' => 'Post created successfully.']);
            
        } else {
            // Log the error for debugging (optional)
            error_log("Database error: " . $stmt->error);
            $stmt->close(); // Close the statement
            return json_encode(['status' => 'error', 'message' => 'Failed to create post.']);
        }
    }
    public function getUsers($input) {
        // Use a parameterized query to prevent SQL injection
        $query = "SELECT user_id, username FROM users WHERE username LIKE ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->conn->error);
        }

        // Add wildcard for partial matching
        $search = "{$input}%";
        $stmt->bind_param("s", $search);

        // Execute the query
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($user_id, $username);

        // Fetch all matching results
        $users = [];
        
        while ($stmt->fetch()) {
            $users[] = ['user_id' => $user_id, 'username' => $username];
        }

        // Close the statement
        $stmt->close();

        // Return results as JSON for easy frontend consumption
        return json_encode($users);
    }

    public function getStudentPostResult($student_id)
    {

        $sql = "SELECT * FROM `post` WHERE `student_id` = '$student_id' ORDER BY created_at DESC";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            $results = [];

            while ($row = $result->fetch_assoc()) {

                $results[] = $row;

            }

            return $results;

        }

        return [];

    }
    public function getPosts($userID) {
        $query = "SELECT username, content, Timestamp FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE users.user_id = ? ORDER BY timestamp DESC "; // Assuming you have a 'users' table
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $userID);

        $stmt->execute();

        $stmt->bind_result($username, $content, $timestamp);

        $userPosts = [];
        
        while ($stmt->fetch()) {
            $userPosts[] = [
                "username" => $username,
                "content" => $content,
                "timestamp" => $timestamp
            ];
        }

        // Close the statement
        $stmt->close();

        // Return results as JSON for easy frontend consumption
        return json_encode($userPosts); 
    }

    function getFollowers($userId) {
        // SQL query to get the followers of the user
        $sql = "
            SELECT u.user_id, u.username
            FROM followers f
            JOIN users u ON f.Follower_id = u.user_id
            WHERE f.User_id = ?
        ";
    
        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the user ID to the query
        $stmt->bind_param("i", $userId);
    
        // Execute the query
        $stmt->execute();
    
        // Bind the result variables
        $stmt->bind_result($followerId, $followerUsername);
    
        // Create an array to store the followers
        $followers = [];
    
        // Fetch the results and store them in the array
        while ($stmt->fetch()) {
            $followers[] = [
                'id' => $followerId,
                'username' => $followerUsername
            ];
        }
    
        // Return the list of followers
        return $followers;
    }
    function getFollowerCount($userID) {
        $sql = "
            SELECT COUNT(*) AS follower_count
            FROM followers
            WHERE User_id = ?
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($followerCount);
        $stmt->fetch();
    
        return $followerCount;
    }
    
    

    function getFollowing($userId) {
        // SQL query to get the users that the given user is following
        $sql = "
            SELECT u.user_id, u.username
            FROM followers f
            JOIN users u ON f.User_id = u.user_id
            WHERE f.Follower_id = ?
        ";
    
        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the user ID to the query
        $stmt->bind_param("i", $userId);
    
        // Execute the query
        $stmt->execute();
    
        // Bind the result variables
        $stmt->bind_result($followingId, $followingUsername);
    
        // Create an array to store the users that the given user is following
        $following = [];
    
        // Fetch the results and store them in the array
        while ($stmt->fetch()) {
            $following[] = [
                'id' => $followingId,
                'username' => $followingUsername
            ];
        }
    
        // Return the list of users that the given user is following
        return $following;
    }
    function getFollowingCount($userID) {
        $sql = "
            SELECT COUNT(*) AS following_count
            FROM followers
            WHERE Follower_id = ?
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($followingCount);
        $stmt->fetch();
    
        return $followingCount;
    }
    
    function followUser($followerId, $userId) {
        // Check if the user is already following the target user
        $checkSql = "SELECT COUNT(*) FROM followers WHERE Follower_id = ? AND User_id = ?";
        $stmt = $this->conn->prepare($checkSql);
        $stmt->bind_param("ii", $followerId, $userId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
    
        if ($count <= 0) {
            // Follow the user
            $insertSql = "INSERT INTO followers (Follower_id, User_id) VALUES (?, ?)";
            $stmt->close();
            $stmt = $this->conn->prepare($insertSql);
            $stmt->bind_param("ii", $followerId, $userId);
            $stmt->execute();
        } 
    
        $stmt->close();
    }
    
    function unfollowUser($followerId, $userId) {
        // Check if the user is currently following the target user
        $checkSql = "SELECT COUNT(*) FROM followers WHERE Follower_id = ? AND User_id = ?";
        $stmt = $this->conn->prepare($checkSql);
        $stmt->bind_param("ii", $followerId, $userId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
    
        if ($count > 0) {
            // Unfollow the user
            $deleteSql = "DELETE FROM followers WHERE Follower_id = ? AND User_id = ?";
            $stmt->close();
            $stmt = $this->conn->prepare($deleteSql);
            $stmt->bind_param("ii", $followerId, $userId);
            $stmt->execute();
            
        } 
    
        $stmt->close();
    }
    
    function changePassword($newpass, $userID) {
        $sql = "
            UPDATE users
            SET password = ?
            WHERE user_id = ?;
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newpass,$userID);
        if($stmt->execute()){
            echo "change password success";
        }else{
            echo $stmt->error;
        }
    }
    
    function ChangeData($userID, $dob, $gender, $college) {

        $sql = "
            UPDATE users
            SET Date_of_birth = ?, 
                sex = ?, 
                college_id = ?
            WHERE user_id = ?;
        ";
    

        $stmt = $this->conn->prepare($sql);
    
        $stmt->bind_param("sssi", $dob, $gender, $college, $userID);

        if ($stmt->execute()) {
            echo "Data updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
    function addImage($userID, $imagePath){
        $sql = "UPDATE users SET profile_picture = ? WHERE user_id = ?";
          $stmt = $this->conn->prepare($sql);
          $stmt->bind_param("si", $imagePath, $userID);
          if ($stmt->execute()) {
              $success_message = "Profile picture updated successfully.";
          } else {
              $error_message = "Failed to update profile picture in the database.";
          }
          $stmt->close();
    }
    public function isFollowing($followerId, $userId) {
        // Prepare the SQL statement to check if the follower is following the target user
        $checkSql = "SELECT COUNT(*) FROM followers WHERE Follower_id = ? AND User_id = ?";
        $stmt = $this->conn->prepare($checkSql);
        
        // Bind the parameters
        $stmt->bind_param("ii", $followerId, $userId);
        
        // Execute the statement
        $stmt->execute();
        
        // Bind the result
        $stmt->bind_result($count);
        
        // Fetch the result
        $stmt->fetch();
        
        // Close the statement
        $stmt->close();
        
        // Return true if the count is greater than 0, indicating the user is following the target user
        return $count > 0;
    }
    // Destructor to close the database connection
    public function __destruct()
    {

        $this->conn->close();

    }

}

?>