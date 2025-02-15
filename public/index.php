<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

// Include necessary files

use Config\Database;
use Controller\TrainController;
use Controller\BookingController;

$database = new Database();
$db = $database->getConnection();
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

    <a href="/railway_system/src/View/view-bookings.php" class="button">View Your Bookings</a>

    <?php
    // Handle Booking Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trainId']) && isset($_POST['userId'])) {
        $trainId = $_POST['trainId'];
        $userId = $_POST['userId']; // You should replace this with the actual user ID from your session or authentication logic
        
        $bookingController = new BookingController($db);
        $success = $bookingController->book($trainId, $userId);
        
        if ($success) {
            echo "<p>Booking successful!</p>";
        } else {
            echo "<p>Booking failed. Please try again.</p>";
        }
    }
    ?>
</body>
</html>