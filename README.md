# Stock Management System

This is a Stock Management System for managing inventory, employees, and generating reports. The system is built using PHP, MySQL, and JavaScript, and it includes features such as user authentication, inventory management, employee management, and reporting.

## Features

- **User Authentication**: Secure login and logout functionality.
- **Inventory Management**: Add, edit, delete, and view stock items.
- **Employee Management**: Add, edit, delete, and view employees.
- **Reporting**: Generate and view reports on inventory levels, stock movement, and employee activities.
- **Settings**: Configure system settings, user preferences, and notification parameters.

## Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/yourusername/stock-management-system.git
    cd stock-management-system
    ```

2. **Set up the database**:
    - Create a MySQL database named `stock`.
    - Create the necessary tables using the following SQL statements:

    ```sql
    CREATE TABLE employee (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        salary DECIMAL(10,2) NOT NULL,
        profession VARCHAR(100) NOT NULL
    );

    CREATE TABLE meat_stock (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        meat_name VARCHAR(100) NOT NULL,
        available_kg DECIMAL(10,2) NOT NULL,
        starting_price DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    ```

3. **Configure the environment variables**:
    - Create a `.env` file in the project root directory with the following content:
        ```properties
        DB_HOST=localhost
        DB_USERNAME=root
        DB_PASSWORD=
        DB_NAME=stock
        ```

4. **Start the server**:
    - If you are using XAMPP, place the project folder in the `htdocs` directory.
    - Start Apache and MySQL from the XAMPP control panel.
    - Access the project in your browser at `http://localhost/stock`.

## Usage

- **Login**: Access the login page at `http://localhost/stock/index.php`.
- **Dashboard**: After logging in, you will be redirected to the dashboard.
- **Inventory Management**: Manage your stock items from the inventory page.
- **Employee Management**: Manage your employees from the employee page.
- **Reports**: Generate and view reports from the reports page.
- **Settings**: Configure system settings from the settings page.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

- [Chart.js](https://www.chartjs.org/) for data visualization.
- [Font Awesome](https://fontawesome.com/) for icons.
- [XAMPP](https://www.apachefriends.org/index.html) for the development environment.