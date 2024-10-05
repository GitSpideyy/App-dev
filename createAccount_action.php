<?php

include "connect.php";

try {

    // Check if POST variables are set
    if (isset($_POST["FullName"]) && isset($_POST["UserName"]) && isset($_POST["Password"])) {

        // Get POST data
        $FullName = $_POST["FullName"];
        $UserName = $_POST["UserName"];
        $Password = $_POST["Password"];
       

        // Function to check if a username or fullname already exists
        function userExists($conn, $FullName, $UserName)
        {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `user` WHERE FullName = :FullName OR UserName = :UserName");
            $stmt->bindParam(':FullName', $FullName);
            $stmt->bindParam(':UserName', $UserName);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

        // Check if the user already exists
        if (userExists($conn, $FullName, $UserName)) {
            echo json_encode(array("response" => "error", "message" => "Account Already Exist"));
        } else {
            // Hash the password
            $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);


          
            // Prepare SQL statement with placeholders
            $stmt = $conn->prepare("INSERT INTO `user` (fullname, username, password) VALUES (:FullName, :UserName, :Password)");

            // Bind parameters
            $stmt->bindParam(':FullName', $FullName);
            $stmt->bindParam(':UserName', $UserName);
            $stmt->bindParam(':Password', $hashedPassword);
           

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(array("response" => "success", "message" => "Account Created"));
            } else {
                echo json_encode(array("response" => "error", "message" => "Account requirements did not meet"));
            }
        }
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(array("response" => "error", "message" => "Database Error"));
}
?>