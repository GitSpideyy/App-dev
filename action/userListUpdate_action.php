<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["userid"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["staff_id"]) && isset($_POST["role_id"]) ) {

        // Get POST data
        $userid = $_POST["userid"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $staff_id = $_POST["staff_id"];
        $role_id = $_POST["role_id"];
       

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE user SET userid = :userid, username = :username, password = :password, role_id = :role_id, staff_id = :staff_id WHERE userid = :userid");

        // Bind parameters
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->bindParam(':role_id', $role_id);
      

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["response" => "success", "message" => "task Updated Successfully"]);
        } else {
            echo json_encode(["response" => "error", "message" => "task Update Failed"]);
        }

    } else {
        echo json_encode(["response" => "error", "message" => "Missing required fields"]);
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(["response" => "error", "message" => "Database Error"]);
}
