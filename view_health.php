<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("db_connect.php");


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$health_query = "Select sleep_hours, calories, water_intake, mood_level, notes from health_logs where id='$user_id'";
$health_result = mysqli_query($conn, $health_query);

// initialize flag first (prevents "undefined variable" warning)
$has_record = false;

// if query succeeded and at least one row exists, fetch it
if ($health_result && mysqli_num_rows($health_result) > 0) {
    $health_data = mysqli_fetch_assoc($health_result);
    $has_record = true;
} else {
    // no record — provide safe defaults so your view-fields won't error
    $health_data = [
        'sleep_hours' => '',
        'calories' => '',
        'water_intake' => '',
        'mood_level' => '',
        'notes' => ''
    ];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Health Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .profile-card {
            margin: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        h3 {
            font-family: 'Times New Roman';
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            font-size: 16px;
        }

        .edit-field {
            display: none;
        }
    </style>


</head>

<body>

    <div class="health-card">
        <h3>Health Log</h3>
        <form id="healthForm" action="insert_health.php" method="POST" novalidate>
            <table class="table table-bordered table-striped">
                <tbody>
                    <!-- Sleep Hours -->
                    <tr>
                        <th style="width: 30%;">Sleep Hours *</th>
                        <td>
                            <?php if ($has_record): ?>
                                <!-- agar record hai to view + edit dono -->
                                <span class="view-field"><?= htmlspecialchars($health_data['sleep_hours']) ?></span>
                                <input type="number" step="0.1" min="0" max="24" class="form-control edit-field"
                                    name="sleep_hours" value="<?= htmlspecialchars($health_data['sleep_hours']) ?>"
                                    required>
                            <?php else: ?>
                                <!-- agar record nahi hai to direct input dikhana -->
                                <input type="number" step="0.1" min="0" max="24" class="form-control" name="sleep_hours"
                                    placeholder="Enter your sleep hours" required>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Calories -->
                    <tr>
                        <th>Calories *</th>
                        <td>
                            <?php if ($has_record): ?>
                                <span class="view-field"><?= htmlspecialchars($health_data['calories']) ?></span>
                                <input type="number" class="form-control edit-field" name="calories"
                                    value="<?= htmlspecialchars($health_data['calories']) ?>" required>
                            <?php else: ?>
                                <input type="number" class="form-control" name="calories" placeholder="Enter your calories"
                                    required>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Water Intake -->
                    <tr>
                        <th>Water Intake (L) *</th>
                        <td>
                            <?php if ($has_record): ?>
                                <span class="view-field"><?= htmlspecialchars($health_data['water_intake']) ?></span>
                                <input type="number" step="0.1" min="0" class="form-control edit-field" name="water_intake"
                                    value="<?= htmlspecialchars($health_data['water_intake']) ?>" required>
                            <?php else: ?>
                                <input type="number" step="0.1" min="0" class="form-control" name="water_intake"
                                    placeholder="Enter your water intake in liters" required>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Mood Level -->
                    <tr>
                        <th class="text-primary">Mood Level *</th>
                        <td>
                            <?php if ($has_record): ?>
                                <span class="view-field"><?= htmlspecialchars($health_data['mood_level']) ?></span>
                                <select class="form-select edit-field" name="mood_level" required>
                                    <option value="" disabled>🌟 Select Your Mood</option>
                                    <option value="1" <?= $health_data['mood_level'] == 1 ? 'selected' : '' ?>>☹️ Very Low
                                    </option>
                                    <option value="2" <?= $health_data['mood_level'] == 2 ? 'selected' : '' ?>>🙁 Low</option>
                                    <option value="3" <?= $health_data['mood_level'] == 3 ? 'selected' : '' ?>>😐 Normal
                                    </option>
                                    <option value="4" <?= $health_data['mood_level'] == 4 ? 'selected' : '' ?>>🙂 Good</option>
                                    <option value="5" <?= $health_data['mood_level'] == 5 ? 'selected' : '' ?>>😃 Excellent
                                    </option>
                                </select>
                            <?php else: ?>
                                <select class="form-select" name="mood_level" required>
                                    <option value="" disabled selected>🌟 Select Your Mood</option>
                                    <option value="1">☹️ Very Low</option>
                                    <option value="2">🙁 Low</option>
                                    <option value="3">😐 Normal</option>
                                    <option value="4">🙂 Good</option>
                                    <option value="5">😃 Excellent</option>
                                </select>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Notes -->
                    <tr>
                        <th>Notes (Optional)</th>
                        <td>
                            <?php if ($has_record): ?>
                                <span class="view-field"><?= htmlspecialchars($health_data['notes']) ?></span>
                                <textarea class="form-control edit-field" name="notes"
                                    rows="3"><?= htmlspecialchars($health_data['notes']) ?></textarea>
                            <?php else: ?>
                                <textarea class="form-control" name="notes" rows="3"
                                    placeholder="Enter any notes (optional)"></textarea>
                            <?php endif; ?>
                        </td>
                    </tr>

                </tbody>
            </table>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" id="save-btn" class="btn btn-primary">Save Log</button>
            </div>
        </form>
    </div>

</body>

</html>