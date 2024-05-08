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
    // Check for duplicate profile
    $sql_check_duplicate = "SELECT COUNT(*) AS total FROM profiles WHERE firstName = ? AND middleName = ? AND lastName = ? AND genderID = ? AND departmentCode = ?";
    $stmt_check_duplicate = mysqli_prepare($conn, $sql_check_duplicate);
    mysqli_stmt_bind_param($stmt_check_duplicate, "sssss", $firstName, $middleName, $lastName, $gender, $department);
    mysqli_stmt_execute($stmt_check_duplicate);
    mysqli_stmt_bind_result($stmt_check_duplicate, $total);
    mysqli_stmt_fetch($stmt_check_duplicate);
    mysqli_stmt_close($stmt_check_duplicate);

    if ($total > 0) {
      // Duplicate profile found
      $user_response["success"] = false;
      $user_response["message"] = "Profile already exists.";
    } else {
      // Insert data into the 'profiles' table
      $sql = "INSERT INTO profiles (firstName, middleName, lastName, genderID, departmentCode) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "sssss", $firstName, $middleName, $lastName, $gender, $department);
      if (mysqli_stmt_execute($stmt)) {
        // Data inserted successfully
        $user_response["success"] = true;
        $user_response["message"] = "Profile added successfully!";
      } else {
        // Error inserting data
        $user_response["success"] = false;
        $user_response["message"] = "Error adding profile. Please try again later.";
      }
      mysqli_stmt_close($stmt);
    }
  }
} else {
  // Invalid request method
  $user_response["success"] = false;
  $user_response["message"] = "Invalid request method.";
}

// Return JSON user_response
header('Content-Type: application/json');
echo json_encode($user_response);
