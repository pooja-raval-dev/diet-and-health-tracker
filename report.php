<?php
include("db_connect.php");

// Last profile fetch
$result = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $age = $data['age'];
    $gender = $data['gender'];
    $height = $data['height'];
    $weight = $data['weight'];
    $goal = $data['goal'];

    // ✅ BMR formula
    if ($gender == "Male") {
        $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
    } else {
        $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
    }

    // ✅ Calorie Goal
    if ($goal == "Lose") {
        $calories = $bmr - 500;
    } elseif ($goal == "Gain") {
        $calories = $bmr + 500;
    } else {
        $calories = $bmr;
    }

    // ✅ BMI calculation
    $height_m = $height / 100; // cm → meter
    $bmi = $weight / ($height_m * $height_m);

    if ($bmi < 18.5) {
        $bmi_status = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $bmi_status = "Normal";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $bmi_status = "Overweight";
    } else {
        $bmi_status = "Obese";
    }
} else {
    die("⚠ No profile data found. Please insert a profile first.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personalized Report</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-5">
  <h2 class="mb-4">📊 Personalized Health Report</h2>

  <!-- Profile Info -->
  <div class="card p-3 mb-3">
    <p><strong>Age:</strong> <?= $age ?> years</p>
    <p><strong>Gender:</strong> <?= $gender ?></p>
    <p><strong>Height:</strong> <?= $height ?> cm</p>
    <p><strong>Weight:</strong> <?= $weight ?> kg</p>
    <p><strong>Goal:</strong> <?= $goal ?> Weight</p>
  </div>

  <!-- Daily Recommendation -->
  <div class="card p-3 bg-light mb-3">
    <h4>🎯 Recommended Daily Calories: <span class="text-success"><?= round($calories) ?> kcal</span></h4>
    <p>💧 Drink at least <b>2L water daily</b></p>
    <p>🚶 Try to <b>walk 30 minutes</b> every day</p>
    <p>🥗 Maintain a balanced diet with proteins, carbs & vitamins</p>
  </div>

  <!-- BMI Result -->
  <div class="card p-3 mb-3">
    <h4>⚖ Your BMI: <?= round($bmi, 1) ?></h4>
    <p>Status: <b><?= $bmi_status ?></b></p>
  </div>

  <!-- Chart Section -->
  <div class="card p-3">
    <h4>📈 Calorie Comparison</h4>
    <canvas id="calorieChart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('calorieChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['BMR (Maintenance)', 'Target Calories'],
        datasets: [{
          label: 'Calories',
          data: [<?= round($bmr) ?>, <?= round($calories) ?>],
          backgroundColor: ['#007bff', '#28a745']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>