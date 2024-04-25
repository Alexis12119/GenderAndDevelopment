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
$tables = array("ra7877", "ra9262", "ra9710", "ra11313");
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
  <link rel="stylesheet" href="assets/css/styles.css" />
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
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

  <!-- Carousel Section -->
  <section id="carousel" class="py-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="https://djnrmh.doh.gov.ph/images/Images/GAD/GAD_FINAL.png" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://djnrmh.doh.gov.ph/images/Images/GAD/GAD_FINAL.png" alt="Second slide">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <!-- About section -->
  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Our Team</h2>
      <div class="row">
        <!-- Profile cards -->
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/alexis.jpg" alt="Profile 1" class="card-img-top">
            <div class="card-body ">
              <h5 class="card-title">Alexis Corporal</h5>
              <p class="card-text">Programmer</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/errol.jpg" alt="Profile 2" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Errol Arapan</h5>
              <p class="card-text">Documentation</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/kevin.jpg" alt="Profile 3" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Vince Kevin Comaya</h5>
              <p class="card-text">Documentation</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/archie.jpg" alt="Profile 4" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Archie Nuque</h5>
              <p class="card-text">Database Administrator</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/aldrin.jpg" alt="Profile 5" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Aldrin Porcioncula</h5>
              <p class="card-text">Database Administrator</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card rounded-3">
            <img src="assets/img/daniel.jpg" alt="Profile 6" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Daniel Mendoza</h5>
              <p class="card-text">UI/UX Designer</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Rights Section with Cards -->
  <section id="rights" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Know Your Rights</h2>
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
            <a class="btn btn-primary" href="https://pcw.gov.ph/faq-republic-act-7877-anti-sexual-harassment-act-of-1995/" target="_blank">Read More</a>
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
            <a class="btn btn-primary" href="https://pcw.gov.ph/faq-republic-act-9262/" target="_blank">Read More</a>
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
            <a class="btn btn-primary" href="https://pcw.gov.ph/faq-republic-act-9710-the-magna-carta-of-women/" target="_blank">Read More</a>
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
          <a class="btn btn-primary" href="https://www.ombudsman.gov.ph/GAD/Laws%20and%20Mandates/IRR-of-RA-11313-Safe-Spaces-Act.pdf" target="_blank">Read More</a>
          <button class="btn btn-primary mt-auto" onclick="openSurvey(11313)">
            Take Survey
          </button>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>

  <!-- Statistics Section -->
  <section id="statistics" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Statistics</h2>
      <div class="row">

        <!-- Card for Law One Chart -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Awareness in the Anti-Sexual Harassment Act of 1995 (RA 7877)</h5>
              <canvas id="lawone" style="max-width:100%"></canvas>
            </div>
          </div>
        </div>

        <!-- Law Two Chart -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Anti-Violence Against Women and their Children (RA 9262)</h5>
              <canvas id="lawtwo" style="max-width:100%"></canvas>
            </div>
          </div>
        </div>

        <!-- Law Three Chart -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Magna Carta for Women (RA 9710)</h5>
              <canvas id="lawthree" style="max-width:100%"></canvas>
            </div>
          </div>
        </div>

        <!-- Law Four Chart -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Safe Spaces Act (RA 11313)</h5>
              <canvas id="lawfour" style="max-width:100%"></canvas>
            </div>
          </div>
        </div>

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

      // Check if data is empty, if so, create a default chart with no data
      if (data.level.length === 0 || data.counts.length === 0) {
        var defaultData = {
          labels: ['No Data'],
          datasets: [{
            data: [1], // Just to display something, doesn't matter what
            backgroundColor: ['rgba(0, 0, 0, 0.1)'],
            borderColor: ['rgba(0, 0, 0, 0.1)'],
            borderWidth: 1
          }]
        };

        // Get the canvas element
        var defaultCanvas = document.getElementById(surveyName).getContext('2d');

        // Create the default chart
        window[surveyName + 'Chart'] = new Chart(defaultCanvas, {
          type: 'pie',
          data: defaultData,
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
      } else {
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
        window[surveyName + 'Chart'] = new Chart(scoreCanvas, {
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
    }
    // Call the function to update the chart
    updateChart("lawone", <?php echo json_encode($data["ra7877"]); ?>);
    updateChart("lawtwo", <?php echo json_encode($data["ra9262"]); ?>);
    updateChart("lawthree", <?php echo json_encode($data["ra9710"]); ?>);
    updateChart("lawfour", <?php echo json_encode($data["ra11313"]); ?>);
  </script>
</body>

</html>
