<?php
include "../connect.php";

try {
    // Check if task_id is set
    if (isset($_POST['task_id'])) {
        // Get the task_id
        $task_id = $_POST['task_id'];

        // Prepare the SQL statement with a named placeholder
        $stmt = $conn->prepare("DELETE FROM task WHERE task_id = :task_id");

        // Bind the parameter
        $stmt->bindParam(':task_id', $task_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Output success response
            echo json_encode(array("response" => "success", "message" => "Task Deleted"));
        } else {
            // Output failure response
            echo json_encode(array("response" => "error", "message" => "Task Deletion Failed"));
        }
    } else {
        // Output missing parameter response
        echo json_encode(array("response" => "error", "message" => "Missing required fields"));
    }
} catch (PDOException $e) {
    // Log error to server log and show generic error message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(array("response" => "error", "message" => "Database Error"));
}
?>
