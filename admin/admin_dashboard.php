<?php
session_start();

// db_connect.php admin folder के बाहर है इसलिए एक level ऊपर जाकर include किया
include(__DIR__ . '/../db_connect.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Profiles fetch
$query = "SELECT id,name,email,phone,age,gender,height,weight,goal,created_at FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$profiles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $profiles[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<style>
body {
    background-color: #f0f2f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 30px;
}
.card-custom {
    border-radius: 15px;
    box-shadow: 0 12px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card-custom:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 30px rgba(0,0,0,0.15);
}
.btn-primary, .btn-success, .btn-info {
    border-radius: 50px;
    padding: 10px 20px;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.table thead {
    background: #dcdde1;
    font-weight: 700;
    color: #2f3640;
}
.table-bordered {
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #dcdde1;
}
#profilesSection, #healthLogsSection {
    display: none;
    margin-top: 30px;
}
</style>
</head>
<body>
<div class="d-flex justify-content-end mb-3">
    <a href="admin_logout.php" class="btn btn-primary">Logout</a>
</div>

<div class="text-center">
    <h2>Admin - Diet & Health Tracker</strong>
</div>

<!-- तीन बॉक्स -->
<div class="row mb-4">
   <div class="col-md-4">
    <div class="card card-custom p-3 text-center">
        <h5>Add Diet plans</h5>
        <a href="admin_diet_plan.php" class="btn btn-primary">Enter</a>
    </div>
</div>

    <div class="col-md-4">
        <div class="card card-custom p-3 text-center">
            <h5>All profiles</h5>
            <button id="viewProfilesBtn" class="btn btn-success">View</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3 text-center">
            <h5>Health logs Stats</h5>
            <button id="checkLogsBtn" class="btn btn-info">Check</button>
        </div>
    </div>
</div>


<!-- Profiles Section -->
<div id="profilesSection" class="card card-custom p-4">
    <h5 class="mb-3">All User Profiles</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    <th>ID</th><th>Name</th><th>Contact</th><th>Email</th><th>Age</th>
                    <th>Gender</th><th>Height</th><th>Weight</th><th>Goal</th><th>Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($profiles) > 0): ?>
                    <?php foreach($profiles as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id']) ?></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= htmlspecialchars($p['phone']) ?></td>
                        <td><?= htmlspecialchars($p['email']) ?></td>
                        <td><?= htmlspecialchars($p['age']) ?></td>
                        <td><?= htmlspecialchars($p['gender']) ?></td>
                        <td><?= htmlspecialchars($p['height']) ?> cm</td>
                        <td><?= htmlspecialchars($p['weight']) ?> kg</td>
                        <td><?= htmlspecialchars($p['goal']) ?></td>
                        <td><?= htmlspecialchars($p['created_at']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="10" class="text-center">No profiles found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Health Logs Section -->
<div id="healthLogsSection" class="card card-custom p-4">
    <h5 class="mb-3">Health Logs Records</h5>
    <div id="healthLogsContent">
        <!-- Health logs list AJAX से load होगा -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Profiles toggle
document.getElementById('viewProfilesBtn').addEventListener('click', function(){
    const profilesSection = document.getElementById('profilesSection');
    const healthSection = document.getElementById('healthLogsSection');

    // Hide Health Logs if visible
    healthSection.style.display = 'none';
    document.getElementById('checkLogsBtn').textContent = 'Check';

    if(profilesSection.style.display === 'none'){
        profilesSection.style.display = 'block';
        this.textContent = 'Hide';
    } else {
        profilesSection.style.display = 'none';
        this.textContent = 'View';
    }
});

// Health logs toggle
document.getElementById('checkLogsBtn').addEventListener('click', function(){
    const healthSection = document.getElementById('healthLogsSection');
    const profilesSection = document.getElementById('profilesSection');
    const content = document.getElementById('healthLogsContent');

    // Hide Profiles if visible
    profilesSection.style.display = 'none';
    document.getElementById('viewProfilesBtn').textContent = 'View';

    if(healthSection.style.display === 'none'){
        // Fetch health logs via AJAX
        fetch('admin_health_view.php')
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;
                healthSection.style.display = 'block';
            });
        this.textContent = 'Hide';
    } else {
        healthSection.style.display = 'none';
        this.textContent = 'Check';
    }
});
</script>

</body>
</html>
