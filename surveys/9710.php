<?php
include '../config.php';
session_start();
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
    .radio-inline {
      margin-right: 100px;
      padding-left: 25px;
    }

    input[type="radio"] {
      transform: scale(1);
    }

    p {
      font-size: 3vh;
      font-weight: bold;
      padding-top: 50px;
    }

    label {
      font-size: 3vh;
    }

    body {
      background: #e0aaff;
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
        <label>1. Are you aware that Discrimination Against Women refers to any gender-based distinction which has the purpose of impairing the recognition, enjoyment, or exercise by women, of human rights and fundamental freedoms in the political, economic, social, cultural, civil, or any other field?</label><br />
        <label class="radio-inline"><input type="radio" name="question1" value="1" /><br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question1" value="2" /><br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question1" value="3" /><br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question1" value="4" /><br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question1" value="5" /><br /> 5</label>
      </div>

      <div class="form-group">
        <label>2. Are you aware that discrimination against women under marginalized sectors such as Small Farmers and Fisherfolk is punishable under this act?</label><br />
        <label class="radio-inline"><input type="radio" name="question2" value="1" /><br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question2" value="2" /><br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question2" value="3" /><br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question2" value="4" /><br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question2" value="5" /><br /> 5</label>
      </div>

      <div class="form-group">
        <label>3. Are you aware that pregnancy as a reason for expulsion from institutions or prohibition for enrollment is outlawed by this Act?</label><br />
        <label class="radio-inline"><input type="radio" name="question3" value="1" /><br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question3" value="2" /><br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question3" value="3" /><br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question3" value="4" /><br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question3" value="5" /><br /> 5</label>
      </div>

      <div class="form-group">
        <label>4. Are you aware that denied promotions and unequal compensations in the work environment arising from being a woman is punishable under this act?</label><br />
        <label class="radio-inline"><input type="radio" name="question4" value="1" /><br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question4" value="2" /><br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question4" value="3" /><br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question4" value="4" /><br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question4" value="5" /><br /> 5</label>
      </div>

      <div class="form-group">
        <label>5. Are you aware that women have leave benefits of 105 days with full pay based on gross monthly compensation for women employees who undergo surgery caused by gynecological disorders, provided that they have rendered continuous aggregate employment service of at least six (6) months for the last twelve (12) months?</label><br />
        <label class="radio-inline"><input type="radio" name="question5" value="1" /><br /> 1</label>
        <label class="radio-inline"><input type="radio" name="question5" value="2" /><br /> 2</label>
        <label class="radio-inline"><input type="radio" name="question5" value="3" /><br /> 3</label>
        <label class="radio-inline"><input type="radio" name="question5" value="4" /><br /> 4</label>
        <label class="radio-inline"><input type="radio" name="question5" value="5" /><br /> 5</label>
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
        $sql = "INSERT INTO ra9710 (email, totalScore)
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
