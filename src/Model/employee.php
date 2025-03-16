<?php

class Employee {
    private $conn; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM employee";
        return $this->conn->query($sql);
    }

    public function getById($id) {
        $sql = "SELECT * FROM employee WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($name, $address, $email, $salary, $profession) {
        $sql = "INSERT INTO employee (name, address, email, salary, profession) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssds", $name, $address, $email, $salary, $profession);
        return $stmt->execute();
    }

    public function update($id, $name, $address, $email, $salary, $profession) {
        $sql = "UPDATE employee SET name = ?, address = ?, email = ?, salary = ?, profession = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdsi", $name, $address, $email, $salary, $profession, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM employee WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>