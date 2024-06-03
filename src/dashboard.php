<?php
include 'tables.php';
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
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Dashboard</title>
  <style>
    body {
      font-family: 'Popper', sans-serif;
      margin: 0;
      padding: 0;
    }

    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      top: 0;
      left: 0;
      background: linear-gradient(to bottom, #091379, #a41e8d);
      padding-top: 20px;
      overflow-x: hidden;
      transition: width 0.5s;
      z-index: 1000;
    }

    .sidebar.open {
      width: 250px;
    }

    .sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: flex;
      align-items: center;
      transition: background-color 0.3s;
    }

    .sidebar a i {
      margin-right: 10px;
    }

    .sidebar a:hover {
      background: linear-gradient(to right,
          #070b5c,
          #830f6f);
      /* Darker gradient on hover */

    }

    .main {
      margin-left: 0;
      padding: 20px;
      transition: margin-left 0.5s;
    }

    .main.shift {
      margin-left: 250px;
    }

    .table-section {
      display: none;
    }

    .table-section.active {
      display: block;
    }

    .modal-header {
      background: #8f6dd1;
      border-color: #5b48a2;
      color: white;
    }

    .modal-footer .btn-secondary {
      background-color: #6c757d;
    }

    .modal-footer .btn-primary {
      background-color: #007bff;
    }

    .hover-zone {
      position: fixed;
      top: 0;
      left: 0;
      width: 20px;
      height: 100%;
      z-index: 1;
    }

    .search-container {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .search-container input[type="text"] {
      width: 50%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }
  </style>
</head>

<body>
  <!-- Hover Zone to trigger sidebar -->
  <div class="hover-zone" onmouseover="openSidebar()"></div>

  <!-- Sidebar -->
  <div id="sidebar" class="sidebar">
    <div class="sidebar-borderline"></div>
    <a href="#" onclick="showTable('profiles')">Profiles Table</a>
    <a href="#" onclick="showTable('law')">Law Table</a>
    <a href="login.php">Logout</a>
  </div>

  <!-- Main content -->
  <div id="mainContent" class="main">

    <!-- Profiles Table -->
    <section id="profiles" class="table-section">
      <h2 class="text-center" style="color: black">Profiles Table</h2>
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
      <h2 class="text-center" style="color: black">Law Table</h2>
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
          <button type="button" class="btn btn-danger" onclick="deleteLawEntry()">Delete</button>
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
                <?php foreach ($genders as $gender) : ?>
                  <option value="<?php echo $gender['genderID']; ?>"><?php echo $gender['genderName']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="editDepartmentCode">Department:</label>
              <select id="editDepartmentCode" class="form-control" required>
                <?php foreach ($departments as $department) : ?>
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
          <button type="button" class="btn btn-danger" onclick="deleteProfile()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Action completed successfully!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Error Modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Error</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>There was an error completing the action.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS + jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function openSidebar() {
      document.getElementById("sidebar").classList.add("open");
      document.getElementById("mainContent").classList.add("shift");
    }

    function closeSidebar() {
      document.getElementById("sidebar").classList.remove("open");
      document.getElementById("mainContent").classList.remove("shift");
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
      fetch(`../utils/fetch_law.php?lawID=${lawID}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('editLawID').value = data.id;
          document.getElementById('editLawEmail').value = data.email;
        });
    }

    function openEditLawModal(id) {
      const row = document.querySelector(`#lawTable tr[data-id="${id}"]`);
      const email = row.children[1].innerText;
      document.getElementById('editLawID').value = id;
      document.getElementById('editLawEmail').value = email;
      $('#editLawModal').modal('show');
    }

    function updateLawEntry() {
      var lawID = document.getElementById('editLawID').value;
      var email = document.getElementById('editLawEmail').value;

      fetch('../utils/update_law.php', {
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
            $('#successModal').modal('show');
            updateLawTableRow(lawID, email);
            $('#editLawModal').modal('hide');
          } else {
            $('#errorModal').modal('show');
          }
        });
    }

    function openDeleteLawModal(id) {
      document.getElementById('deleteLawID').value = id;
      $('#deleteLawModal').modal('show');
    }

    function deleteLawEntry() {
      var lawID = document.getElementById('deleteLawID').value;

      fetch('../utils/delete_law.php', {
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
            $('#successModal').modal('show');
            removeLawTableRow(lawID);
            $('#deleteLawModal').modal('hide');
          } else {
            $('#errorModal').modal('show');
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

    function openEditModal(modalId, id) {
      const row = document.querySelector(`#profilesTable tr[data-id="${id}"]`);
      const fullName = row.children[1].innerText;
      const gender = row.children[2].innerText;
      const department = row.children[3].innerText;

      document.getElementById('editProfileID').value = id;
      document.getElementById('editFullName').value = fullName;
      document.getElementById('editGender').value = getOptionValueByText('editGender', gender);
      document.getElementById('editDepartment').value = getOptionValueByText('editDepartment', department);

      $(`#${modalId}`).modal('show');
    }

    function updateProfile() {
      const id = document.getElementById('editProfileID').value;
      const fullName = document.getElementById('editFullName').value;
      const genderID = document.getElementById('editGender').value;
      const departmentCode = document.getElementById('editDepartment').value;

      $.ajax({
        url: '../utils/update_profile.php',
        method: 'POST',
        data: {
          id,
          fullName,
          genderID,
          departmentCode
        },
        success: function(response) {
          if (response.success) {
            $('#successModal').modal('show');
            location.reload();
          } else {
            $('#errorModal').modal('show');
          }
        }
      });
    }

    function openDeleteModal(modalId, id) {
      document.getElementById('deleteProfileID').value = id;
      $(`#${modalId}`).modal('show');
    }

    function getOptionValueByText(selectId, text) {
      const options = document.getElementById(selectId).options;
      for (let i = 0; i < options.length; i++) {
        if (options[i].text === text) {
          return options[i].value;
        }
      }
      return null;
    }

    document.addEventListener('DOMContentLoaded', function() {
      const lastActiveSection = localStorage.getItem('lastActiveSection');
      if (lastActiveSection) {
        showTable(lastActiveSection);
      } else {
        showTable('profiles'); // Default to 'profiles' section if no section is stored
      }
    });

    function showTable(tableId) {
      const sections = document.querySelectorAll('.table-section');
      sections.forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(tableId).classList.add('active');
      localStorage.setItem('lastActiveSection', tableId);
    }

    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.getElementById('mainContent');
      if (!sidebar.contains(event.target) && !mainContent.contains(event.target)) {
        closeSidebar();
      }
    });

    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const sidebarBorderline = document.querySelector('.sidebar-borderline');

      sidebarBorderline.addEventListener('mouseenter', function() {
        openSidebar();
      });

      sidebar.addEventListener('mouseleave', function(event) {
        if (!isMouseOverBorderline(event)) {
          closeSidebar();
        }
      });
    });

    function isMouseOverBorderline(event) {
      const sidebarBorderline = document.querySelector('.sidebar-borderline');
      const bounding = sidebarBorderline.getBoundingClientRect();
      const mouseX = event.clientX;
      const mouseY = event.clientY;

      return (
        mouseX >= bounding.left &&
        mouseX <= bounding.right &&
        mouseY >= bounding.top &&
        mouseY <= bounding.bottom
      );
    }

    function deleteProfile() {
      var profileID = document.getElementById('deleteProfileID').value;

      fetch('../utils/delete_profile.php', {
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
            $('#successModal').modal('show');
            removeTableRow(profileID);
            closeModal('deleteProfileModal');
          } else {
            alert(data.error);
            $('#errorModal').modal('show');
          }
        });
    }

    function closeModal(modalId) {
      var modal = document.getElementById(modalId);
      $(modal).modal('hide');
    }

    function removeTableRow(profileID) {
      const row = document.querySelector(`#profilesTable tr[data-id='${profileID}']`);
      if (row) {
        row.remove();
      }
    }
    const genderMap = {
      <?php foreach ($genders as $gender) { ?> '<?php echo $gender['genderID']; ?>': '<?php echo $gender['genderName']; ?>',
      <?php } ?>
    };

    const departmentMap = {
      <?php foreach ($departments as $department) { ?> '<?php echo $department['departmentCode']; ?>': '<?php echo $department['departmentName']; ?>',
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

    function updateProfile() {
      var profileID = document.getElementById('editProfileID').value;
      var firstName = document.getElementById('editFirstName').value;
      var middleName = document.getElementById('editMiddleName').value;
      var lastName = document.getElementById('editLastName').value;
      var genderID = document.getElementById('editGenderID').value;
      var departmentCode = document.getElementById('editDepartmentCode').value;

      fetch('../utils/update_profile.php', {
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
            $('#successModal').modal('show');
            updateTableRow(profileID, firstName, middleName, lastName, genderID, departmentCode);
            closeModal('editProfileModal');
          } else {
            $('#errorsModal').modal('show');
          }
        });
    }

    function openEditModal(modalId, profileID) {
      var modal = document.getElementById(modalId);
      $(modal).modal('show');

      // Fetch profile data
      fetch(`../utils/fetch_profile.php?profileID=${profileID}`)
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
  </script>
</body>

</html>
