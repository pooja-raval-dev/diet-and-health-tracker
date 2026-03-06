<?php
    include("db_connect.php");

    $name =  "";
    $email = "";
    $phone = "";
    $password = "";
    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {    
        // Name validation
        if(empty($_POST["name"]))
        {
            $errors['name'] = "Please enter your Name!";
        }
        else
        {
            $name = test_input($_POST["name"]);
            if(!preg_match("/^[a-zA-Z]+( [a-zA-Z]+)*$/", $name))
            {
                $errors['name'] = "Only letters and white space allowed!";
            }   
        }
        
        //Email validation
        if(empty($_POST["email"]))
        {
            $errors['email'] = "Please enter your email!";
        }
        else
        {
            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = "Invalid email format.";
            }   
        }

        //Phone number validation
        if(empty($_POST["phone"]))
        {
            $errors['phone'] = "Please enter your phone number!";
        }
        else
        {
            $phone = test_input($_POST["phone"]);
            if(!preg_match('/^[0-9]{10}$/', $phone))
            {
                $errors['phone'] = "Phone must be 10 digits.";
            }   
        }

        // Password validation
        if(empty($_POST["password"]))
        {
            $errors['password'] = "Please enter your password!";
        }
        else
        {
            $password = test_input($_POST["password"]);
            if(strlen($password) < 6)
            {
                $errors['password'] = "Password must be at least 6 characters.";
            }   
        }

        //Save data into database
        if(empty($errors))
        {

            $query = "Insert into users(name, email, phone, password) values ('$name', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $query);
            if($result)
            {
                $success_message = "Registration Successful! Redirecting to login...";
            }
            else
            {
                echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
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
    <title>Registration page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
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

        button {
            border-radius: 10px;
            transition: 0.3s;
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
    <form method="POST" action="" id="myForm">
        <h1 class="text-center">User Registration </h1>
        <div class="form-group">
            <i class="fa fa-user"></i>
            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name (First Name Last Name)"
 value="<?= htmlspecialchars($name) ?>">
            <?php if (!empty($errors['name']))
                {
                    echo "<p style='color:red;'>".$errors['name']."</p>";
                }
            ?>
        </div>

        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address (e.g., name@example.com)"
 value="<?= htmlspecialchars($email) ?>">
            <?php if (!empty($errors['email']))
                {
                    echo "<p style='color:red;'>".$errors['email']."</p>";
                }
            ?>
        </div>

        <div class="form-group">
            <i class="fa fa-phone"></i>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Contact Number"
  value="<?= htmlspecialchars($phone) ?>" >
            <?php if (!empty($errors['phone']))
                {
                    echo "<p style='color:red;'>".$errors['phone']."</p>";
                }
            ?>
        </div>

        <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"  value="<?= htmlspecialchars($password) ?>" >
            <?php if (!empty($errors['password']))
                {
                    echo "<p style='color:red;'>".$errors['password']."</p>";
                }
            ?>
        </div><br>
        
        <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Submit</button>
        <button type="reset" name="reset" class="btn btn-secondary btn-block"><i class="fa fa-undo"></i> Reset</button>
        
        <a href="login.php" class="btn btn-link btn-block">Have an Account ? Login Here</a>
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
        timer: 3000
    }).then(() => {
        window.location.href = 'login.php';
    });
</script>
<?php endif; ?>

</body>
</html>