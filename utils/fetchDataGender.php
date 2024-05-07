<?php

// Include your database connection file
include 'config.php';

// Function to fetch gender-related data
function fetchGenderData($conn)
{
  // Query to fetch gender-related data
  $query = "SELECT department.departmentName, gender.genderName, COUNT(users.userID) AS count
              FROM users
              INNER JOIN department ON users.departmentCode = department.departmentCode
              INNER JOIN gender ON users.genderID = gender.genderID
              GROUP BY department.departmentName, gender.genderName";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Error: " . mysqli_error($conn));
  }

  $gender_response = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $department = $row['departmentName'];
    $gender = $row['genderName'];
    $count = (int)$row['count'];

    // Add data to gender_response array
    $gender_response[$department][$gender] = $count;
  }

  return $gender_response;
}

// Fetch gender-related data
$gender_response = fetchGenderData($conn);

// Close the database connection
mysqli_close($conn);

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($gender_response);
