<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Include database connection
include '../utils/config.php';

// Retrieve data from the 'law' table
$law_query = "SELECT law.id, law.email, law.totalScore, lawname.lawName 
              FROM law 
              INNER JOIN lawname ON law.lawCode = lawname.lawCode";
$law_result = mysqli_query($conn, $law_query);

// Retrieve data from the 'profiles' table
$profiles_query = "SELECT profiles.profileID, CONCAT(profiles.firstName, ' ', profiles.middleName, ' ', profiles.lastName) AS `FullName`, gender.genderName, department.departmentName 
                   FROM profiles 
                   INNER JOIN gender ON profiles.genderID = gender.genderID 
                   INNER JOIN department ON profiles.departmentCode = department.departmentCode";
$profiles_result = mysqli_query($conn, $profiles_query);

// Retrieve gender data
$gender_query = "SELECT genderID, genderName FROM gender";
$gender_result = mysqli_query($conn, $gender_query);
$genders = [];
while ($row = mysqli_fetch_assoc($gender_result)) {
  $genders[] = $row;
}

// Retrieve department data
$department_query = "SELECT departmentCode, departmentName FROM department";
$department_result = mysqli_query($conn, $department_query);
$departments = [];
while ($row = mysqli_fetch_assoc($department_result)) {
  $departments[] = $row;
}
?>


