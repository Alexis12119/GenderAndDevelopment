<?php
include '../utils/delete_profile.php';

$lawID = $_POST['lawID'];

$query = "DELETE FROM law WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lawID);

$response = [];
if ($stmt->execute()) {
    $response['success'] = "Law entry deleted successfully.";
} else {
    $response['error'] = "Failed to delete law entry.";
}

echo json_encode($response);
?>
