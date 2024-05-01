<?php
// Database connection
$servername = "localhost";
$username = "gad_user";
$password = "password";
$database = "gad";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
