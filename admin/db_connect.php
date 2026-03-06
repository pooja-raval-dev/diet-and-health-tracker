<?php
    $conn = new mysqli('localhost', 'root', '', 'diet_tracker_db');

    if($conn->connect_error)
    {
        die("Connection failed : ".$conn->connect_error);
    }
?>