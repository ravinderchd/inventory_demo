<?php

namespace App\Models;

use App\Core\Database;

class Order {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll($status = null) {
        $sql = "SELECT * FROM orders";
        if ($status) {
            $stmt = $this->db->prepare("SELECT * FROM orders WHERE status = ?");
            $stmt->bind_param("s", $status);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $result = $this->db->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO orders (customer_name, status, total_price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $data['customer_name'], $data['status'], $data['total_price']);
        return $stmt->execute();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }
}
