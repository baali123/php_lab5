# Railway Booking System

A web-based railway booking system that allows users to search for trains, book tickets, and manage their bookings. Built with PHP and MySQL, this system provides a simple and efficient way to handle train reservations.

## Features

- 🔍 Search trains by destination and date
- 🎫 Book train tickets with passenger details
- 📊 View booking history
- 💺 Real-time seat availability tracking
- 📱 Responsive design for mobile and desktop

## Technologies Used

- PHP 8.3
- MySQL
- HTML5/CSS3
- JavaScript
- Composer (Dependency Management)

## Prerequisites

- PHP >= 8.3
- MySQL >= 5.7
- Composer
- Web Server (Apache/MAMP/XAMPP)

## Install dependencies:

`composer install`

## Installation & Setup

1.⁠ ⁠*Clone the Repository*
⁠ bash
git clone https://github.com/baali123/php_lab5.git
 ⁠

2.⁠ ⁠*MAMP Setup*

- Install MAMP if not already installed
- Place the cloned folder in ⁠ htdocs ⁠ directory
- Start Apache and MySQL services

3.⁠ ⁠*Database Setup*

- Open phpMyAdmin
- Create a new database named 'Train_management_system'
- Import the SQL file from ⁠ sql/Train_management_system.sql ⁠

4.⁠ ⁠*Composer Setup*

- Install Composer if not already installed
- Navigate to project directory
- Run Composer installation:
  ```
  composer install
  ```

5.⁠ ⁠*Application Setup*

- Access the application at:

⁠  http://localhost/railway_system

## Configure your web server:

Point the document root to the public directory
Ensure mod_rewrite is enabled for Apache

## Database Setup

Run the following SQL commands to create the required tables:

```
CREATE TABLE trains (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    available_seats INT NOT NULL DEFAULT 100
);

CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    train_id INT NOT NULL,
    passenger_name VARCHAR(100) NOT NULL,
    passenger_email VARCHAR(100) NOT NULL,
    passenger_phone VARCHAR(20) NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'confirmed',
    FOREIGN KEY (train_id) REFERENCES trains(id)
);
```

## Usage

<br>

### Home Page (index.php):

Search for trains by entering destination and date

View available trains

Access booking history

<br>

### Booking Process:

Search for trains

Select desired train

Fill in passenger details

Confirm booking

Receive booking confirmation

<br>

### View Bookings:

Enter passenger name and email

View all bookings associated with the provided details
