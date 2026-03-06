<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health & Diet Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            font-size: 24px;
        }
        .banner {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }
        .banner img {
            width: 300px;   /* image size */
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        Health & Diet Tracking Project
    </header>

    <!-- Images Section -->
    <div class="banner">
        <img src="images/food_tracker.jpg" alt="Diet Tracker">
        <img src="images/health_app.jpg" alt="Health App">
        <img src="images/meal_plan.jpg" alt="Meal Plan">
    </div>
</body>
</html>
CREATE TABLE health_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    sleep_hours DECIMAL(4,1),
    calories INT,
    water_liters DECIMAL(4,1),
    workout VARCHAR(50),
    workout_time INT,
    mood_level INT,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES profile(user_id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);