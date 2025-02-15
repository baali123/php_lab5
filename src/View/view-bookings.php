<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../../vendor/autoload.php';

use Config\Database;
use Controller\BookingController;

$database = new Database();
$db = $database->getConnection();

$bookings = [];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['passenger_name']) && isset($_POST['passenger_email'])) {
        $bookingController = new BookingController($db);
        $bookings = $bookingController->viewBookingsByPassenger(
            $_POST['passenger_name'],
            $_POST['passenger_email']
        );
        
        if (empty($bookings)) {
            $message = "No bookings found for the provided details.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Your Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .search-form {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .booking-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            background: #f8d7da;
            color: #721c24;
        }
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Your Bookings</h1>
        
        <div class="search-form">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="passenger_name">Full Name:</label>
                    <input type="text" 
                           id="passenger_name" 
                           name="passenger_name" 
                           value="<?php echo isset($_POST['passenger_name']) ? htmlspecialchars($_POST['passenger_name']) : ''; ?>"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="passenger_email">Email:</label>
                    <input type="email" 
                           id="passenger_email" 
                           name="passenger_email" 
                           value="<?php echo isset($_POST['passenger_email']) ? htmlspecialchars($_POST['passenger_email']) : ''; ?>"
                           required>
                </div>
                
                <button type="submit">Search Bookings</button>
            </form>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if (!empty($bookings)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Train</th>
                        <th>Destination</th>
                        <th>Travel Date</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['train_name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                            <td><?php echo htmlspecialchars($booking['date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                            <td class="status-<?php echo strtolower($booking['status']); ?>">
                                <?php echo htmlspecialchars($booking['status']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="/railway_system/public/index.php" class="back-link">← Back to Home</a>
    </div>
</body>
</html>