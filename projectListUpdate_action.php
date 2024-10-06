<?php

include "connect.php";

try {
    // Check if POST variables are set
    if (isset($_POST["project_id"]) && isset($_POST["project_name"]) && isset($_POST["project_created"]) && isset($_POST["start_date"]) && isset($_POST["end_date"])) {

        // Get POST data
        $project_id = $_POST["project_id"];
        $project_name = $_POST["project_name"];
        $project_created = $_POST["project_created"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE project SET project_name = :project_name, project_created = :project_created, start_date = :start_date, end_date = :end_date WHERE project_id = :project_id");

        // Bind parameters
        $stmt->bindParam(':project_id', $project_id);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_created', $project_created);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Project Updated Successfully"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Project Update Failed"));
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
