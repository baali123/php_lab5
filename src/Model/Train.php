<?php

namespace Model;

use PDO;

class Train {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function searchTrains($destination, $date) {
        $query = "SELECT * FROM trains WHERE destination = :destination AND date = :date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}