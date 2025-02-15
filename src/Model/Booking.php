<?php

namespace Model;

use PDO;
use PDOException;

class Booking {
    private $conn;
    private $table = 'bookings';

    

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBookingsByPassenger($name, $email) {
        try {
            $query = "SELECT b.*, t.name AS train_name, t.destination, t.date 
                      FROM bookings b 
                      JOIN trains t ON b.train_id = t.id 
                      WHERE b.passenger_name = :name 
                      AND b.passenger_email = :email 
                      ORDER BY b.booking_date DESC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get Bookings Error: " . $e->getMessage());
            return [];
        }
    }

    public function bookTicket($trainId, $passengerDetails) {
        try {
            // Start transaction
            $this->conn->beginTransaction();

            // Check available seats
            $query = "SELECT available_seats FROM trains WHERE id = :trainId FOR UPDATE";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':trainId', $trainId);
            $stmt->execute();
            $train = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$train || $train['available_seats'] < 1) {
                throw new \Exception("No seats available");
            }

            // Update seats
            $updateSeatsQuery = "UPDATE trains SET available_seats = available_seats - 1 WHERE id = :trainId";
            $updateStmt = $this->conn->prepare($updateSeatsQuery);
            $updateStmt->bindParam(':trainId', $trainId);
            $updateStmt->execute();

            // Create booking
            $insertQuery = "INSERT INTO bookings (train_id, passenger_name, passenger_email, passenger_phone, status) 
                           VALUES (:trainId, :name, :email, :phone, 'confirmed')";
            $insertStmt = $this->conn->prepare($insertQuery);
            $insertStmt->bindParam(':trainId', $trainId);
            $insertStmt->bindParam(':name', $passengerDetails['name']);
            $insertStmt->bindParam(':email', $passengerDetails['email']);
            $insertStmt->bindParam(':phone', $passengerDetails['phone']);
            $insertStmt->execute();

            // Get the booking ID
            $bookingId = $this->conn->lastInsertId();

            // Commit transaction
            $this->conn->commit();
            return $bookingId;

        } catch (\Exception $e) {
            // Rollback transaction on error
            $this->conn->rollBack();
            error_log("Booking Error: " . $e->getMessage());
            return false;
        }
    }

    public function getBookingDetails($bookingId) {
        try {
            $query = "SELECT b.*, t.name AS train_name, t.destination, t.date 
                      FROM bookings b 
                      JOIN trains t ON b.train_id = t.id 
                      WHERE b.id = :bookingId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':bookingId', $bookingId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get Booking Details Error: " . $e->getMessage());
            return null;
        }
    }
}