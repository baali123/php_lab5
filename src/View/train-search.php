<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once '../Config/db.php';
require_once '../src/Controller/TrainController.php';

// Display Home Page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Booking System</title>
</head>
<body>
    <h1>Welcome to the Train Booking System</h1>
    <form action="search.php" method="GET">
        <button type="submit">Book a Train</button>
    </form>
</body>
</html>