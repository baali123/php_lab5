<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        .confirmation-card {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .detail-row {
            margin: 10px 0;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="confirmation-card">
        <h1>Booking Confirmation</h1>
        <?php if (isset($bookingDetails)): ?>
            <div class="detail-row">
                <strong>Booking ID:</strong> <?php echo htmlspecialchars($bookingDetails['id']); ?>
            </div>
            <div class="detail-row">
                <strong>Passenger Name:</strong> <?php echo htmlspecialchars($bookingDetails['passenger_name']); ?>
            </div>
            <div class="detail-row">
                <strong>Train:</strong> <?php echo htmlspecialchars($bookingDetails['train_name']); ?>
            </div>
            <div class="detail-row">
                <strong>Destination:</strong> <?php echo htmlspecialchars($bookingDetails['destination']); ?>
            </div>
            <div class="detail-row">
                <strong>Date:</strong> <?php echo htmlspecialchars($bookingDetails['date']); ?>
            </div>
            <div class="detail-row">
                <strong>Status:</strong> <?php echo htmlspecialchars($bookingDetails['status']); ?>
            </div>
        <?php else: ?>
            <p>Sorry, there was an error processing your booking. Please try again.</p>
        <?php endif; ?>
        
        <p><a href="../public/index.php">Back to Home</a></p>
    </div>
</body>
</html>