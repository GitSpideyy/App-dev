<?php

include "../connect.php";

try {
    // Check if all required POST variables are set
    if (isset($_POST["project_name"], $_POST["project_created"], $_POST["start_date"], $_POST["end_date"], $_POST["user_id"])) {

        // Get POST data
        $project_name = $_POST["project_name"];
        $project_created = $_POST["project_created"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $user_id = $_POST["user_id"];

        // Retrieve staff_id using user_id
        $getstaffid = $conn->prepare("SELECT staff_id FROM user WHERE userid = :userid");
        $getstaffid->bindParam(':userid', $user_id);
        $getstaffid->execute();
        $result = $getstaffid->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['staff_id'])) {
            $staff_id = $result['staff_id'];

            // Prepare the SQL statement to insert a new project
            $stmt = $conn->prepare(
                "INSERT INTO project (project_name, project_created, start_date, end_date, staff_id) 
                VALUES (:project_name, :project_created, :start_date, :end_date, :staff_id)"
            );

            // Bind parameters
            $stmt->bindParam(':project_name', $project_name);
            $stmt->bindParam(':project_created', $project_created);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':staff_id', $staff_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(["response" => "success", "message" => "Project Created"]);
            } else {
                echo json_encode(["response" => "error", "message" => "Project creation failed"]);
            }
        } else {
            echo json_encode(["response" => "error", "message" => "Staff ID not found"]);
        }
    } else {
        echo json_encode(["response" => "error", "message" => "Missing required fields"]);
    }
} catch (PDOException $e) {
    // Log error to a file
    error_log("Database error: " . $e->getMessage(), 3, 'errors.log');
    echo json_encode(["response" => "error", "message" => "Database Error"]);
}
?>
