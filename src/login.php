<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="website icon" href="../assets/img/logo.png" />
  <title>Login - Gender and Development</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .login-container {
      margin-top: 100px;
    }

    .login-form {
      background: linear-gradient(to right,
          #6c5ce7,
          #a44cf2);
      /* Gradient background for buttons */
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-form h2 {
      margin-bottom: 20px;
      text-align: center;
    }

    .login-form .form-group {
      margin-bottom: 20px;
    }

    .login-form label {
      font-weight: 600;
    }

    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ced4da;
    }

    .login-form .btn-login {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      background: linear-gradient(to right,
          #091379,
          #a41e8d);
      /* Darker gradient on hover */

      color: #fff;
      font-weight: 600;
      border: none;
      cursor: pointer;
    }

    .login-form .btn-login:hover {
      background-color: #5b48a2;
    }

    .login-form .btn-back {
      margin-top: 10px;
      text-align: center;
    }

    .login-form .btn-back a {
      color: #fff;
      text-decoration: none;
    }

    .login-form .btn-back a:hover {
      color: #343a40;
    }
  </style>
</head>

<body>

  <div class="container-lg login-container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="login-form">
          <h2>Login(Admin Only)</h2>
          <form id="loginForm">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <input type="password" id="password" name="password" required>
              </div>
            </div>
            <button type="button" id="loginBtn" class="btn btn-login">Login</button>
          </form>
          <div class="btn-back">
            <a href="../index.php">Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Function to handle form submission via AJAX
      $("#loginBtn").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        var userType = $("#userType").val();

        // AJAX request
        $.ajax({
          url: "../utils/loginSubmit.php",
          type: "POST",
          data: {
            username: username,
            password: password,
            userType: userType
          },
          success: function(response) {
            // Check response from server
            if (response.success) {
              // Redirect to dashboard or another page
              window.location.href = "../src/dashboard.php";
            } else {
              // Display error message
              alert(response.message);
            }
          },
          error: function() {
            alert("Error occurred while processing your request.");
          }
        });
      });
    });
  </script>
</body>

</html>
