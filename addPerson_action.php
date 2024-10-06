<?php

include "connect.php";


try {
    // Check if POST variables are set
    if (isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["contact"]) && isset($_POST["email"])) {

        // Get POST data
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $contact = $_POST["contact"];
        $email = $_POST["email"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO person (firstname, middlename, lastname, contact, email) VALUES (:firstname, :middlename, :lastname, :contact, :email)");

        // Bind parameters
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("response" => "success", "message" => "Person Created"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Person creation failed"));
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