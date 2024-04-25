<?php
include 'config.php';

// Function to execute a query and fetch results
function fetchData($tableName, $conn)
{
  $query = "SELECT level, COUNT(*) AS count 
              FROM (
                  SELECT 
                      CASE 
                          WHEN totalScore BETWEEN 5 AND 15 THEN 'Low' 
                          WHEN totalScore BETWEEN 16 AND 20 THEN 'Medium' 
                          WHEN totalScore BETWEEN 21 AND 25 THEN 'High' 
                      END AS level
                  FROM $tableName
              ) AS subquery
              GROUP BY level";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Error: " . mysqli_error($conn));
  }

  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

// Fetch data for each table
$tables = array("lawone", "lawtwo", "lawthree", "lawfour");
$data = [];
foreach ($tables as $table) {
  $data[$table] = fetchData($table, $conn);
}

session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gender and Development</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css" />
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  </script>
</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Gender & Development</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#rights">Rights</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#statistics">Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br />
  <br />
  <!-- About Section -->
  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">About Gender & Development</h2>
      <p>
        This website aims to raise awareness about gender issues and promote
        gender equality and development. We provide information, resources,
        and support for individuals and organizations working towards gender
        equality.
      </p>
    </div>
  </section>

  <!-- Resources Section with Cards -->
  <section id="rights" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Gender and Development Laws</h2>
      <div class="row">
        <!-- Law 1: Anti-Sexual Harassment Act of 1995 -->
        <div class="col-md-6 mb-4"">
          <div class=" card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              Anti-Sexual Harassment Act of 1995 (RA 7877)
            </h5>
            <p class="card-text flex-grow-1">
              This law aims to protect individuals from sexual harassment in
              the workplace and in educational or training institutions.
            </p>
            <button class="btn btn-primary mt-auto" onclick="openSurvey(7877)">
              Take Survey
            </button>
          </div>
        </div>
      </div>

      <!-- Law 2: Anti-Violence Against Women and their Children -->
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              Anti-Violence Against Women and their Children (RA 9262)
            </h5>
            <p class="card-text flex-grow-1">
              This law provides protection for women and children from all
              forms of violence and abuse.
            </p>
            <button class="btn btn-primary mt-auto" onclick="openSurvey(9262)">
              Take Survey
            </button>
          </div>
        </div>
      </div>

      <!-- Law 3: Magna Carta for Women -->
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Magna Carta for Women (RA 9710)</h5>
            <p class="card-text flex-grow-1">
              This law promotes the rights and welfare of women,
              particularly those belonging to marginalized sectors.
            </p>
            <button class="btn btn-primary mt-auto" onclick="openSurvey(9710)">
              Take Survey
            </button>
          </div>
        </div>
      </div>

      <!-- Law 4: Safe Spaces Act -->
      <div class="col-md-6 mb-4"">
          <div class=" card h-100">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Safe Spaces Act (RA 11313)</h5>
          <p class="card-text flex-grow-1">
            This law aims to prevent and address gender-based street and
            public spaces harassment.
          </p>
          <button class="btn btn-primary mt-auto" onclick="openSurvey(11313)">
            Take Survey
          </button>
        </div>
      </div>
    </div>

    <!-- Add more laws following the same structure -->
    </div>
    </div>
  </section>


  <!-- Statistics Section -->
  <section id="statistics" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Statistics</h2>
      <div class="text-center">
        <h4 class="font-weight-bold">
          Awareness in the Anti-Sexual Harassment Act of 1995 (RA 7877)
        </h4></br>
        <canvas id="lawone" style="width:100%;max-width:700px"></canvas></br>

        <h4 class="font-weight-bold">
          Anti-Violence Against Women and their Children (RA 9262)
        </h4></br>
        <canvas id="lawtwo" style="width:100%;max-width:700px"></canvas></br>
        <h4 class="font-weight-bold">
          Magna Carta for Women (RA 9710)
        </h4></br>
        <canvas id="lawthree" style="width:100%;max-width:700px"></canvas></br>

        <h4 class="font-weight-bold">
          Safe Spaces Act (RA 11313)
        </h4></br>
        <canvas id="lawfour" style="width:100%;max-width:700px"></canvas>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Contact Us</h2>
      <p class="text-center">Have questions or feedback? Reach out to us:</p>
      <form id="contact-form">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" required />
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <div class="container">
      <p>&copy; 2024 Everonix</p>
    </div>
  </footer>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Custom JavaScript -->
  <script src="script.js"></script>
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

    function openSurvey(surveyName) {
      // Redirect to the specified survey file
      window.open("surveys/" + surveyName + ".php", "_blank");
    }

    // Function to fetch data from the database
    function fetchDataForChart(data) {
      // Extract the score ranges and counts
      var level = data.map(function(item) {
        return item.level;
      });
      var counts = data.map(function(item) {
        return item.count;
      });

      // Returning the fetched data as JSON
      return {
        level: level,
        counts: counts
      };
    }

    // Function to update the chart with fetched data
    function updateChart(surveyName, data) {
      var data = fetchDataForChart(data);

      // Define custom colors based on GAD score ranges
      var customColors = [];
      data.level.forEach(function(range) {
        switch (range) {
          case 'Low':
            customColors.push('rgba(255, 99, 132, 0.5)');
            break;
          case 'Medium':
            customColors.push('rgba(54, 162, 235, 0.5)');
            break;
          case 'High':
            customColors.push('rgba(255, 206, 86, 0.5)');
            break;
        }
      });

      var scoreData = {
        labels: data.level,
        datasets: [{
          data: data.counts,
          backgroundColor: customColors, // Use custom colors
          borderColor: customColors.map(color => color.replace('0.5', '1')), // Set border color to full opacity
          borderWidth: 1
        }]
      };

      // Get the canvas element
      var scoreCanvas = document.getElementById(surveyName).getContext('2d');

      // Check if the chart exists and update it, or create a new chart
      window.scoreChart = new Chart(scoreCanvas, {
        type: 'pie',
        data: scoreData,
        options: {
          responsive: true,
          legend: {
            display: true,
            position: 'right'
          },
          elements: {
            arc: {
              bevelWidth: 5, // Add bevel effect
              bevelHighlightColor: 'rgba(255, 255, 255, 0.5)', // Highlight color for bevel effect
              // Add gradient shading for a realistic look
              shadowOffsetX: 0,
              shadowOffsetY: 0,
              shadowBlur: 15,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          },
        }
      });
    }

    // Call the function to update the chart
    updateChart("lawone", <?php echo json_encode($data["lawone"]); ?>);
    updateChart("lawtwo", <?php echo json_encode($data["lawtwo"]); ?>);
    updateChart("lawthree", <?php echo json_encode($data["lawthree"]); ?>);
    updateChart("lawfour", <?php echo json_encode($data["lawfour"]); ?>);
  </script>
</body>

</html>
