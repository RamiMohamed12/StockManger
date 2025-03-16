
<?php

use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase {
    private $conn;
    private $employee;

    protected function setUp(): void {
        $this->conn = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        $this->employee = new Employee($this->conn);
    }

    protected function tearDown(): void {
        $this->conn->close();
    }

    public function testGetAll() {
        $result = $this->employee->getAll();
        $this->assertIsObject($result);
    }

    public function testAddEmployee() {
        $result = $this->employee->add('John Doe', '123 Main St', 'john@example.com', 50000, 'Manager');
        $this->assertTrue($result);
    }

    public function testGetById() {
        $result = $this->employee->getById(1);
        $this->assertIsArray($result);
    }

    public function testUpdateEmployee() {
        $result = $this->employee->update(1, 'John Doe', '123 Main St', 'john@example.com', 55000, 'Manager');
        $this->assertTrue($result);
    }

    public function testDeleteEmployee() {
        $result = $this->employee->delete(1);
        $this->assertTrue($result);
    }
}
?>