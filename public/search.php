<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Trains</title>
</head>
<body>
    <h1>Enter Destination</h1>
    <form action="results.php" method="GET">
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required>
        <input type="date" id="date" name="date" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>