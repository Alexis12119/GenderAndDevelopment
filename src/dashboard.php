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
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

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
  </script>
</body>

</html>

<?php
mysqli_close($conn);
?>
