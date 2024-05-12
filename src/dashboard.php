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
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <title>Dashboard</title>
  <style>
    body {
      font-family: 'Popper', sans-serif;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.5);
      /* Normal color */
    }

    .navbar-dark .navbar-nav .nav-link:hover {
      color: #fff;
      /* Hover color */
    }

    .navbar-dark .navbar-nav .nav-item.active .nav-link {
      color: #fff;
      text-decoration: underline;
      text-underline-offset: 0.2em;
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
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Flex container to align logo and text -->
      <div class="d-flex align-items-center">
        <!-- Logo -->
        <a class="logo navbar-brand" href="https://www.youtube.com/shorts/SXHMnicI6Pg" target="_blank">
          <img class="rounded-circle" src="../assets/img/logo.png" alt="logo">
        </a>
        <!-- Text alongside the logo -->
        <span class="text ml-2">Dashboard</span>
      </div>
      <!-- Navbar toggler for smaller screens -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar items -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" id="profilesNavItem">
            <a class="nav-link text-center" href="#profiles" onclick="showTable('profiles')">Profiles Table</a>
          </li>
          <li class="nav-item" id="lawNavItem">
            <a class="nav-link text-center" href="#law" onclick="showTable('law')">Law Table</a>
          </li>
          <li class="nav-item" id="logoutNavItem" style="background: linear-gradient(to right, #091379, #a41e8d);">
            <a class="nav-link btn btn-primary text-center" href="login.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Page content -->
  <div class="container" style="margin-top: 60px;"> <!-- Adjust margin-top to fit navbar height -->
    <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?>!</h1></br></br>

    <!-- Profiles Table -->
    <section id="profiles" class="table-section">
      <h2>Profiles Table</h2>
      <div class="search-container">
        <input type="text" id="profilesSearchInput" onkeyup="searchTable('profiles', 'profilesSearchInput')" placeholder="Search for names..">
      </div>
      <table id="profilesTable" class="table table-striped">
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
            echo "<td><button onclick='openEditModal(\"editProfileModal\", {$row['profileID']})' class='btn btn-primary'>Edit</button> | <button onclick='openDeleteModal(\"deleteProfileModal\", {$row['profileID']})' class='btn btn-danger'>Delete</button></td>";
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
      <table id="lawTable" class="table table-striped">
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
            echo "<td><button onclick='openEditModal(\"editLawModal\", {$row['id']})' class='btn btn-primary'>Edit</button> | <button onclick='openDeleteModal(\"deleteLawModal\", {$row['id']})' class='btn btn-danger'>Delete</button></td>";
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
      <button onclick="deleteProfile()" class="btn btn-danger">Delete</button>
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
      <button onclick="deleteLaw()" class="btn btn-danger">Delete</button>
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
  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>

</html>

<?php
mysqli_close($conn);
?>
