<?php
include 'config.php';

// Function to execute a query and fetch results
function fetchData($lawCode, $conn)
{
  // For rights-related data
  $query = "SELECT level, COUNT(*) AS count 
              FROM (
                  SELECT 
                      CASE 
                          WHEN totalScore BETWEEN 5 AND 12 THEN 'Low' 
                          WHEN totalScore BETWEEN 13 AND 19 THEN 'Medium' 
                          WHEN totalScore BETWEEN 20 AND 25 THEN 'High' 
                      END AS level
                  FROM law
                  WHERE lawCode = $lawCode
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

// Fetch data for each law code
$lawCodes = array(7877, 9262, 9710, 11313);
$data = [];
foreach ($lawCodes as $lawCode) {
  $data[$lawCode] = fetchData($lawCode, $conn);
}

// Return the data as JSON
echo json_encode($data);
session_start();
