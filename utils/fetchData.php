<?php
include 'config.php';

// Function to execute a query and fetch results
function fetchData($tableName, $conn)
{
  // Adjust the query to fetch gender-related data
  if ($tableName === "users") {
    $query = "SELECT genderName, COUNT(*) AS count 
              FROM $tableName AS u
              INNER JOIN gender AS g ON u.genderID = g.genderID
              INNER JOIN department AS d ON u.departmentCode = d.departmentCode
              GROUP BY genderName";
  } else {
    // For rights-related data
    $query = "SELECT level, COUNT(*) AS count 
              FROM (
                  SELECT 
                      CASE 
                          WHEN totalScore BETWEEN 5 AND 12 THEN 'Low' 
                          WHEN totalScore BETWEEN 13 AND 19 THEN 'Medium' 
                          WHEN totalScore BETWEEN 20 AND 25 THEN 'High' 
                      END AS level
                  FROM $tableName
              ) AS subquery
              GROUP BY level";
  }

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Error: " . mysqli_error($conn));
  }

  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

// Fetch data for each table
$tables = array("ra7877", "ra9262", "ra9710", "ra11313", "users");
$data = [];
foreach ($tables as $table) {
  $data[$table] = fetchData($table, $conn);
}

// Return the data as JSON
echo json_encode($data);
session_start();
