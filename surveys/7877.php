<?php
include '../config.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gender and Development Survey</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../styles.css" />
  <style>
    body {
      background: #e0aaff;
    }

    .radio-inline {
      margin-right: 100px;
    }

    input[type="radio"] {
      height: 20px;
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

    .btn-primary {
      background: linear-gradient(to right, #6c5ce7, #a44cf2);
      border-color: #6c5ce7;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #5b48a2, #8f6dd1);
      border-color: #5b48a2;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <!-- <a class="navbar-brand" href="#">Repubic Act of 1995</a> -->
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
        <label class="radio-inline"><input type="radio" name="question1" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question1" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question1" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question1" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question1" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>2. I am aware that I can file for charges when I am offered favorable
          compensations in exchange of sexual favors.</label><br />
        <label class="radio-inline"><input type="radio" name="question2" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question2" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question2" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question2" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question2" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>3. I am aware that I can file for charges when I am denied of
          employment opportunities or privileges unless I submit to sexual
          favors.</label><br />
        <label class="radio-inline"><input type="radio" name="question3" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question3" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question3" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question3" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question3" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>4. I am aware that any person who directs or induces another to commit
          any act of sexual harassment is held liable under RA 7877.</label><br />
        <label class="radio-inline"><input type="radio" name="question4" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question4" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question4" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question4" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question4" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>5. I am aware that any person who cooperates in an act of sexual
          harassment is held liable under RA 7877.</label><br />
        <label class="radio-inline"><input type="radio" name="question5" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question5" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question5" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question5" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question5" value="5" /> 5</label>
      </div>

      <button class="btn btn-primary" name="law">
        Submit
      </button><br /><br />
      <?php
      if (isset($_POST['law'])) {
        // Retrieve form data
        $email = $_POST["email"];
        $question1 = $_POST["question1"];
        $question2 = $_POST["question2"];
        $question3 = $_POST["question3"];
        $question4 = $_POST["question4"];
        $question5 = $_POST["question5"];

        $totalScore = $question1 + $question2 + $question3 + $question4 + $question5;

        // Prepare SQL statement
        $sql = "INSERT INTO ra7877 (email, totalScore)
            VALUES ('$email','$totalScore')";

        $result = mysqli_query($conn, $sql);
      }
      ?>

    </form>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
