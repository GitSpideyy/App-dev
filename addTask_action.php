<?php

include "connect.php";


try {
    // Check if POST variables are set
    if (isset($_POST["task_name"]) && isset($_POST["person_id"]) && isset($_POST["project_id"]) ) {

        // Get POST data
        $task_name = $_POST["task_name"];
        $person_id = $_POST["person_id"];
        $project_id = $_POST["project_id"];
      
        

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO task (task_name, person_id, project_id) VALUES (:task_name, :person_id, :project_id)");

        // Bind parameters
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':person_id', $person_id);
        $stmt->bindParam(':project_id', $project_id);
      
      

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Project Created"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Project creation failed"));
        }

    } else {
        echo json_encode(array("response" => "error", "message" => "Missing required fields"));
    }
} catch (PDOException $e) {
    // Log error to a file
    error_log("Database error: " . $e->getMessage(), 3, 'errors.log');

    echo json_encode(array("response" => "error", "message" => "Database Error"));
}
?>