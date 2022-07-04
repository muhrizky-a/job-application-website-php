<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JOBTECH</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/company/kelola-lowongan.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
.delete-btn {
  text-decoration: none;
  border-radius: 5px;
}

.company-card .action {
  font-size: 15px;
  margin: auto 0;
  margin-left: auto;
  width: 65px;
  min-width: 65px;
}
</style>

<body>
  <?php
    session_start(); // Memulai sesi
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    //include("web-component/header-nav.php");
    ?>
  <nav class="navigation-menu">
    <label class="hamburger-icon" aria-label="Open navigation menu" for="menu-toggle">&#9776;</label>
    <input type="checkbox" id="menu-toggle" />
    <ul class="main-navigation">
      <li><a href="index.php">Home</a></li>
      <li><a href="./company/login.php">Company</a></li>
      <li><a href="./applicant/login.php">Job Seeker</a></li>
      <li><a href="FAQ.php">FAQ</a></li>
    </ul>
  </nav>
  <header>
    <div class="penuh">
      <div class="overlay"></div>
      <img src="assets/banner2.PNG" alt="banner">
      <div class="banner">
        <h3>JobTech</h3>
        <p>Shine your future with JobTech</p>
      </div>
      <div id='search-box'>
        <form action='/search' id='search-form' method='get' target='_top'>
          <input id='search-text' name='q' placeholder='Job Title or Keywords....' type='text' />
          <button id='search-button' type='submit'><span>Search</span></button>
        </form>
      </div>
    </div>
  </header>

  <div class="section">
    <div class="container">
      <div class="box">
        <div class="col-5">
          <h1>220</h1>
          <p>Employer</p>
        </div>
        <div class="col-5">
          <h1>|</h1>
        </div>
        <div class="col-5">
          <h1>551</h1>
          <p>Jobs Posts</p>
        </div>
        <div class="col-5">
          <h1>|</h1>
        </div>
        <div class="col-5">
          <h1>28560</h1>
          <p>Candidates</p>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <h2>Recent Vacancies</h2>
      <div class="dashboard-content">
        <div class="company-card">
          <div class="company-info company-image-wrapper">
            <img class="company-pic" src="assets/images/company-profile/PT LG Electronics Indonesia.png "
              alt="Company Logo">
          </div>
          <div class="company-info company-detail">
            <h3>PT LG Electronics Indonesia</h3>
            <p>Wahau</p>
            <p>
          </div>
          <div class="company-info action">
            <a href="" class="delete-btn" title="Closed">Closed</a>
          </div>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="company-card">
          <div class="company-info company-image-wrapper">
            <img class="company-pic" src="assets/images/company-profile/PERTAMINA.png " alt="Company Logo">
          </div>
          <div class="company-info company-detail">
            <h3>PERTAMINA</h3>
            <p>Berau</p>
          </div>
          <div class="company-info action">
            <a href="" class="delete-btn" title="Closed">Closed</a>
          </div>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="company-card">
          <div class="company-info company-image-wrapper">
            <img class="company-pic" src="assets/images/company-profile/MAYORA.jpg  " alt="Company Logo">
          </div>
          <div class="company-info company-detail">
            <h3>MAYORA</h3>
            <p>Kongbang</p>
          </div>
          <div class="company-info action">
            <a href="" class="delete-btn" title="Closed">Closed</a>
          </div>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="company-card">
          <div class="company-info company-image-wrapper">
            <img class="company-pic" src="assets/images/company-profile/Bank BCA Logo.jpg " alt="Company Logo">
          </div>
          <div class="company-info company-detail">
            <h3>Bank BCA</h3>
            <p>Samarinda</p>
          </div>
          <div class="company-info action">
            <a href="" class="delete-btn" title="Closed" style="margin-right: 30px ;">Closed</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>