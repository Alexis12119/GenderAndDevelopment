<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="website icon" href="../assets/img/logo.png" />
  <title>Gender and Development Survey</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <style>
    body {
      background: #E0AAFF;
    }

    .success-message {
      font-size: 3vh;
      padding: 20px 0 0 0;
    }

    .radio-inline {
      margin-right: 100px;
      padding-left: 25px;
    }

    .modal-body {
      font-size: 3vh;
      color: #3F0000;
    }

    .modal-content {
      background: #8f6dd1;
      border-color: #5b48a2;
      margin: 15% auto;
      padding: 20px;
      width: 80%;
    }

    input[type="radio"] {
      transform: scale(2);
    }

    p {
      font-size: 3vh;
      font-weight: bold;
      padding-top: 50px;
    }

    label {
      font-size: 3vh;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-check-label {
      margin-right: 20px;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
      <!-- Flex container to align logo and text -->
      <div class="d-flex align-items-center">
        <!-- Logo -->
        <a class="logo navbar-brand" href="https://www.youtube.com/shorts/SXHMnicI6Pg" target="_blank">
          <img class="rounded-circle" src="../assets/img/logo.png" alt="logo">
        </a>
        <!-- Text alongside the logo -->
        <span class="text ml-2">Gender And Development</span>
      </div>
    </div>
  </nav>


  <div class="container mt-5">
    <form id="surveyForm">
      <!-- Survey questions related to the law -->
      <!-- <p class="text-center">This is a survey on the level of awareness of respondents on the RA 7877.</p> -->
      <!-- <div class="form-group"> -->
      <!--   <label for="email">Email: </label> -->
      <!--   <input type="email" class="form-control" id="email" name="email" required /> -->
      <!-- </div> -->

      <div class="form-group">
        <label for="firstName">First Name: </label>
        <input type="text" class="form-control" id="firstName" name="firstName" required />
      </div>

      <div class="form-group">
        <label for="middleName">Middle Name: </label>
        <input type="text" class="form-control" id="middleName" name="middleName" required />
      </div>

      <div class="form-group">
        <label for="lastName">Last Name: </label>
        <input type="text" class="form-control" id="lastName" name="lastName" required />
      </div>

      <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-control" required>
          <option value="">Select Your Gender</option>
          <option value="1">Man</option>
          <option value="2">Woman</option>
          <option value="3">Transgender</option>
          <option value="4">Asexual</option>
          <option value="5">Gay</option>
          <option value="6">Lesbian</option>
          <option value="7">Bisexual</option>
          <option value="8">Queer/Questioning</option>
        </select>
      </div>

      <div class="form-group">
        <label for="department">Department</label>
        <select id="department" name="department" class="form-control" required>
          <option value="">Select Your Department</option>
          <option value="ccst">College of Computer Studies and Technology</option>
          <option value="coa">College of Accountancy</option>
          <option value="cas">College of Arts And Science</option>
          <option value="cba">College of Business Administration</option>
          <option value="coe">College of Engineering</option>
          <option value="cte">College of Teacher Education</option>
          <option value="chs">College of Allied Health Sciences</option>
          <option value="cthm">College of Tourism And Hospitality Management</option>
        </select>
      </div>


      <button class="btn btn-primary" name="law">
        Submit
      </button><br /><br />
    </form>
  </div>

  <!-- Error Modal -->
  <div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <p class="error-message"><?php echo $error_message; ?></p>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <p class="success-message">Survey submitted successfully!</p>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Script to show error modal if error flag is set -->
  <?php if ($error) : ?>
    <script>
      $(document).ready(function() {
        $('#errorModal').modal('show');
      });
    </script>
  <?php endif; ?>
  <!-- Script to show success modal if success flag is set -->
  <?php if ($success) : ?>
    <script>
      $(document).ready(function() {
        $('#successModal').modal('show');
      });
    </script>
  <?php endif; ?>
  <script>
    $(document).ready(function() {
      $('#surveyForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        console.log(formData);
        // Send form data via AJAX
        $.ajax({
          type: 'POST',
          url: '../utils/genderSubmit.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $('#successModal').modal('show');
              $('#surveyForm')[0].reset();
            } else {
              $('#errorModal .modal-body').text(response.message);
              $('#errorModal').modal('show');
            }
          },
          error: function() {
            $('#errorModal .modal-body').text('An error occurred while processing your request.');
            $('#errorModal').modal('show');
          }
        });
      });
    });
  </script>
</body>

</html>
