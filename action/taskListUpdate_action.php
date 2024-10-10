<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["task_id"]) && isset($_POST["task_name"]) && isset($_POST["staff_id"]) && isset($_POST["project_id"]) && isset($_POST["task_created"]) && isset($_POST["due_date"]) && isset($_POST["status"])) {

        // Get POST data
        $task_id = $_POST["task_id"];
        $task_name = $_POST["task_name"];
        $staff_id = $_POST["staff_id"];
        $project_id = $_POST["project_id"];
        $task_created = $_POST["task_created"];
        $due_date = $_POST["due_date"];
        $status = $_POST["status"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE task SET task_name = :task_name, staff_id = :staff_id, project_id = :project_id, task_created = :task_created, due_date = :due_date,  status = :status WHERE task_id = :task_id");

        // Bind parameters
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->bindParam(':project_id', $project_id);
        $stmt->bindParam(':task_created', $task_created);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':status', $status);

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
