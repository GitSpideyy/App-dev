<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["task_id"]) && isset($_POST["status"])) {

        // Get POST data
        $task_id = $_POST["task_id"];
        $status = $_POST["status"];
        

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE task SET status = :status WHERE task_id = :task_id");

        // Bind parameters
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':status', $status);
   
  
        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Task Updated Successfully"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Task Update Failed"));
        }

    } else {
        echo json_encode(array("response" => "error", "message" => "Missing required fields"));
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(array("response" => "error", "message" => "Database Error"));
}
?>
