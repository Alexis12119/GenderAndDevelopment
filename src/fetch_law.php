<?php
include '../utils/config.php';

$lawID = $_GET['lawID'];

$query = "SELECT law.id, law.email 
          FROM law 
          WHERE law.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lawID);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
?>
