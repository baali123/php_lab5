<?php

namespace Controller;

use Model\Train;

class TrainController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function search($destination, $date) {
        $trainModel = new Train($this->db);
        return $trainModel->searchTrains($destination, $date); // Fetch trains from model
    }
}