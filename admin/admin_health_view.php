<?php
session_start();  
include('db_connect.php'); // db connect

if (!isset($_SESSION['admin_id'])) {
    die("<p style='color:red;'>Please log in first as Admin.</p>");
}

// Fetch health logs
$query = "SELECT hl.health_id, u.name, hl.sleep_hours, hl.calories, hl.water_intake, hl.mood_level, hl.notes, hl.date AS created_at
          FROM health_logs hl
          JOIN users u ON hl.id = u.id
          ORDER BY hl.date DESC";

$result = mysqli_query($conn, $query);

?>

<div class="table-responsive">
<table class="table table-striped table-bordered align-middle">
    <tbody>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['health_id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['sleep_hours']) ?></td>
                <td><?= htmlspecialchars($row['calories']) ?></td>
                <td><?= htmlspecialchars($row['water_intake']) ?></td>
                <td>
                    <?php
                        $moodIcons = ['1'=>'☹️ Very Low','2'=>'🙁 Low','3'=>'😐 Normal','4'=>'🙂 Good','5'=>'😃 Excellent'];
                        echo $moodIcons[$row['mood_level']] ?? '';
                    ?>
                </td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8" class="text-center">No health logs found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
