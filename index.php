<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
$username   = $isLoggedIn ? $_SESSION['user']['name'] : null;
$stats = [
  "users"    => "10K+",
  "meals"    => "500K+",
  "calories" => "1M+"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Diet & Health | Tracking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body {
      background-color:#f8f9fa;
      font-family:'Segoe UI',sans-serif;
    }
    .hero {
      background:linear-gradient(rgba(211, 188, 188, 0.94),rgba(12, 10, 10, 0.86)),
        url('https://source.unsplash.com/1600x600/?healthy-food,fitness') center/cover;
      color:#fff;
      padding:100px 20px;
      text-align:center;
    }
    .btn-green {
      background:linear-gradient(135deg,#00c851,#007e33);
      color:#fff;
      border:none;
      border-radius:50px;
      transition:.3s;
    }
    .btn-green:hover {
      background:linear-gradient(135deg,#00a03e,#006622);
      transform:scale(1.05);
    }
    .feature-card:hover {
      transform:translateY(-5px);
      box-shadow:0 6px 15px rgba(0,0,0,0.1);
      transition:.3s;
    }
    footer {
      background:#222;
      color:#aaa;
      padding:20px;
      text-align:center;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<?php include 'banner.php'; ?>

<section class="hero" data-aos="fade-down">
  <h1 class="fw-bold display-5">Achieve Your Health Goals</h1>
  <p class="lead">Track your meals, monitor fitness, and stay motivated with Diet & Health. Join <?=$stats['users']?> users today!</p>
  <div class="mt-4">
    <a href="register.php" class="btn btn-green btn-lg me-2"><i class="bi bi-person-plus"></i> Register</a>
    <a href="login.php" class="btn btn-outline-light btn-lg border-2"><i class="bi bi-box-arrow-in-right"></i> Login</a>
  </div>
</section>

<section class="container py-5 text-center">
  <h2 class="text-success fw-bold mb-4" data-aos="fade-up">Powerful Features</h2>
  <div class="row g-4">
    <div class="col-md-4" data-aos="zoom-in">
      <div class="card feature-card h-100 p-4">
        <i class="bi bi-apple display-4 text-success"></i>
        <h4 class="mt-3">Diet Tracking</h4>
        <p>Log meals and analyze nutrition with easy-to-read charts.</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
      <div class="card feature-card h-100 p-4">
        <i class="bi bi-droplet display-4 text-success"></i>
        <h4 class="mt-3">Water Reminders</h4>
        <p>Stay hydrated with personalized alerts throughout your day.</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
      <div class="card feature-card h-100 p-4">
        <i class="bi bi-heart-pulse display-4 text-success"></i>
        <h4 class="mt-3">Fitness Logs</h4>
        <p>Track workouts, monitor progress, and celebrate achievements.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-success text-white text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <h2><?=$stats['users']?></h2>
        <p>Active Users</p>
      </div>
      <div class="col-md-4">
        <h2><?=$stats['meals']?></h2>
        <p>Meals Tracked</p>
      </div>
      <div class="col-md-4">
        <h2><?=$stats['calories']?></h2>
        <p>Calories Burned</p>
      </div>
    </div>
  </div>
</section>

<section class="container py-5 text-center">
  <h2 class="fw-bold mb-4">What Our Users Say</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-4">
        <p>"Diet & Health completely changed my eating habits. I feel fit and motivated!"</p>
        <small>- Rohan</small>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <p>"Water reminders and fitness logs made my routine so much easier. Highly recommended!"</p>
        <small>- Priya</small>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <p>"Meal tracking is so simple that counting calories has become fun."</p>
        <small>- Ayesha</small>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:1000,once:true});</script>
</body>
</html>
