<?php
include 'config.php';
session_start();

$login_response = array();

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Validate form data
  if (empty($username) || empty($password)) {
    // Set error message
    $login_response["success"] = false;
    $login_response["message"] = "All fields are required.";
  } else {
    // Check if the user exists in the database
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();
      // Verify password
      if ($password == $user['password']) {
        // Password is correct, set session variables
        $_SESSION['username'] = $user['username'];
        // Login successful
        $login_response["success"] = true;
        $login_response["message"] = "Login successful.";
      } else {
        // Incorrect password
        $login_response["success"] = false;
        $login_response["message"] = "Invalid password.";
      }
    } else {
      // User not found
      $login_response["success"] = false;
      $login_response["message"] = "Invalid username.";
    }
  }
} else {
  // Invalid request method
  $login_response["success"] = false;
  $login_response["message"] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($login_response);
