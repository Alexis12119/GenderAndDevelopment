<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="website icon" href="assets/img/logo.png" />
  <title>Gender and Development</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <style>
    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.5);
      /* Normal color */
    }

    .navbar-dark .navbar-nav .nav-link:hover {
      color: #fff;
      /* Hover color */
    }

    .navbar-dark .navbar-nav .nav-item.active .nav-link {
      color: #fff;
      text-decoration: underline;
      text-underline-offset: 0.2em;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background: #8f6dd1;
      border-color: #5b48a2;
      margin: 15% auto;
      padding: 20px;
      width: 80%;
    }

    /* Buttons */
    #modal-confirm,
    #modal-cancel {
      background: linear-gradient(to right, #6c5ce7, #a44cf2);
      border-color: #6c5ce7;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }

    #modal-confirm:hover,
    #modal-cancel:hover {
      background: linear-gradient(to right, #5b48a2, #8f6dd1);
      border-color: #5b48a2;
    }
  </style>
</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Flex container to align logo and text -->
      <div class="d-flex align-items-center">
        <!-- Logo -->
        <a class="logo navbar-brand" href="https://www.youtube.com/shorts/SXHMnicI6Pg" target="_blank">
          <img class="rounded-circle" src="assets/img/logo.png" alt="logo">
        </a>
        <!-- Text alongside the logo -->
        <span class="text ml-2">Gender And Development</span>
      </div>
      <!-- Navbar toggler for smaller screens -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar items -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" id="rightsNavItem">
            <a class="nav-link" href="#rights">Rights</a>
          </li>
          <li class="nav-item" id="statisticsNavItem">
            <a class="nav-link" href="#statistics">Statistics</a>
          </li>
          <li class="nav-item" id="aboutNavItem">
            <a class="nav-link" href="#about">About Us</a>
          </li>
          <li class="nav-item" id="contactNavItem">
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
          <!-- From: https://djnrmh.doh.gov.ph/images/Images/GAD/GAD_FINAL.png -->
          <img class="d-block img-fluid" src="assets/img/carousel/gad.png" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="assets/img/carousel/gad.png" alt="Second slide">
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
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7R9VbCO1ck4?si=8PgPgSqzRfEAZwQQ" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
            </div>
            <p class="card-text flex-grow-1">
              This law aims to protect individuals from sexual harassment in
              the workplace and in educational or training institutions.
            </p>
            <a class="btn btn-primary font-size mb-2" href="https://pcw.gov.ph/faq-republic-act-7877-anti-sexual-harassment-act-of-1995/" target="_blank">Read More</a>
            <button class="btn btn-primary font-size mt-auto" onclick="openSurvey(7877)">
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
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ED9SvlGuJ2Y?si=o3KlLkdWntcpR7tU" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
            </div>
            <p class="card-text flex-grow-1">
              This law provides protection for women and children from all
              forms of violence and abuse.
            </p>
            <a class="btn btn-primary font-size mb-2" href="https://pcw.gov.ph/faq-republic-act-9262/" target="_blank">Read More</a>
            <button class="btn btn-primary font-size mt-auto" onclick="openSurvey(9262)">
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
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/SHcWcXroVnE?si=_c4eqcRSQzekI_DK" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
            </div>
            <p class="card-text flex-grow-1">
              This law promotes the rights and welfare of women,
              particularly those belonging to marginalized sectors.
            </p>
            <a class="btn btn-primary font-size mb-2" href="https://pcw.gov.ph/faq-republic-act-9710-the-magna-carta-of-women/" target="_blank">Read More</a>
            <button class="btn btn-primary font-size mt-auto" onclick="openSurvey(9710)">
              Take Survey
            </button>
          </div>
        </div>
      </div>

      <!-- Law 4: Safe Spaces Act -->
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Safe Spaces Act (RA 11313)</h5>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/MoTfn0QT_dQ?si=X6k9tQ7Sd6sjE_cn" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
            </div>
            <p class="card-text flex-grow-1">
              This law aims to prevent and address gender-based street and
              public spaces harassment.
            </p>
            <a class="btn btn-primary font-size mb-2" href="https://www.ombudsman.gov.ph/GAD/Laws%20and%20Mandates/IRR-of-RA-11313-Safe-Spaces-Act.pdf" target="_blank">Read More</a>
            <button class="btn btn-primary font-size mt-auto" onclick="openSurvey(11313)">
              Take Survey
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div id="myModal" class="modal">
      <div class="modal-content">
        <h4>Confirmation</h4>
        <p id="modal-message"></p>
        <button id="modal-confirm">Yes</button>
        <button id="modal-cancel">No</button>
      </div>
    </div>

  </section>

  <!-- Statistics Section -->
  <section id="statistics" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Statistics</h2>

      <!-- Card for Law One Chart -->
      <div class="col-md-8 mb-4 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Level of Awareness in the Anti-Sexual Harassment Act of 1995 (RA 7877)</h5>
            <canvas id="lawone"></canvas>
          </div>
        </div>
      </div>

      <!-- Law Two Chart -->
      <div class="col-md-8 mb-4 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Level of Awareness in the Anti-Violence Against Women and their Children (RA 9262)</h5>
            <canvas id="lawtwo"></canvas>
          </div>
        </div>
      </div>

      <!-- Law Three Chart -->
      <div class="col-md-8 mb-4 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Level of Awareness in the Magna Carta for Women (RA 9710)</h5>
            <canvas id="lawthree"></canvas>
          </div>
        </div>
      </div>

      <!-- Law Four Chart -->
      <div class="col-md-8 mb-4 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Level of Awareness in the Safe Spaces Act (RA 11313)</h5>
            <canvas id="lawfour"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About section -->
  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Our Team</h2>
      <div class="row align-items-stretch">
        <!-- Profile cards -->
        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/kevin.jpg" alt="Profile 3" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Vince Kevin Comaya</h5>
              <p class="card-text">System Analyst</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/archie.jpg" alt="Profile 4" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Archie Nuque</h5>
              <p class="card-text">Database Administrator</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/alexis.jpg" alt="Profile 6" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Alexis Corporal</h5>
              <p class="card-text">Programmer</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/daniel.jpg" alt="Profile 7" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Daniel Mendoza</h5>
              <p class="card-text">UI/UX Designer</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/aldrin.jpg" alt="Profile 5" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Aldrin Porcioncula</h5>
              <p class="card-text">Documentation</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card rounded-3 h-100">
            <img src="assets/img/profiles/errol.jpg" alt="Profile 8" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title">Errol Arapan</h5>
              <p class="card-text">Documentation</p>
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
      <p class="text-center">We're always looking for ways to improve our platform.</p>
      <p class="text-center"><a class="text-center" href="https://forms.gle/6g8sopBwD82JbjFx8" target="_blank">Click to fill out the feedback form </a>
      </p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <div class="container">
      <p>&copy; 2024 Everonix</p>
    </div>
  </footer>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Global variable to store the previous data
    var previousData = {
      ra7877: [],
      ra9262: [],
      ra9710: [],
      ra11313: []
    };

    var isChartAlreadyCreated = false
    // Function to fetch data from the server
    function fetchAndUpdateCharts() {
      $.ajax({
        url: 'utils/fetchData.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          // Check if data has changed for each table
          if (hasDataChanged(previousData.ra7877, response.ra7877)) {
            updateChart("lawone", response.ra7877);
            previousData.ra7877 = response.ra7877;
            isChartAlreadyCreated = false
          }
          if (isDataZero(previousData.ra7877)) {
            if (!isChartAlreadyCreated) {
              createEmptyChart("lawone");
            }
            isChartAlreadyCreated = true
          }
          if (hasDataChanged(previousData.ra9262, response.ra9262)) {
            updateChart("lawtwo", response.ra9262);
            previousData.ra9262 = response.ra9262;
            isChartAlreadyCreated = false
          }
          if (isDataZero(previousData.ra9262)) {
            if (!isChartAlreadyCreated) {
              createEmptyChart("lawtwo");
            }
            isChartAlreadyCreated = true
          }
          if (hasDataChanged(previousData.ra9710, response.ra9710)) {
            updateChart("lawthree", response.ra9710);
            previousData.ra9710 = response.ra9710;
            isChartAlreadyCreated = false
          }
          if (isDataZero(previousData.ra9710)) {
            if (!isChartAlreadyCreated) {
              createEmptyChart("lawthree");
            }
            isChartAlreadyCreated = true
          }

          if (hasDataChanged(previousData.ra11313, response.ra11313)) {
            updateChart("lawfour", response.ra11313);
            previousData.ra11313 = response.ra11313;
            isChartAlreadyCreated = false
          }
          if (isDataZero(previousData.ra11313)) {
            if (!isChartAlreadyCreated) {
              createEmptyChart("lawfour");
            }
            isChartAlreadyCreated = true
          }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching data:', error);
        }
      });
    }

    // Function to check if the data is zero
    function isDataZero(data) {
      return data.every(item => item.count === 0);
    }

    // Function to check if data has changed
    function hasDataChanged(previousData, newData) {
      // Check if length differs
      if (previousData.length !== newData.length) {
        return true;
      }

      // Check if any item differs
      for (var i = 0; i < previousData.length; i++) {
        if (previousData[i].level !== newData[i].level || previousData[i].count !== newData[i].count) {
          return true;
        }
      }

      // Data is the same
      return false;
    }

    // Update charts initially
    fetchAndUpdateCharts();

    // Set interval to fetch data and update charts every 5 seconds
    setInterval(fetchAndUpdateCharts, 5000);

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
      var message = "By proceeding, you agree that your responses may be collected and processed in accordance with the Data Privacy Act of 2012. Your privacy and confidentiality will be maintained.";

      // Display modal with message
      document.getElementById("modal-message").innerText = message;
      document.getElementById("myModal").style.display = "block";

      // When the user clicks on the close button or outside the modal, close it
      var closeBtn = document.getElementsByClassName("close")[0];
      window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
          document.getElementById("myModal").style.display = "none";
        }
      }

      // Handle confirm button click
      document.getElementById("modal-confirm").onclick = function() {
        window.open("surveys/" + surveyName + ".php", "_blank");
        document.getElementById("myModal").style.display = "none";
      }

      // Handle cancel button click
      document.getElementById("modal-cancel").onclick = function() {
        document.getElementById("myModal").style.display = "none";
      }
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
      if (window[surveyName + 'Chart']) {
        window[surveyName + 'Chart'].data = scoreData;
        window[surveyName + 'Chart'].update();
      } else {
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

    // Function to create an empty chart
    function createEmptyChart(surveyName) {
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
      if (window[surveyName + 'Chart']) {
        window[surveyName + 'Chart'].destroy();
      }
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
    }

    // Function to update the active state of navigation items
    function updateActiveNavItem(navItemId) {
      // Remove 'active' class from all nav items
      document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
      });

      // Add 'active' class to the clicked nav item
      document.getElementById(navItemId).classList.add('active');
    }

    // Add click event listeners to each nav item
    document.getElementById('rightsNavItem').addEventListener('click', function() {
      updateActiveNavItem('rightsNavItem');
    });

    document.getElementById('statisticsNavItem').addEventListener('click', function() {
      updateActiveNavItem('statisticsNavItem');
    });

    document.getElementById('aboutNavItem').addEventListener('click', function() {
      updateActiveNavItem('aboutNavItem');
    });

    document.getElementById('contactNavItem').addEventListener('click', function() {
      updateActiveNavItem('contactNavItem');
    });

    // Function to increment page view count
    function incrementPageViews() {
      // Retrieve page views from local storage, or initialize to 0 if not present
      var pageViews = localStorage.getItem('pageViews') || 0;
      // Increment the page views
      pageViews++;
      // Update the page views in local storage
      localStorage.setItem('pageViews', pageViews);
      // Update the page view count display
      document.getElementById('pageViews').textContent = pageViews;
    }

    // Increment page view count when the page is loaded
    incrementPageViews();

    // Function to update the active state of navigation items based on scroll position
    function updateActiveNavItemOnScroll() {
      // Get the current scroll position and viewport height
      var scrollPosition = window.scrollY;
      var viewportHeight = window.innerHeight;

      // Loop through each section to check if it's in view
      document.querySelectorAll('section').forEach(section => {
        var sectionId = section.getAttribute('id');
        var sectionOffsetTop = section.offsetTop;
        var sectionHeight = section.offsetHeight;

        // Calculate the bottom of the section relative to the viewport
        var sectionBottom = sectionOffsetTop + sectionHeight;

        // Check if the section is in view, considering both top and bottom of the viewport
        if (scrollPosition >= sectionOffsetTop - (viewportHeight / 2) && scrollPosition < sectionBottom - (viewportHeight / 2)) {
          // Update the active state of the corresponding navigation item
          updateActiveNavItem(sectionId + 'NavItem');
        }
      });
    }

    // Add event listener for scroll event to update active navigation item
    window.addEventListener('scroll', updateActiveNavItemOnScroll);
    // Set initial active navigation item
    updateActiveNavItemOnScroll()

    // Function to handle navigation item clicks
    function handleNavItemClick(event) {
      // Remove the scroll event listener temporarily
      window.removeEventListener('scroll', updateActiveNavItemOnScroll);

      // Reattach the scroll event listener after a short delay
      setTimeout(function() {
        window.addEventListener('scroll', updateActiveNavItemOnScroll);
      }, 2000);
    }

    // Add click event listeners to each nav item
    document.getElementById('rightsNavItem').addEventListener('click', handleNavItemClick);
    document.getElementById('statisticsNavItem').addEventListener('click', handleNavItemClick);
    document.getElementById('aboutNavItem').addEventListener('click', handleNavItemClick);
    document.getElementById('contactNavItem').addEventListener('click', handleNavItemClick);
  </script>
</body>

</html>
