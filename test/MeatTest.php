<?php

use PHPUnit\Framework\TestCase;

class MeatTest extends TestCase {
    private $conn;
    private $meat;

    protected function setUp(): void {
        $this->conn = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $this->meat = new Meat($this->conn);
    }

    protected function tearDown(): void {
        $this->conn->close();
    }

    public function testGetAll() {
        $result = $this->meat->getAll();
        $this->assertIsObject($result);
    }

    public function testAddMeat() {
        $result = $this->meat->add('Beef', 100, 10.5);
        $this->assertTrue($result);
    }

    public function testGetById() {
        $result = $this->meat->getById(1);
        $this->assertIsArray($result);
    }

    public function testUpdateMeat() {
        $result = $this->meat->update(1, 'Beef', 150, 12.5);
        $this->assertTrue($result);
    }

    public function testDeleteMeat() {
        $result = $this->meat->delete(1);
        $this->assertTrue($result);
    }
}
?>