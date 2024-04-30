<?php
include '../config.php';
session_start();

// Initialize error and success flags
$error = false;
$success = false;
$error_message = "";

if (isset($_POST['law'])) {
  // Retrieve form data
  $email = $_POST["email"];
  $question1 = $_POST["question1"];
  $question2 = $_POST["question2"];
  $question3 = $_POST["question3"];
  $question4 = $_POST["question4"];
  $question5 = $_POST["question5"];

  // Check if the email is already used
  $query = "SELECT email FROM ra7877 WHERE email = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $rows = mysqli_stmt_num_rows($stmt);

  if ($rows > 0) {
    // Set error flag and message
    $error = true;
    $error_message = "Email already used! Please use a different email.";
    mysqli_stmt_close($stmt);
  } else {
    $totalScore = $question1 + $question2 + $question3 + $question4 + $question5;

    // Prepare SQL statement with a placeholder for the values
    $sql = "INSERT INTO ra7877 (email, totalScore) VALUES (?, ?)";

    // Initialize a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "si", $email, $totalScore);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
      // Set success flag
      $success = true;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/img/logo.png" />
  <title>Gender and Development Survey</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <style>
    body {
      background: #e0aaff;
    }

    .error-message {
      font-size: 3vh;
      color: #3f0000;
      padding: 20px 0 0 0;
    }

    .success-message {
      font-size: 3vh;
      padding: 20px 0 0 0;
    }

    .radio-inline {
      margin-right: 100px;
      padding-left: 25px;
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="#">1 - Strongly Agree</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">2 - Agree</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">3 - Neutral</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">4 - Disagree</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">5 - Strongly Disagree</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <form id="surveyForm" method="POST" action="">
      <!-- Survey questions related to the law -->
      <p class="text-center">This is a survey on the level of awareness of respondents on the specified law.</p>
      <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label>1. I am aware that Work, Education or Training-Related, Sexual
          Harassment is committed by an employer, employee, instructor, coach,
          or any person with authority.</label><br />
        <label class="radio-inline"><input type="radio" name="question1" value="1" /> <br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question1" value="2" /> <br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question1" value="3" /> <br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question1" value="4" /> <br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question1" value="5" /> <br /> 5</label>
      </div>

      <div class="form-group">
        <label>2. I am aware that I can file for charges when I am offered favorable
          compensations in exchange of sexual favors.</label><br />
        <label class="radio-inline"><input type="radio" name="question2" value="1" /> <br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question2" value="2" /> <br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question2" value="3" /> <br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question2" value="4" /> <br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question2" value="5" /> <br /> 5</label>
      </div>

      <div class="form-group">
        <label>3. I am aware that I can file for charges when I am denied of
          employment opportunities or privileges unless I submit to sexual
          favors.</label><br />
        <label class="radio-inline"><input type="radio" name="question3" value="1" /> <br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question3" value="2" /> <br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question3" value="3" /> <br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question3" value="4" /> <br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question3" value="5" /> <br /> 5</label>
      </div>

      <div class="form-group">
        <label>4. I am aware that any person who directs or induces another to commit
          any act of sexual harassment is held liable under RA 7877.</label><br />
        <label class="radio-inline"><input type="radio" name="question4" value="1" /> <br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question4" value="2" /> <br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question4" value="3" /> <br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question4" value="4" /> <br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question4" value="5" /> <br /> 5</label>
      </div>

      <div class="form-group">
        <label>5. I am aware that any person who cooperates in an act of sexual
          harassment is held liable under RA 7877.</label><br />
        <label class="radio-inline"><input type="radio" name="question5" value="1" /> <br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question5" value="2" /> <br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question5" value="3" /> <br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question5" value="4" /> <br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question5" value="5" /> <br /> 5</label>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
</body>

</html>
