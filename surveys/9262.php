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
    .radio-inline {
      margin-right: 150px;
      /* Adjust the margin as needed */
    }

    body {
      background: #e0aaff;
    }


    /* Add your custom styles here */
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
  <div class="container mt-5">
    <h2>Gender and Development Survey</h2>
    <form id="surveyForm" method="POST" action="">
      <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
      <!-- Survey questions related to the law -->
      <p>This is a survey on the level of awareness of respondents on the specified law.</p>
      <ul>
        <li>1 - Strongly Agree</li>
        <li>2 - Agree</li>
        <li>3 - Neutral</li>
        <li>4 - Disagree</li>
        <li>5 - Strong Disagree</li>
      </ul>


      <div class="form-group">
        <label>1. Are you aware of RA 9262: Violence against women law?</label><br />
        <label class="radio-inline"><input type="radio" name="question1" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question1" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question1" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question1" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question1" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>2. Are you aware of the process to get a BPO/TPO/PPO whenever you or someone you know committed a crime covered under VAWC?</label><br />
        <label class="radio-inline"><input type="radio" name="question2" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question2" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question2" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question2" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question2" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>3. Do you know that VAWC is not committed by men alone?</label><br />
        <label class="radio-inline"><input type="radio" name="question3" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question3" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question3" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question3" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question3" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>4. Do you know that VAWC includes physical, sexual, psychological violence, and economic abuse against women and children?</label><br />
        <label class="radio-inline"><input type="radio" name="question4" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question4" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question4" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question4" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question4" value="5" /> 5</label>
      </div>

      <div class="form-group">
        <label>5. Are you aware that children covered in VAWC are those below 18 years of age or older but are incapable of taking care of themselves?</label><br />
        <label class="radio-inline"><input type="radio" name="question5" value="1" /> 1</label>
        <label class="radio-inline"><input type="radio" name="question5" value="2" /> 2</label>
        <label class="radio-inline"><input type="radio" name="question5" value="3" /> 3</label>
        <label class="radio-inline"><input type="radio" name="question5" value="4" /> 4</label>
        <label class="radio-inline"><input type="radio" name="question5" value="5" /> 5</label>
      </div>

      <button class="btn btn-primary" name="law">
        Submit
      </button>
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
        $sql = "INSERT INTO lawtwo (email, totalScore )
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
