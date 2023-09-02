<?php
error_reporting(E_ALL);

$servername = "127.0.0.1";
$username = "lucid";        
$password = "password";            
$dbname = "ecommerce"; 

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DROP DATABASE IF EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully.\n";
} else {
    echo "Error dropping database: " . $conn->error . "\n";
}

// Create the database
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbname);

$sql = "
    CREATE TABLE Category (
        CategoryId INT PRIMARY KEY,
        CategoryName VARCHAR(100) NOT NULL
    );

    CREATE TABLE Product (
        ProductId INT PRIMARY KEY,
        ProductName VARCHAR(255) NOT NULL,
        Description TEXT,
        Price DECIMAL(10, 2) NOT NULL,
        StockQuantity INT NOT NULL,
        CategoryId INT,
        FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId)
    );

    CREATE TABLE User (
        UserId INT PRIMARY KEY,
        FirstName VARCHAR(50) NOT NULL,
        LastName VARCHAR(50) NOT NULL,
        Email VARCHAR(100) NOT NULL
    );

    CREATE TABLE Orders (
        OrderId INT PRIMARY KEY,
        UserId INT,
        OrderDate DATE NOT NULL,
        TotalAmount DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (UserId) REFERENCES User(UserId)
    );

    CREATE TABLE OrderItem (
        OrderItemId INT PRIMARY KEY,
        OrderId INT,
        ProductId INT,
        Quantity INT NOT NULL,
        Subtotal DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (OrderId) REFERENCES Orders(OrderId),
        FOREIGN KEY (ProductId) REFERENCES Product(ProductId)
    );
";

if ($conn->multi_query($sql) === TRUE) {
    do {
        // Check if the current statement returned a result set
        if ($result = $conn->store_result()) {
            $result->free(); // Free the result set
        }
    } while ($conn->more_results() && $conn->next_result());

    echo "Tables 'ecommerce' created successfully.";
} else {
    echo "Error creating tables: " . $conn->error;
}
$conn->close();
?>