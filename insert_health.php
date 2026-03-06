<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("db_connect.php");
$user_id = $_SESSION['user_id']?? 0;
$errors = [];

if(!$user_id)
{
    die("User not logged in!");
}

if (isset($_SESSION['user_id'])) 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Sleep hours
        $sleep_hours = trim($_POST['sleep_hours'] ?? '');
        if ($sleep_hours === '' || !is_numeric($sleep_hours) || $sleep_hours < 0 || $sleep_hours > 24) {
            $errors['sleep_hours'] = "Sleep hours must be between 0 and 24.";
        }

        // Calories
        $calories = trim($_POST['calories'] ?? '');
        if ($calories === '' || !ctype_digit($calories) || $calories < 0) {
            $errors['calories'] = "Calories must be a non-negative integer.";
        }

        // Water intake
        $water_intake = trim($_POST['water_intake'] ?? '');
        if ($water_intake === '' || !is_numeric($water_intake) || $water_intake < 0) {
            $errors['water_intake'] = "Water intake must be a non-negative number.";
        }

        // Mood level
        $mood_level = filter_input(INPUT_POST, 'mood_level', FILTER_VALIDATE_INT);
        if (!$mood_level || $mood_level < 1 || $mood_level > 5) {
            $errors['mood_level'] = "Mood level must be between 1 and 5.";
        }

        // Notes (optional)
        $notes = trim($_POST['notes'] ?? '');


        if (empty($errors)) {
            // Check if user exists
            $check = mysqli_query($conn, "SELECT * FROM health_logs WHERE id = '$user_id'");
            if (mysqli_num_rows($check)>0) 
            {
                $query = "UPDATE health_logs 
                      SET sleep_hours='$sleep_hours', calories='$calories', 
                          water_intake='$water_intake', mood_level='$mood_level', notes='$notes'
                      WHERE id='$user_id'";
            }
            else
            {
                $query = "INSERT INTO health_logs (id, sleep_hours, calories, water_intake, mood_level, notes) VALUES ('$user_id', '$sleep_hours', '$calories', '$water_intake', '$mood_level', '$notes')";
            }

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "Success";
            } else {
                echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
        else
        {
            echo "Validation Failed!";
        }

    }
}

?>