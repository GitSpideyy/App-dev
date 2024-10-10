<?php

include "../connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["task_name"]) && isset($_POST["staff_id"]) && isset($_POST["project_id"]) && isset($_POST["task_created"]) && isset($_POST["due_date"])) {

        // Get POST data
        $task_name = $_POST["task_name"];
        $staff_id = $_POST["staff_id"];
        $project_id = $_POST["project_id"];
        $task_created = $_POST["task_created"];
        $due_date = $_POST["due_date"];
        $status = "Not Started";
       

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO task (task_name, staff_id, project_id, task_created, due_date, status) VALUES (:task_name, :staff_id, :project_id, :task_created, :due_date, :status)");

        // Bind parameters
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->bindParam(':project_id', $project_id);
        $stmt->bindParam(':task_created', $task_created);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':status', $status);
        
        

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Task Created"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Task creation failed"));
        }

    } else {
        echo json_encode(array("response" => "error", "message" => "Missing required fields"));
    }
} catch (PDOException $e) {
    // Log error to a file
    echo "<script>console.error('Database error: " . addslashes($e->getMessage()) . "');</script>";

    echo json_encode(array("response" => "error", "message" => "Database Error"));
    echo $e->getMessage();  
}
?>
