<?php
include 'config.php';
session_start();

$user_response = array();

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $firstName = $_POST["firstName"];
  $middleName = $_POST["middleName"];
  $lastName = $_POST["lastName"];
  $gender = $_POST["gender"];
  $department = $_POST["department"];

  // Validate form data
  if (empty($firstName) || empty($middleName) || empty($lastName) || empty($gender) || empty($department)) {
    // Set error message
    $user_response["success"] = false;
    $user_response["message"] = "Please fill out all the fields.";
  } else {
    // Insert data into the 'profiles' table
    $sql = "INSERT INTO profiles (firstName, middleName, lastName, genderID, departmentCode) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $middleName, $lastName, $gender, $department);
    if (mysqli_stmt_execute($stmt)) {
      // Data inserted successfully
      $user_response["success"] = true;
      $user_response["message"] = "Survey submitted successfully!";
    } else {
      // Error inserting data
      $user_response["success"] = false;
      $user_response["message"] = "Error submitting survey. Please try again later.";
    }
    mysqli_stmt_close($stmt);
  }
} else {
  // Invalid request method
  $user_response["success"] = false;
  $user_response["message"] = "Invalid request method.";
}

// Return JSON user_response
header('Content-Type: application/json');
echo json_encode($user_response);
