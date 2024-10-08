<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["staff_id"]) && isset($_POST["UserName"]) && isset($_POST["Password"]) && isset($_POST["role_id"])) {

        // Get POST data
        $staff_id = $_POST["staff_id"];
        $UserName = $_POST["UserName"];
        $Password = $_POST["Password"];
        $role_id = $_POST["role_id"];

        // Function to check if the staff_id exists in the staff table
        function staffIdExists($conn, $staff_id)
        {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `staff` WHERE staff_id = :staff_id");
            $stmt->bindParam(':staff_id', $staff_id);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

        // Check if the staff_id exists in the staff table
        if (!staffIdExists($conn, $staff_id)) {
            echo json_encode(["response" => "error", "message" => "Staff ID not found"]);
            exit();
        }

        // Function to check if a username or staff_id already exists
        function userExists($conn, $staff_id, $UserName)
        {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `user` WHERE staff_id = :staff_id OR username = :UserName");
            $stmt->bindParam(':staff_id', $staff_id);
            $stmt->bindParam(':UserName', $UserName);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

        // Check if the user already exists
        if (userExists($conn, $staff_id, $UserName)) {
            echo json_encode(["response" => "error", "message" => "Account already exists"]);
        } else {
            // Hash the password
            $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

            // Prepare SQL statement to insert into `user`
            $stmt = $conn->prepare("INSERT INTO `user` (staff_id, username, password, role_id) VALUES (:staff_id, :UserName, :Password, :role_id)");
            $stmt->bindParam(':staff_id', $staff_id);
            $stmt->bindParam(':UserName', $UserName);
            $stmt->bindParam(':Password', $hashedPassword);
            $stmt->bindParam(':role_id', $role_id);

            // Execute the statement
            if ($stmt->execute()) {
                // If insertion into `user` is successful, update `staff` table
                $user_id = $conn->lastInsertId(); // Assuming `user_id` is an auto-increment field

                $stmtStaff = $conn->prepare("UPDATE `staff` SET user_id = :user_id WHERE staff_id = :staff_id");
                $stmtStaff->bindParam(':user_id', $user_id);
                $stmtStaff->bindParam(':staff_id', $staff_id);

                if ($stmtStaff->execute()) {
                    echo json_encode(["response" => "success", "message" => "Account created"]);
                } else {
                    echo json_encode(["response" => "error", "message" => "Failed to update staff record"]);
                }
            } else {
                echo json_encode(["response" => "error", "message" => "Failed to create account"]);
            }
        }
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log('Database error: ' . $e->getMessage());
    echo json_encode(["response" => "error", "message" => "Database Error"]);
}
?>
