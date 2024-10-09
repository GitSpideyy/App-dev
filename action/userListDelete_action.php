<?php
include "../connect.php";

try {
    // Check if userid is set
    if (isset($_POST['userid'])) {
        // Get the userid
        $userid = $_POST['userid'];

        // Prepare the SQL statement with a named placeholder
        $stmt = $conn->prepare("DELETE FROM user WHERE userid = :userid");

        // Bind the parameter
        $stmt->bindParam(':userid', $userid);

        // Execute the statement
        if ($stmt->execute()) {
            // Output success response
            echo json_encode(array("response" => "success", "message" => "Record Deleted"));
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
