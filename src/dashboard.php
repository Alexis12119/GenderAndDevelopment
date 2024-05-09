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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="website icon" href="../assets/img/logo.png" />
  <title>Dashboard</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Popper&display=swap');

    body {
      font-family: 'Popper', sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Sidebar styles */
    .sidebar {
      height: 100%;
      width: 200px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #111;
      padding-top: 20px;
    }

    .sidebar a {
      padding: 10px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
    }

    .sidebar a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Hide all table sections by default */
    .table-section {
      display: none;
    }

    /* Display the active table section */
    .active {
      display: block;
    }

    /* Added styles for table sections */
    .table-section h2 {
      margin-bottom: 10px;
    }

    /* Search input styles */
    .search-container {
      margin-bottom: 10px;
    }

    .search-container input[type=text] {
      padding: 5px;
      margin-top: 5px;
      width: 100%;
      box-sizing: border-box;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="#" onclick="showTable('profiles')">Profiles Table</a>
    <a href="#" onclick="showTable('law')">Law Table</a>
    <a class="nav-link btn btn-primary" href="login.php">Logout</a>
  </div>

  <!-- Page content -->
  <div class="container" style="margin-left: 200px; /* Same width as the sidebar */">
    <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?>!</h1>

    <!-- Profiles Table -->
    <section id="profiles" class="table-section">
      <h2>Profiles Table</h2>
      <div class="search-container">
        <input type="text" id="profilesSearchInput" onkeyup="searchTable('profiles', 'profilesSearchInput')" placeholder="Search for names..">
      </div>
      <table id="profilesTable">
        <!-- Table header -->
        <thead>
          <tr>
            <th>Profile ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- Table body -->
        <tbody>
          <?php
          // Fetch and display data from the profiles query result
          while ($row = mysqli_fetch_assoc($profiles_result)) {
            echo "<tr>";
            echo "<td>{$row['profileID']}</td>";
            echo "<td>{$row['FullName']}</td>";
            echo "<td>{$row['genderName']}</td>";
            echo "<td>{$row['departmentName']}</td>";
            echo "<td><button onclick='openEditModal(\"editProfileModal\", {$row['profileID']})'>Edit</button> | <button onclick='openDeleteModal(\"deleteProfileModal\", {$row['profileID']})'>Delete</button></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Law Table -->
    <section id="law" class="table-section">
      <h2>Law Table</h2>
      <div class="search-container">
        <input type="text" id="lawSearchInput" onkeyup="searchTable('law', 'lawSearchInput')" placeholder="Search for names..">
      </div>
      <table id="lawTable">
        <!-- Table header -->
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Total Score</th>
            <th>Law Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- Table body -->
        <tbody>
          <?php
          // Fetch and display data from the law query result
          while ($row = mysqli_fetch_assoc($law_result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['totalScore']}</td>";
            echo "<td>{$row['lawName']}</td>";
            echo "<td><button onclick='openEditModal(\"editLawModal\", {$row['id']})'>Edit</button> | <button onclick='openDeleteModal(\"deleteLawModal\", {$row['id']})'>Delete</button></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

  </div>

  <!-- Edit and Delete Modals -->
  <div id="editProfileModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('editProfileModal')">&times;</span>
      <h2>Edit Profile</h2>
      <!-- Edit form content goes here -->
    </div>
  </div>

  <div id="deleteProfileModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('deleteProfileModal')">&times;</span>
      <h2>Delete Profile</h2>
      <!-- Delete confirmation message goes here -->
      <p>Are you sure you want to delete this profile?</p>
      <button onclick="deleteProfile()">Delete</button>
    </div>
  </div>

  <div id="editLawModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('editLawModal')">&times;</span>
      <h2>Edit Law</h2>
      <!-- Edit form content goes here -->
    </div>
  </div>

  <div id="deleteLawModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('deleteLawModal')">&times;</span>
      <h2>Delete Law</h2>
      <!-- Delete confirmation message goes here -->
      <p>Are you sure you want to delete this law?</p>
      <button onclick="deleteLaw()">Delete</button>
    </div>
  </div>
  <script>
    // Function to show the selected table section and hide others
    function showTable(sectionId) {
      // Hide all table sections
      var sections = document.querySelectorAll('.table-section');
      sections.forEach(function(section) {
        section.classList.remove('active');
      });

      // Show the selected table section
      var selectedSection = document.getElementById(sectionId);
      selectedSection.classList.add('active');
    }

    // Function to filter table rows based on search input
    function searchTable(sectionId, inputId) {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById(inputId);
      filter = input.value.toUpperCase();
      table = document.getElementById(sectionId + 'Table');
      tr = table.getElementsByTagName('tr');

      // Loop through all table rows, and hide those that don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td');
        for (var j = 0; j < td.length; j++) {
          if (td[j]) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
              break; // Show the row if a match is found
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }
    }

    // Function to open edit modal
    function openEditModal(modalId, itemId) {
      var modal = document.getElementById(modalId);
      modal.style.display = "block";
      // Logic to fetch item data and populate edit form goes here
    }

    // Function to open delete modal
    function openDeleteModal(modalId, itemId) {
      var modal = document.getElementById(modalId);
      modal.style.display = "block";
      // Set itemId in a hidden input field in the delete modal for reference
      var deleteForm = modal.querySelector('form');
      deleteForm.querySelector('input[name="itemId"]').value = itemId;
    }

    // Function to close modal
    function closeModal(modalId) {
      var modal = document.getElementById(modalId);
      modal.style.display = "none";
    }

    // Function to delete profile (You need to implement this)
    function deleteProfile() {
      var itemId = document.getElementById('deleteProfileModal').querySelector('input[name="itemId"]').value;
      // Your delete profile logic here
      console.log("Deleting profile with ID: " + itemId);
    }

    // Function to delete law (You need to implement this)
    function deleteLaw() {
      var itemId = document.getElementById('deleteLawModal').querySelector('input[name="itemId"]').value;
      // Your delete law logic here
      console.log("Deleting law with ID: " + itemId);
    }
  </script>
</body>

</html>

<?php
mysqli_close($conn);
?>
