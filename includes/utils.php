<?php

class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $port;
    private $conn;


    public function __construct(
        $servername = "127.0.0.1",
        $username = "lucid",
        $password = "password",
        $dbname = "ecommerce",
        $port = 3306
    ) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Database Class Helper
class Category
{
    private $DatabaseConnection;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection->getConnection();
    }

    public function createCategory($categoryName)
    {
        $sql = "INSERT INTO Category (CategoryName) VALUES (?)";

        // Prepare the SQL statement
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            // Bind the category name parameter
            $stmt->bind_param("s", $categoryName);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Category '$categoryName' created successfully.<br>";
            } else {
                echo "Error creating category: " . $stmt->error . "<br>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }
    }

    public function getCategoryIdByName($categoryName)
    {
        $sql = "SELECT CategoryId FROM Category WHERE CategoryName = ?";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $categoryName);

            if ($stmt->execute()) {
                $stmt->bind_result($categoryId);

                if ($stmt->fetch()) {
                    // Close the statement
                    $stmt->close();

                    // Return the category ID found
                    return $categoryId;
                } else {
                    // No matching category found
                    $stmt->close();
                    return null;
                }
            } else {
                echo "Error executing query: " . $stmt->error . "<br>";
            }
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }

        return null;
    }

}

class Product
{
    private $DatabaseConnection;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection->getConnection();
    }

    public function createProduct($productName, $description, $price, $stockQuantity, $categoryId, $imageFile)
    {
        $sql = "INSERT INTO Product (ProductName, Description, Price, StockQuantity, CategoryId, ImageFile) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdiss", $productName, $description, $price, $stockQuantity, $categoryId, $imageFile);

            if ($stmt->execute()) {
                echo "Product '$productName' created successfully. <br>";
            } else {
                echo "Error creating product: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }
    }

    public function getProductsLimited($limit = 5)
    {
        $sql = "SELECT p.*, c.CategoryName 
                FROM Product p
                LEFT JOIN Category c ON p.CategoryId = c.CategoryId
                LIMIT ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $limit);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $products = [];

                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }

                return $products;
            } else {
                echo "Error executing query: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }

        return [];
    }
}
class Cart
{
    private $cartItems = [];
    private $DatabaseConnection;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection;
    }

    public function addToCart($productId, $quantity)
    {
        $product = $this->getProductFromDatabase($productId);

        if ($product) {
            if (array_key_exists($productId, $this->cartItems)) {
                $this->cartItems[$productId]['quantity'] += $quantity;
            } else {
                $this->cartItems[$productId] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
            return true;
        }
        return false;
    }

    public function removeFromCart($productId)
    {
        if (array_key_exists($productId, $this->cartItems)) {
            unset($this->cartItems[$productId]);
            return true;
        }

        return false;
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->cartItems as $item) {
            $total += $item['product']['Price'] * $item['quantity'];
        }
        return $total;
    }

    private function getProductFromDatabase($productId)
    {
        $conn = $this->DatabaseConnection->getConnection();

        $stmt = $conn->prepare("SELECT * FROM Product WHERE ProductId = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}


?>