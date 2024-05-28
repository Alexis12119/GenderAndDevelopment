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

    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #111;
      padding-top: 20px;
    }

    .sidebar a {
      padding: 15px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
    }

    .sidebar a:hover {
      background-color: #575757;
    }

    .main {
      margin-left: 260px;
      padding: 20px;
    }

    .table-section {
      display: none;
    }

    .table-section.active {
      display: block;
    }

    /* Custom Modal Styles */
    .modal-header {
      background-color: #007bff;
      color: white;
    }

    .modal-footer .btn-secondary {
      background-color: #6c757d;
    }

    .modal-footer .btn-primary {
      background-color: #007bff;
    }
        .sidebar {
            /* Keep the sidebar collapsed by default */
            width: 0;
            overflow-x: hidden;
            transition: width 0.5s;
        }

        .sidebar.open {
            width: 250px; /* Set the width when sidebar is open */
        }

        /* Main content styles */
        .main {
            /* Adjust the margin to accommodate the sidebar */
            margin-left: 0;
            transition: margin-left 0.5s;
        }

        .main.shift {
            margin-left: 250px; /* Shift the main content when sidebar is open */
        }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div id="sidebar" class="sidebar">
    <a href="#" onclick="showTable('profiles')">Profiles Table</a>
    <a href="#" onclick="showTable('law')">Law Table</a>
    <a href="login.php" style="background: linear-gradient(to right, #091379, #a41e8d);">Logout</a>
  </div>

  <!-- Main content -->
  <div id="mainContent" class="main">
        <button onclick="toggleSidebar()">Open/Close</button>
    <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?>!</h1>

    <!-- Profiles Table -->
    <section id="profiles" class="table-section">
      <h2>Profiles Table</h2>
      <div class="search-container">
        <input type="text" id="profilesSearchInput" onkeyup="searchTable('profiles', 'profilesSearchInput')" placeholder="Search for names..">
      </div>
      <table id="profilesTable" class="table table-striped">
        <thead>
          <tr>
            <th>Profile ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($profiles_result)) {
            echo "<tr data-id='{$row['profileID']}'>";
            echo "<td>{$row['profileID']}</td>";
            echo "<td>{$row['FullName']}</td>";
            echo "<td>{$row['genderName']}</td>";
            echo "<td>{$row['departmentName']}</td>";
            echo "<td>
        <button onclick='openEditModal(\"editProfileModal\", {$row['profileID']})' class='btn btn-primary'>Edit</button> | 
        <button onclick='openDeleteModal(\"deleteProfileModal\", {$row['profileID']})' class='btn btn-danger'>Delete</button>
      </td>";
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
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Total Score</th>
                <th>Law Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($law_result)) {
                echo "<tr data-id='{$row['id']}'>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['totalScore']}</td>";
                echo "<td>{$row['lawName']}</td>";
                echo "<td>
                    <button onclick='openEditLawModal({$row['id']})' class='btn btn-primary'>Edit</button> | 
                    <button onclick='openDeleteLawModal({$row['id']})' class='btn btn-danger'>Delete</button>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>

  </div>

<!-- Edit Law Modal -->
<div class="modal fade" id="editLawModal" tabindex="-1" aria-labelledby="editLawModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLawModalLabel">Edit Law Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="event.preventDefault(); updateLawEntry();">
                    <input type="hidden" id="editLawID">
                    <div class="form-group">
                        <label for="editLawEmail">Email:</label>
                        <input type="email" id="editLawEmail" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Law Modal -->
<div class="modal fade" id="deleteLawModal" tabindex="-1" aria-labelledby="deleteLawModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLawModalLabel">Delete Law Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this law entry?</p>
                <input type="hidden" id="deleteLawID">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button onclick="deleteLawEntry()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="event.preventDefault(); updateProfile();">
                    <input type="hidden" id="editProfileID">
                    <div class="form-group">
                        <label for="editFirstName">First Name:</label>
                        <input type="text" id="editFirstName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editMiddleName">Middle Name:</label>
                        <input type="text" id="editMiddleName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name:</label>
                        <input type="text" id="editLastName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editGenderID">Gender:</label>
                        <select id="editGenderID" class="form-control" required>
                            <?php foreach ($genders as $gender): ?>
                                <option value="<?php echo $gender['genderID']; ?>"><?php echo $gender['genderName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDepartmentCode">Department:</label>
                        <select id="editDepartmentCode" class="form-control" required>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department['departmentCode']; ?>"><?php echo $department['departmentName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Delete Profile Modal -->
  <div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-labelledby="deleteProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProfileModalLabel">Delete Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this profile?</p>
          <input type="hidden" id="deleteProfileID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button onclick="deleteProfile()" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function openEditModal(modalId, profileID) {
      var modal = document.getElementById(modalId);
      $(modal).modal('show');

      // Fetch profile data
      fetch(`fetch_profile.php?profileID=${profileID}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('editProfileID').value = data.profileID;
          document.getElementById('editFirstName').value = data.firstName;
          document.getElementById('editMiddleName').value = data.middleName;
          document.getElementById('editLastName').value = data.lastName;
          document.getElementById('editGenderID').value = data.genderID;
          document.getElementById('editDepartmentCode').value = data.departmentCode;
        });
    }

    function openDeleteModal(modalId, profileID) {
      var modal = document.getElementById(modalId);
      $(modal).modal('show');
      document.getElementById('deleteProfileID').value = profileID;
    }

    function closeModal(modalId) {
      var modal = document.getElementById(modalId);
      $(modal).modal('hide');
    }

    function updateProfile() {
      var profileID = document.getElementById('editProfileID').value;
      var firstName = document.getElementById('editFirstName').value;
      var middleName = document.getElementById('editMiddleName').value;
      var lastName = document.getElementById('editLastName').value;
      var genderID = document.getElementById('editGenderID').value;
      var departmentCode = document.getElementById('editDepartmentCode').value;

      fetch('update_profile.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            profileID,
            firstName,
            middleName,
            lastName,
            genderID,
            departmentCode
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert(data.success);
            updateTableRow(profileID, firstName, middleName, lastName, genderID, departmentCode);
            closeModal('editProfileModal');
          } else {
            alert(data.error);
          }
        });
    }

const genderMap = {
  <?php foreach ($genders as $gender) { ?>
    '<?php echo $gender['genderID']; ?>': '<?php echo $gender['genderName']; ?>',
  <?php } ?>
};

const departmentMap = {
  <?php foreach ($departments as $department) { ?>
    '<?php echo $department['departmentCode']; ?>': '<?php echo $department['departmentName']; ?>',
  <?php } ?>
};

function updateTableRow(profileID, firstName, middleName, lastName, genderID, departmentCode) {
  const row = document.querySelector(`#profilesTable tr[data-id='${profileID}']`);
  if (row) {
    row.cells[1].textContent = `${firstName} ${middleName} ${lastName}`;
    row.cells[2].textContent = genderMap[genderID];
    row.cells[3].textContent = departmentMap[departmentCode];
  }
}

    function deleteProfile() {
      var profileID = document.getElementById('deleteProfileID').value;

      fetch('delete_profile.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            profileID
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert(data.success);
            removeTableRow(profileID);
            closeModal('deleteProfileModal');
          } else {
            alert(data.error);
          }
        });
    }

    function removeTableRow(profileID) {
      const row = document.querySelector(`#profilesTable tr[data-id='${profileID}']`);
      if (row) {
        row.remove();
      }
    }

    function showTable(tableId) {
      // Hide all table sections
      var sections = document.querySelectorAll('.table-section');
      sections.forEach(section => section.classList.remove('active'));

      // Show the selected table section
      var selectedSection = document.getElementById(tableId);
      selectedSection.classList.add('active');
    }

    function searchTable(tableId, inputId) {
      var input, filter, table, tr, td, i, j, txtValue;
      input = document.getElementById(inputId);
      filter = input.value.toLowerCase();
      table = document.getElementById(tableId + 'Table');
      tr = table.getElementsByTagName('tr');

      for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        tr[i].style.display = 'none';
        td = tr[i].getElementsByTagName('td');
        for (j = 0; j < td.length; j++) {
          if (td[j]) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
              break;
            }
          }
        }
      }
    }

function openEditLawModal(lawID) {
    $('#editLawModal').modal('show');

    // Fetch law data
    fetch(`fetch_law.php?lawID=${lawID}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editLawID').value = data.id;
            document.getElementById('editLawEmail').value = data.email;
        });
}

function openDeleteLawModal(lawID) {
    $('#deleteLawModal').modal('show');
    document.getElementById('deleteLawID').value = lawID;
}

function updateLawEntry() {
    var lawID = document.getElementById('editLawID').value;
    var email = document.getElementById('editLawEmail').value;

    fetch('update_law.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            lawID,
            email
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.success);
            updateLawTableRow(lawID, email);
            $('#editLawModal').modal('hide');
        } else {
            alert(data.error);
        }
    });
}

function deleteLawEntry() {
    var lawID = document.getElementById('deleteLawID').value;

    fetch('delete_law.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            lawID
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.success);
            removeLawTableRow(lawID);
            $('#deleteLawModal').modal('hide');
        } else {
            alert(data.error);
        }
    });
}

function updateLawTableRow(lawID, email) {
    const row = document.querySelector(`#lawTable tr[data-id='${lawID}']`);
    if (row) {
        row.cells[1].textContent = email;
    }
}

function removeLawTableRow(lawID) {
    const row = document.querySelector(`#lawTable tr[data-id='${lawID}']`);
    if (row) {
        row.remove();
    }
}
  </script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('mainContent');
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                mainContent.classList.remove('shift');
            } else {
                sidebar.classList.add('open');
                mainContent.classList.add('shift');
            }
        }
    </script>

<script>
    // Store the active section in session storage
    function setActiveSection(sectionId) {
        sessionStorage.setItem('activeSection', sectionId);
    }

    // Retrieve the active section from session storage
    function getActiveSection() {
        return sessionStorage.getItem('activeSection');
    }

    // Function to show the table section and store the active section
    function showTable(tableId) {
        // Hide all table sections
        var sections = document.querySelectorAll('.table-section');
        sections.forEach(section => section.classList.remove('active'));

        // Show the selected table section
        var selectedSection = document.getElementById(tableId);
        selectedSection.classList.add('active');

        // Store the active section in session storage
        setActiveSection(tableId);
    }

    // Function to set the active section on page load
    window.onload = function() {
        var activeSection = getActiveSection();
        if (activeSection) {
            showTable(activeSection);
        }
    };
</script>
</body>

</html>
