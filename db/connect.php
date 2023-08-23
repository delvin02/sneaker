<?php
$servername = "localhost";
$username = "root";        // Change this if you've set a different MySQL username
$password = "";            // Change this if you've set a different MySQL password
$dbname = "ecommerce"; // Replace with the name of your created database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

    CREATE TABLE Order (
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
        FOREIGN KEY (OrderId) REFERENCES Order(OrderId),
        FOREIGN KEY (ProductId) REFERENCES Product(ProductId)
    );
";

if ($conn->multi_query($sql) === TRUE)
{
    echo "Tables created successfully <br>";
}
else {
    echo "Error creating tables: ", $conn->error . "<br>";
}

$conn->close();
?>