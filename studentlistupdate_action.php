<?php

include "connect.php";



try {
    // Check if POST variables are set
    if (isset($_POST["studentno"]) && isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["contact"]) && isset($_POST["email"]) && isset($_POST["birthdate"])) {

        // Get POST data
        $studentno = $_POST["studentno"];
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $contact = $_POST["contact"];
        $email = $_POST["email"];
        $birthdate = $_POST["birthdate"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE student SET firstname = :firstname, middlename = :middlename, lastname = :lastname, contact = :contact, email = :email, birthdate = :birthdate WHERE studentno = :studentno");

        // Bind parameters
        $stmt->bindParam(':studentno', $studentno);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birthdate', $birthdate);

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