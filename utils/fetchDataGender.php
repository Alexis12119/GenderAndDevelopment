<?php

// Include your database connection file
include 'config.php';

// Function to fetch gender-related data
function fetchGenderData($conn)
{
  $query = "SELECT department.departmentName, gender.genderName, COUNT(profiles.profileID) AS count
              FROM department
              LEFT JOIN profiles ON profiles.departmentCode = department.departmentCode
              LEFT JOIN gender ON profiles.genderID = gender.genderID
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

    // Initialize count for the department if not already set
    if (!isset($gender_response[$department])) {
      $gender_response[$department] = [];
    }

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
