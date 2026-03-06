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

// Fetch user details from DB
$query = "Select name, email, phone, password, created_at, age, gender, height, weight, goal from users where id='$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);
?>

<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif; }
        .profile-card {
            margin: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 8px 15px rgba(0,0,0,0.2);
        }
        h3 { font-family: 'Times New Roman'; font-weight: bold; color: #2c3e50; text-align: center; margin-bottom: 25px; }
        table { font-size: 16px; }
        .edit-field { display: none; }
    </style>
</head>
<body>
<div class="profile-card">
    <h3>My Profile</h3>

    <form id="profileForm" method="POST">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="30%">Name</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['name']) ?></span>
                        <input type="text" class="form-control edit-field" name="name" value="<?= htmlspecialchars($user_data['name']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Contact No.</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['phone']) ?></span>
                        <input type="text" class="form-control edit-field" name="phone" value="<?= htmlspecialchars($user_data['phone']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['email']) ?></span>
                        <input type="email" class="form-control edit-field" name="email" value="<?= htmlspecialchars($user_data['email']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['password']) ?></span>
                        <input type="text" class="form-control edit-field" name="password" value="<?= htmlspecialchars($user_data['password']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['age']) ?></span>
                        <input type="number" class="form-control edit-field" name="age" value="<?= htmlspecialchars($user_data['age']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['gender']) ?></span>
                        <select name="gender" class="form-control edit-field">
                            <option <?= $user_data['gender']=='Male'?'selected':'' ?>>Male</option>
                            <option <?= $user_data['gender']=='Female'?'selected':'' ?>>Female</option>
                            <option <?= $user_data['gender']=='Other'?'selected':'' ?>>Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Height</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['height']) ?> cm</span>
                        <input type="number" class="form-control edit-field" name="height" value="<?= htmlspecialchars($user_data['height']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['weight']) ?> kg</span>
                        <input type="number" class="form-control edit-field" name="weight" value="<?= htmlspecialchars($user_data['weight']) ?>">
                    </td>
                </tr>
                <tr>
                    <th>Goal</th>
                    <td>
                        <span class="view-field"><?= htmlspecialchars($user_data['goal']) ?></span>
                        <select name="goal" id="goal" class="form-control edit-field">
                            <option >-- Select Goal --</option>
                            <option <?= $user_data['goal']=="Lose Weight" ? "selected" : "" ?>>Lose Weight</option>
                            <option <?= $user_data['goal']=="Gain Weight" ? "selected" : "" ?>>Gain Weight</option>
                            <option <?= $user_data['goal']=="Maintain" ? "selected" : "" ?>>Maintain</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Register Date</th>
                    <td><span class="view-field"><?= htmlspecialchars($user_data['created_at']) ?></span></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <button type="button" id="edit-btn" class="btn btn-primary">Edit</button>   
            <button type="submit" id="save-btn" class="btn btn-success" style="display:none;">Save</button>
            <button type="button" id="cancel-btn" class="btn btn-secondary" style="display:none;">Cancel</button>
            <button type="button" id="delete-btn" class="btn btn-danger">Delete Profile</button>
        </div>
    </form>
</div>

</body>
</html>
