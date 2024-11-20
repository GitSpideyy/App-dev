<?php

include "../connect.php";



try {
    // Check if POST variables are set
    if (isset($_POST["staff_id"]) && isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["contact"]) && isset($_POST["email"]) ) {

        // Get POST data
        $staff_id = $_POST["staff_id"];
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $contact = $_POST["contact"];
        $email = $_POST["email"];
       

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE staff SET firstname = :firstname, middlename = :middlename, lastname = :lastname, contact = :contact, email = :email WHERE staff_id = :staff_id");

        // Bind parameters
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);


        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Staff Account Modified"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Staff Account Modification failed"));
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