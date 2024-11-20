<?php
include "../connect.php";

try {
    // Check if project_id is set
    if (isset($_POST['project_id'])) {
        // Get the project_id
        $project_id = $_POST['project_id'];

        // Prepare the SQL statement with a named placeholder
        $stmt = $conn->prepare("DELETE FROM project WHERE project_id = :project_id");

        // Bind the parameter
        $stmt->bindParam(':project_id', $project_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Output success response
            echo json_encode(array("response" => "success", "message" => "Project Deleted"));
        } else {
            // Output failure response
            echo json_encode(array("response" => "error", "message" => "Deletion Failed"));
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
