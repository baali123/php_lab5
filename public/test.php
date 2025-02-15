<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include Composer's autoloader
require '../vendor/autoload.php';

// Correctly import the Database and TrainController classes
use Config\Database; 
use Controller\TrainController;

// Create an instance of the Database class
$database = new Database(); 
$db = $database->getConnection(); // Get the database connection

// Check if the database connection is successful
if ($db) {
    echo "Database connection established successfully.<br>";
    
    // Now instantiate TrainController
    $trainController = new TrainController($db); // Instantiate TrainController
    echo "TrainController loaded successfully."; // Confirm the class loaded
} else {
    echo "Failed to connect to the database.";
}
?>