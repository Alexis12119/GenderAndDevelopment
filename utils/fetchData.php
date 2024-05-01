<?php
include 'config.php';

// Function to execute a query and fetch results
function fetchData($tableName, $conn)
{
  $query = "SELECT level, COUNT(*) AS count 
              FROM (
                  SELECT 
                      CASE 
                          WHEN totalScore BETWEEN 5 AND 15 THEN 'Low' 
                          WHEN totalScore BETWEEN 16 AND 20 THEN 'Medium' 
                          WHEN totalScore BETWEEN 21 AND 25 THEN 'High' 
                      END AS level
                  FROM $tableName
              ) AS subquery
              GROUP BY level";

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
$tables = array("ra7877", "ra9262", "ra9710", "ra11313");
$data = [];
foreach ($tables as $table) {
  $data[$table] = fetchData($table, $conn);
}

// Return the data as JSON
echo json_encode($data);
session_start();
