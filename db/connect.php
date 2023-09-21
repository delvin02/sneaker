<?php

require_once('../includes/utils.php');

$servername = "localhost";
$username = "lucid";
$password = "password";
$dbname = "ecommerce";
$port = 3307;

// Create an instance of DatabaseConnection
$databaseConnection = new DatabaseConnection($servername, $username, $password, $dbname, $port);

// Get the database connection
$conn = $databaseConnection->getConnection();


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
        CategoryId INT AUTO_INCREMENT PRIMARY KEY,
        CategoryName VARCHAR(100) NOT NULL
    );

    CREATE TABLE Product (
        ProductId INT AUTO_INCREMENT PRIMARY KEY,
        ProductName VARCHAR(255) NOT NULL,
        Description TEXT,
        Price DECIMAL(10, 2) NOT NULL,
        StockQuantity INT NOT NULL,
        CategoryId INT,
        ImageFile varchar(255) NOT NULL,
        FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId)
    );

    CREATE TABLE User (
        UserId INT PRIMARY KEY AUTO_INCREMENT,
        Email VARCHAR(100) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        FirstName VARCHAR(100) NOT NULL,
        LastName VARCHAR(100) NOT NULL
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


// POPULATING DEFAULT USER
$userName = "weei.khor@student.tafesa.edu.au";
$userPassword = "password";

$FirstName = "Florence";
$LastName = "Li";

$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO User (Email, Password, FirstName, LastName) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $userName, $hashedPassword, $FirstName, $LastName);
if ($stmt->execute()) {
    echo "User added succesfully";
} else {
    echo "Error adding user: " . $stmt->error;
}

// Create instances of Category, Product, and Cart using the $databaseConnection
$category = new Category($databaseConnection);
$product = new Product($databaseConnection);
$cart = new Cart($databaseConnection);

$categories = ['Nike', 'Yeezy', 'Air Jordan', 'Adidas', 'Balenciaga', 'Balmain', 'Nike x Off-White', 'Off-White', 'Nike x Tiffany & Co'];


foreach ($categories as $categoryName) {
    $category->createCategory($categoryName);
}
$products = [
    ['3XL Panelled', 'Description for SB Dunk', 3242, 60, 'Balenciaga', 'src/images/sneakers/balenciaga.png'],
    ['Unicorn low-top', 'Description for SB Dunk', 3242, 60, 'Balmain', 'src/images/sneakers/balmain-unicorn.png'],
    ['Tiffany and Co Air Force 1 Low sneakers', "Nike teams up with iconic jewellery brand Tiffany & Co. to produce an eye-catching update to the classic Air Force 1 Low sneaker. Boasting a nubuck leather construction in a sleek black hue, the style is defined by the signature Swoosh logo to the side that flaunts the immediately recognisable Tiffany blue hue while A Tiffany & Co. logo patch at the tongue and hallmarked silver embellishments to the rear complete the look.", 3008, 60, 'Nike x Tiffany & Co', 'src/images/sneakers/nike-tiffany-and-co.png'],
    ['Dunk Low "Lot 50" sneakers', "Virgil Abloh and Nike have teamed up once again for a new iteration of the Dunk Low. In a full-black leather construction and equipped with a metallic silver Swoosh, the pair comes with overlaid rope lacing system from past Off-White™ x Nike Dunk Low collaborations. Also, to finish the look, there's signature silver text on the lateral quarter and a silver Nike Sportswear hit on the heel.", 3242, 60, 'Nike x Off-White', 'src/images/sneakers/nike-offwhite-lot50.png'],
    ["Travis Scott Air Max 270 'Cactus Trails'", 'The sneaker upper features wavy cream synthetic overlays sitting atop the tonal mesh base while a brown nubuck toe cap with mini embroidered Swoosh branding adds contrast.', 8888, 60, 'Balenciaga', 'src/images/sneakers/travis-scott-cactus.png'],
    ['SB DUNK LOW “MUMMY”', 'Description for NIKE SB DUNK LOW “MUMMY”', 129.99, 50, 'Nike', 'src/images/sneakers/mummy.png'],
    ['Yeezy boost Oat', 'Description for Yeezy boost 750', 199.99, 30, 'Yeezy', 'src/images/sneakers/sneaker1.png'],
    ['Air Jordan University Blue', 'Description for Air Jordan University Blue', 179.99, 40, 'Air Jordan', 'src/images/sneakers/sneaker2.png'],
    ['SB Dunk', 'Description for SB Dunk', 99.99, 60, 'Adidas', 'src/images/sneakers/dunk.png'],
    ['Nike Offwhite Vapormax Flyknit', 'Description for SB Dunk', 1000, 60, 'Nike', 'src/images/sneakers/nike-offwhite-vapormax.png']
];

foreach ($products as $productData) {
    list($productName, $description, $price, $stockQuantity, $categoryName, $imageFile) = $productData;

    // Retrieve the categoryId based on the categoryName
    $categoryId = $category->getCategoryIdByName($categoryName);

    if ($categoryId !== null) {
        // Create the product with the retrieved categoryId
        $product->createProduct($productName, $description, $price, $stockQuantity, (int) $categoryId, $imageFile);
    } else {
        echo "Error: Category '$categoryName' does not exist.<br>";
    }
}


$databaseConnection->closeConnection();
$conn->close();

?>