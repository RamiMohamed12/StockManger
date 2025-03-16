<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    }

    protected function tearDown(): void {
        $this->conn->close();
    }

    public function testLogin() {
        $_POST['name'] = 'testuser';
        $_POST['password'] = 'password123';

        ob_start();
        include __DIR__ . '/../index.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: src/View/dashboard.php', $output);
    }

    public function testRegister() {
        $_POST['name'] = 'newuser';
        $_POST['password'] = 'Password123';
        $_POST['confirm_password'] = 'Password123';

        ob_start();
        include __DIR__ . '/../register.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: index.php', $output);
    }
}
?>