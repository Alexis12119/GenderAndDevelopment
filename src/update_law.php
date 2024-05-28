
<?php
include '../utils/config.php';

$lawID = $_POST['lawID'];
$email = $_POST['email'];

$query = "UPDATE law SET email = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $email, $lawID);

$response = [];
if ($stmt->execute()) {
    $response['success'] = "Email updated successfully.";
} else {
    $response['error'] = "Failed to update email.";
}

echo json_encode($response);
?>
