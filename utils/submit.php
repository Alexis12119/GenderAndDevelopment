<?php
include 'config.php';
session_start();

$response = array();

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $lawCode = $_POST["lawCode"]; // Parameter indicating the specific survey
  $email = $_POST["email"];
  $question1 = $_POST["question1"];
  $question2 = $_POST["question2"];
  $question3 = $_POST["question3"];
  $question4 = $_POST["question4"];
  $question5 = $_POST["question5"];

  // Validate form data
  if (empty($question1) || empty($question2) || empty($question3) || empty($question4) || empty($question5)) {
    // Set error message
    $response["success"] = false;
    $response["message"] = "Please answer all the questions.";
  } else {
    // Check if the email is already used for the specific survey
    $query = "SELECT email FROM law WHERE email = ? AND lawCode = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $email, $lawCode);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);

    if ($rows > 0) {
      // Email already used
      $response["success"] = false;
      $response["message"] = "Email already used! Please use a different email.";
    } else {
      // Insert data into the database
      $totalScore = $question1 + $question2 + $question3 + $question4 + $question5;
      $sql = "INSERT INTO law (email, totalScore, lawCode) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "sii", $email, $totalScore, $lawCode);
      if (mysqli_stmt_execute($stmt)) {
        // Data inserted successfully
        $response["success"] = true;
        $response["message"] = "Survey submitted successfully!";
      } else {
        // Error inserting data
        $response["success"] = false;
        $response["message"] = "Error submitting survey. Please try again later.";
      }
      mysqli_stmt_close($stmt);
    }
  }
} else {
  // Invalid request method
  $response["success"] = false;
  $response["message"] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
