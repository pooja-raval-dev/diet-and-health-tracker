<?php
session_start();
include("db_connect.php");

// Agar login nahi hua ho to redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// User ka naam bhi le aayenge
$userRes = $conn->query("SELECT name,email FROM users WHERE id=$user_id");
$user = $userRes->fetch_assoc();

// Diet Plans fetch karo sirf us user ke
$plans = $conn->query("SELECT * FROM diet_plans WHERE user_id=$user_id ORDER BY diet_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Diet Plans</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h2 class="mb-4">🍽 My Diet Plans</h2>
<div class="alert alert-info">
  <b>User:</b> <?= htmlspecialchars($user['name']) ?> (<?= htmlspecialchars($user['email']) ?>)
</div>

<?php if ($plans->num_rows > 0): ?>
  <table class="table table-bordered table-striped">
    <tr>
      <th>#</th>
      <th>Breakfast</th>
      <th>Lunch</th>
      <th>Snacks</th>
      <th>Dinner</th>
      <th>Notes</th>
    </tr>
    <?php while($row = $plans->fetch_assoc()): ?>
      <tr>
        <td><?= $row['diet_id'] ?></td>
        <td><?= htmlspecialchars($row['breakfast']) ?></td>
        <td><?= htmlspecialchars($row['lunch']) ?></td>
        <td><?= htmlspecialchars($row['snacks']) ?></td>
        <td><?= htmlspecialchars($row['dinner']) ?></td>
        <td><?= htmlspecialchars($row['notes']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
<?php else: ?>
  <div class="alert alert-warning">⚠️ No Diet Plan Assigned Yet!</div>
<?php endif; ?>

</body>
</html>
