<?php

namespace App\Controllers;

use App\Models\Order;

class OrderController {
    public function index() {
        $status = $_GET['status'] ?? null;
        $orderModel = new Order();
        $orders = $orderModel->getAll($status);
        
        header('Content-Type: application/json');
        echo json_encode($orders);
    }

    public function show($id) {
        $orderModel = new Order();
        $order = $orderModel->getById($id);
        
        header('Content-Type: application/json');
        echo json_encode($order);
    }

    public function update($id) {
        parse_str(file_get_contents("php://input"), $_PATCH);
        $status = $_PATCH['status'] ?? null;
        
        if ($status) {
            $orderModel = new Order();
            $orderModel->updateStatus($id, $status);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Status required']);
        }
    }
}
