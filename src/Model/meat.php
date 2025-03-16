<?php
class Meat {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM meat_stock";
        return $this->conn->query($sql);
    }

    public function getById($id) {
        $sql = "SELECT * FROM meat_stock WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($meat_name, $available_kg, $starting_price) {
        $sql = "INSERT INTO meat_stock (meat_name, available_kg, starting_price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdd", $meat_name, $available_kg, $starting_price);
        return $stmt->execute();
    }

    public function update($id, $meat_name, $available_kg, $starting_price) {
        $sql = "UPDATE meat_stock SET meat_name = ?, available_kg = ?, starting_price = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sddi", $meat_name, $available_kg, $starting_price, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM meat_stock WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>