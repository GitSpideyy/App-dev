<?php
include "../connect.php";

try {
    // Retrieve username and password from POST request
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Start the session
    session_start();

    // Query to get the userid using the username
    $userid_stmt = $conn->prepare("SELECT userid FROM `user` WHERE username = :username");
    $userid_stmt->bindParam(':username', $username);
    $userid_stmt->execute();

    // Check if the user exists
    if ($userid_stmt->rowCount() > 0) {
        $userid_result = $userid_stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userid'] = $userid_result['userid'];
    } else {
        // User not found
        echo json_encode(array("response" => "error", "message" => "User not found"));
        echo "<script>console.log('User ID not found');</script>";
        exit;
    }

    // Store username in session
    $_SESSION['username'] = $username;

    // Prepare SQL statement to get user data including hashed password
    $stmt = $conn->prepare("SELECT
                                userid,
                                staff_id,
                                username,
                                password AS hashed_password
                            FROM 
                                `user` 
                            WHERE 
                                username = :username");
    $stmt->bindParam(':username', $username);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the provided password against the hashed password
            if (password_verify($password, $user['hashed_password'])) {
                echo json_encode(array("response" => "success", "message" => "Successfully Logged In"));
            } else {
                // Invalid password
                echo json_encode(array("response" => "error", "message" => "Invalid username or password"));
            }
        } else {
            // Invalid username
            echo json_encode(array("response" => "error", "message" => "Invalid username or password"));
        }
    }
}