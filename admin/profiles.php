<?php
include(__DIR__ . '/../db_connect.php');

$query = "SELECT id,name,email,phone,age,gender,height,weight,goal,created_at FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$profiles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $profiles[] = $row;
}
?>

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

<script>
document.getElementById('viewProfilesBtn').addEventListener('click', function(){
  const section = document.getElementById('profilesSection');

  if(section.style.display === 'none'){
    // AJAX call
    fetch('profiles_list.php')
      .then(response => response.text())
      .then(data => {
        section.innerHTML = data;
        section.style.display = 'block';
      });
    this.textContent = 'Hide';
  } else {
    section.style.display = 'none';
    this.textContent = 'View';
  }
});
</script>
