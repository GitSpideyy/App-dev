<?php

include "../connect.php";

try {

  
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Start the session
    session_start();

    // Query to get the userid using the username
    $userid_stmt = $conn->prepare("SELECT userid FROM `user` WHERE username = :username");
    $userid_stmt->bindParam(':username', $username);
    $userid_stmt->execute();

    if ($userid_stmt->rowCount() > 0) {
        $userid_result = $userid_stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userid'] = $userid_result['userid'];
    } 

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

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the provided password against the hashed password
            if (password_verify($password, $user['hashed_password'])) {
                
                echo json_encode(array("response" => "success", "message" => "Successfully Logged In"));
            } else {
                echo json_encode(array("response" => "error", "message" => "Invalid username or password"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "Invalid username or password"));
        }
    }
} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
}
?>
