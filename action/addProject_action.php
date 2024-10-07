<?php

include "../connect.php";


try {
    // Check if POST variables are set
    if (isset($_POST["project_name"]) && isset($_POST["project_created"]) && isset($_POST["start_date"]) && isset($_POST["end_date"])) {

        // Get POST data
        $project_name = $_POST["project_name"];
        $project_created = $_POST["project_created"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO project (project_name, project_created, start_date, end_date) VALUES (:project_name, :project_created, :start_date, :end_date)");

        // Bind parameters
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_created', $project_created);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
      

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