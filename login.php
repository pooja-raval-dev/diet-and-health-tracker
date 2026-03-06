<?php
    session_start();
    include("db_connect.php");

    $email = "";
    $password = "";
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        // Email validation
        if (empty($_POST["email"])) 
        {
            $errors['email'] = "Please enter your email!";
        } 
        else 
        {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $errors['email'] = "Invalid email format.";
            }
        }

        // Password validation
        if (empty($_POST["password"])) 
        {
            $errors['password'] = "Please enter your password!";
        }
        else 
        {
            $password = test_input($_POST["password"]);
        }

        // Check in database
        if (empty($errors)) 
        {
            $query = "Select * from users where email = '$email' and password = '$password' limit 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) 
            {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                $success_message = "Login Successful! Redirecting to Dashboard...";
            } 
            else 
            {
                $errors['login'] = "Invalid email or password!";
            }
        }
    }

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #fed6e3 0%, #a8edea 100%);
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            margin: 50px auto;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0px 8px 15px rgba(0,0,0,0.2);
            background: white;
            border-radius: 15px;
        }

        h1 {
            font-family: 'Times New Roman';
            font-weight: bold;
            color: #2c3e50;
        }

        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: gray;
        }

        button:hover {
            transform: scale(1.05);
        }

        .error {
            color: red;   
            font-size: 14px;
        }
    </style>

</head>
<body>

<div class="container">

    <h1 class="text-center" style="margin-top: 20px;"><i class="fa-solid fa-heartbeat"></i> Diet & Health Tracker </h1>
    
    <div class="card">
        <form method="POST" action="">
            <h1 class="text-center">User Login</h1>

            <!-- If user enter ?Invalid Email or Password -->
            <?php 
                if (!empty($errors['login'])) 
                {
                    echo "<div class='alert alert-danger text-center'>". $errors['login'] ."</div>";
                }
            ?>

            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" id="email" class="form-control" placeholder="Username/Email Address">
                <?php if (!empty($errors['email']))
                    {
                        echo "<p class='error'>". $errors['email'] ."</p>";
                    }
                    
                ?>
            </div>

            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                <?php if (!empty($errors['password']))
                    {
                        echo "<p class='error'>". $errors['password'] ."</p>";
                    }
                ?>
            </div><br>
        
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
            <a href="register.php" class="btn btn-link btn-block">New User? Register Here</a><br>
            <a href="index.php" class="btn btn-link btn-block">Back Home</a>

        </form>
    </div>
</div>

<?php if (!empty($success_message)): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?= $success_message ?>',
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = 'dashboard.php';
    });
</script>
<?php endif; ?>

</body>
</html>