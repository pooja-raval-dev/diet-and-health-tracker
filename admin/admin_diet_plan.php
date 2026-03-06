<?php
include("db_connect.php");

// Handle POST request (Insert / Update)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $diet_id   = $_POST['diet_id'] ?? '';
    $user_id   = $_POST['user_id'];
    $breakfast = $_POST['breakfast'];
    $lunch     = $_POST['lunch'];
    $snacks    = $_POST['snacks'];
    $dinner    = $_POST['dinner'];
    $notes     = $_POST['notes'];

    if ($diet_id) {
        // UPDATE existing plan
        $stmt = $conn->prepare(
            "UPDATE diet_plans 
             SET user_id=?, breakfast=?, lunch=?, snacks=?, dinner=?, notes=? 
             WHERE diet_id=?"
        );
        $stmt->bind_param("isssssi", $user_id, $breakfast, $lunch, $snacks, $dinner, $notes, $diet_id);
        $stmt->execute();
    } else {
        // INSERT new plan
        $stmt = $conn->prepare(
            "INSERT INTO diet_plans (user_id, breakfast, lunch, snacks, dinner, notes) 
             VALUES (?,?,?,?,?,?)"
        );
        $stmt->bind_param("isssss", $user_id, $breakfast, $lunch, $snacks, $dinner, $notes);
        $stmt->execute();
    }

    header("Location: admin_diet_plan.php?success=1");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $did = intval($_GET['delete']);
    $conn->query("DELETE FROM diet_plans WHERE diet_id=$did");
    header("Location: admin_diet_plan.php?deleted=1");
    exit;
}

// Handle Edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM diet_plans WHERE diet_id=$eid");
    $edit_data = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Diet Plans</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container mt-5">

  <h2 class="mb-4 d-flex justify-content-between align-items-center">
  <a href="admin_dashboard.php" class="btn btn-primary btn-sm">⬅ Back </a>
</h2>


<h2 class="mb-4">🍽 Admin - Manage Diet Plans</h2>

<!-- Success / Delete Alerts -->
<?php if (isset($_GET['success'])): ?>
<script>
Swal.fire({icon:'success',title:'Success',text:'Diet Plan Saved!'});
</script>
<?php endif; ?>
<?php if (isset($_GET['deleted'])): ?>
<script>
Swal.fire({icon:'warning',title:'Deleted',text:'Diet Plan Deleted!'});
</script>
<?php endif; ?>

<!-- Diet Plan Form -->
<div class="card p-4 mb-4">
  <form method="POST">
    <input type="hidden" name="diet_id" value="<?= $edit_data['diet_id'] ?? '' ?>">

    <!-- User Dropdown -->
    <div class="row mb-3">
      <div class="col">
        <label><b>Select User</b></label>
        <select name="user_id" id="user_id" class="form-control" required>
          <option value="">-- Select User --</option>
          <?php
            $users = $conn->query("SELECT id, name, email, age, gender, height, weight, goal FROM users");
            while ($u = $users->fetch_assoc()):
          ?>
            <option value="<?= $u['id'] ?>"
              <?= (isset($edit_data['user_id']) && $edit_data['user_id'] == $u['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($u['name'])." (".$u['email'].")" ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
    </div>

    <!-- Auto User Info -->
    <div id="userInfo" class="alert alert-info" style="display:none;">
      <p><b>Name:</b> <span id="u_name"></span></p>
      <p><b>Email:</b> <span id="u_email"></span></p>
      <p><b>Age:</b> <span id="u_age"></span></p>
      <p><b>Gender:</b> <span id="u_gender"></span></p>
      <p><b>Height:</b> <span id="u_height"></span> cm</p>
      <p><b>Weight:</b> <span id="u_weight"></span> kg</p>
      <p><b>Goal:</b> <span id="u_goal"></span></p>
    </div>

    <!-- Diet Plan Inputs -->
    <div class="row mb-3">
      <div class="col"><input type="text" name="breakfast" class="form-control" placeholder="Breakfast" value="<?= $edit_data['breakfast'] ?? '' ?>"></div>
      <div class="col"><input type="text" name="lunch" class="form-control" placeholder="Lunch" value="<?= $edit_data['lunch'] ?? '' ?>"></div>
    </div>

    <div class="row mb-3">
      <div class="col"><input type="text" name="snacks" class="form-control" placeholder="Snacks" value="<?= $edit_data['snacks'] ?? '' ?>"></div>
      <div class="col"><input type="text" name="dinner" class="form-control" placeholder="Dinner" value="<?= $edit_data['dinner'] ?? '' ?>"></div>
    </div>

    <div class="mb-3">
      <textarea name="notes" class="form-control" placeholder="Notes"><?= $edit_data['notes'] ?? '' ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Save Plan</button>
  </form>
</div>

<!-- Diet Plans Table -->
<div class="card p-3">
  <h4>📋 All Diet Plans</h4>
  <table class="table table-bordered">
    <tr>
      <th>ID</th><th>User</th><th>Breakfast</th><th>Lunch</th>
      <th>Snacks</th><th>Dinner</th><th>Notes</th><th>Actions</th>
    </tr>
    <?php
      $plans = $conn->query("SELECT diet_plans.*, users.name 
                             FROM diet_plans 
                             JOIN users ON diet_plans.user_id=users.id");
      while ($row = $plans->fetch_assoc()):
    ?>
    <tr>
      <td><?= $row['diet_id'] ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['breakfast']) ?></td>
      <td><?= htmlspecialchars($row['lunch']) ?></td>
      <td><?= htmlspecialchars($row['snacks']) ?></td>
      <td><?= htmlspecialchars($row['dinner']) ?></td>
      <td><?= htmlspecialchars($row['notes']) ?></td>
      <td>
        <a href="?edit=<?= $row['diet_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?delete=<?= $row['diet_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this plan?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<script>
document.getElementById("user_id").addEventListener("change", function() {
    let uid = this.value;
    if (uid) {
        fetch("get_user.php?id=" + uid)
        .then(res => res.json())
        .then(data => {
            if (data) {
                document.getElementById("u_name").innerText = data.name;
                document.getElementById("u_email").innerText = data.email;
                document.getElementById("u_age").innerText = data.age ?? "N/A";
                document.getElementById("u_gender").innerText = data.gender ?? "N/A";
                document.getElementById("u_height").innerText = data.height ?? "N/A";
                document.getElementById("u_weight").innerText = data.weight ?? "N/A";
                document.getElementById("u_goal").innerText = data.goal ?? "N/A";
                document.getElementById("userInfo").style.display = "block";
            } else {
                document.getElementById("userInfo").style.display = "none";
            }
        });
    } else {
        document.getElementById("userInfo").style.display = "none";
    }
});
</script>

</body>
</html>
