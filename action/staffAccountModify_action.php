<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["userid"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["staff_id"]) && isset($_POST["role_id"])) {

        // Get POST data
        $userid = $_POST["userid"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $staff_id = $_POST["staff_id"];
        $role_id = $_POST["role_id"];

        // Retrieve the current password from the database
        $stmt = $conn->prepare("SELECT password FROM user WHERE userid = :userid");
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $currentPassword = $result['password'];

            // Check if the passwords match
            if ($currentPassword !== $password) {
                // Hash the new password
                $password = password_hash($password, PASSWORD_BCRYPT);
            }

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
                echo json_encode(["response" => "success", "message" => "User Updated Successfully"]);
            } else {
                echo json_encode(["response" => "error", "message" => "User Update Failed"]);
            }
        } else {
            echo json_encode(["response" => "error", "message" => "User not found"]);
        }
    } else {
        echo json_encode(["response" => "error", "message" => "Missing required fields"]);
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(["response" => "error", "message" => "Database Error"]);
}
?>
