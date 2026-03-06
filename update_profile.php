<?php
session_start();
include("db_connect.php");
$user_id = $_SESSION['user_id'];
if (isset($_SESSION['user_id'])) 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $name   = mysqli_real_escape_string($conn, $_POST['name']);
        $phone  = mysqli_real_escape_string($conn, $_POST['phone']);
        $email  = mysqli_real_escape_string($conn, $_POST['email']);
        $password  = mysqli_real_escape_string($conn, $_POST['password']);
        $age    = isset($_POST['age']) ? (int)$_POST['age'] : 0;
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $height = isset($_POST['height']) ? (int)$_POST['height'] : 0;
        $weight = isset($_POST['weight']) ? (int)$_POST['weight'] : 0;
        $goal   = mysqli_real_escape_string($conn, $_POST['goal']);
        

        $update = "UPDATE users 
               SET name='$name', phone='$phone', email='$email', password='$password', age='$age',
                   gender='$gender', height='$height', weight='$weight', goal='$goal'
               WHERE id='$user_id'";

        if (mysqli_query($conn, $update)) 
        {
            $_SESSION['name'] = $name;
            echo "success";
        } 
        else 
        {
            echo "error: " . mysqli_error($conn);
        }
    }    
}
else
{
    echo "not logged in";
    exit;
}

?>
