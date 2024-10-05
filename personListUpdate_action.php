<?php

include "connect.php";



try {
    // Check if POST variables are set
    if (isset($_POST["person_id"]) && isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["contact"]) && isset($_POST["email"]) ) {

        // Get POST data
        $person_id = $_POST["person_id"];
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $contact = $_POST["contact"];
        $email = $_POST["email"];
       

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE person SET firstname = :firstname, middlename = :middlename, lastname = :lastname, contact = :contact, email = :email WHERE person_id = :person_id");

        // Bind parameters
        $stmt->bindParam(':person_id', $person_id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);


        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Account Modified"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Account Modification failed"));
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