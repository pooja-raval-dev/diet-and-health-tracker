<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user']['name'] : null;
?>
<!-- ✅ Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .navbar-custom {
    background: linear-gradient(90deg,#004578,#007245);
  }
  .navbar-custom .nav-link:hover {
    color: #340dceff !important;
    text-decoration: underline;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
      <i class="bi bi-heart-pulse-fill me-2 fs-4 text-light"></i>
      Diet & Health
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        <!-- 👨‍💻 Admin Login लिंक Contact Us के बगल में -->
        <li class="nav-item"><a class="nav-link" href="admin/admin_login.php"><i class="bi bi-shield-lock-fill me-1"></i>Admin Login</a></li>
      </ul>

      <?php if ($isLoggedIn): ?>
        <span class="text-white me-3">Welcome, <?= htmlspecialchars($username) ?> 👋</span>
        <a href="logout.php" class="btn btn-light rounded-pill px-4 fw-semibold text-success border-success">Logout</a>
      <?php else: ?>
        <a href="register.php" class="btn btn-outline-light rounded-pill px-4 fw-semibold me-2">Register</a>
        <a href="login.php" class="btn btn-light rounded-pill px-4 fw-semibold text-success border-success">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
