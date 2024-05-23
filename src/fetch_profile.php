<?php
include '../utils/config.php';

if (isset($_GET['profileID'])) {
    $profileID = $_GET['profileID'];
    $query = "SELECT profileID, firstName, middleName, lastName, genderID, departmentCode FROM profiles WHERE profileID = $profileID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Profile not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
?>
