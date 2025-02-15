<?php

namespace Controller;

use Model\Booking;

class BookingController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function viewBookingsByPassenger($name, $email) {
        $bookingModel = new Booking($this->db);
        return $bookingModel->getBookingsByPassenger($name, $email);
    }

    public function book($trainId, $passengerDetails) {
        $bookingModel = new Booking($this->db);
        $bookingId = $bookingModel->bookTicket($trainId, $passengerDetails);
        
        if ($bookingId) {
            $bookingDetails = $bookingModel->getBookingDetails($bookingId);
            include __DIR__ . '/../../src/View/booking-confirmation.php';
            return true;
        }
        return false;
    }
}