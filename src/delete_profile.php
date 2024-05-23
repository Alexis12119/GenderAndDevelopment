<?php
include '../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $profileID = $_POST['profileID'];

  $query = "DELETE FROM profiles WHERE profileID='$profileID'";

  if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => 'Profile deleted successfully']);
  } else {
    echo json_encode(['error' => 'Failed to delete profile']);
  }
} else {
  echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
