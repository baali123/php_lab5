<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Config\Database;
use Controller\TrainController;
use Controller\BookingController;

$database = new Database();
$db = $database->getConnection();

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trainId'])) {
    $passengerDetails = [
        'name' => $_POST['passenger_name'],
        'email' => $_POST['passenger_email'],
        'phone' => $_POST['passenger_phone']
    ];
    
    $bookingController = new BookingController($db);
    $success = $bookingController->book($_POST['trainId'], $passengerDetails);
    
    if (!$success) {
        $error = "Booking failed. Please try again.";
    }
}

// Search trains
if (isset($_GET['destination']) && isset($_GET['date'])) {
    $destination = $_GET['destination'];
    $date = $_GET['date'];

    $trainController = new TrainController($db);
    $trains = $trainController->search($destination, $date);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Trains</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .booking-form { display: none; padding: 20px; background: #f9f9f9; margin: 10px 0; }
        .error { color: red; padding: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Available Trains for <?php echo htmlspecialchars($destination); ?></h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (empty($trains)): ?>
        <p>No available trains found for this destination.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Train Name</th>
                <th>Date</th>
                <th>Available Seats</th>
                <th>Action</th>
            </tr>
            <?php foreach ($trains as $train): ?>
            <tr>
                <td><?php echo htmlspecialchars($train['name']); ?></td>
                <td><?php echo htmlspecialchars($train['date']); ?></td>
                <td><?php echo htmlspecialchars($train['available_seats']); ?></td>
                <td>
                    <button onclick="showBookingForm(<?php echo $train['id']; ?>)" 
                            <?php echo ($train['available_seats'] < 1) ? 'disabled' : ''; ?>>
                        <?php echo ($train['available_seats'] < 1) ? 'Sold Out' : 'Book'; ?>
                    </button>
                    
                    <div id="booking-form-<?php echo $train['id']; ?>" class="booking-form">
                        <form action="" method="POST">
                            <input type="hidden" name="trainId" value="<?php echo $train['id']; ?>">
                            
                            <div class="form-group">
                                <label for="passenger_name">Full Name:</label>
                                <input type="text" name="passenger_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="passenger_email">Email:</label>
                                <input type="email" name="passenger_email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="passenger_phone">Phone:</label>
                                <input type="tel" name="passenger_phone" required>
                            </div>
                            
                            <button type="submit">Confirm Booking</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    
    <p><a href="index.php">Back to Search</a></p>

    <script>
        function showBookingForm(trainId) {
            // Hide all booking forms first
            document.querySelectorAll('.booking-form').forEach(form => {
                form.style.display = 'none';
            });
            // Show the selected form
            document.getElementById('booking-form-' + trainId).style.display = 'block';
        }
    </script>
</body>
</html>