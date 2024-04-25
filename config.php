
<?php
// Database connection
$servername = "localhost";
$username = "gad_user"; // Your MySQL username
$password = "password"; // Your MySQL password
$database = "gad"; // Your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
