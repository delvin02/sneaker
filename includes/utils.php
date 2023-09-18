<?php

class DatabaseConnection {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection(){
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Database Class Helper
class Category {
    private $DatabaseConnection;

    public function __construct($DatabaseConnection) {
        $this->DatabaseConnection = $DatabaseConnection->getConnection();
    }
    
    public function createCategory($categoryName) {
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

}
class Cart {
    private $cartItems = [];
    private $DatabaseConnection;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection;
    }

    public function addToCart($productId, $quantity)
    {
        $product = $this->getProductFromDatabase($productId);

        if($product){
            if (array_key_exists($productId, $this->cartItems))
            {
                $this->cartItems[$productId]['quantity'] += $quantity;
            } else{
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
        if (array_key_exists($productId, $this->cartItems))
        {
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

        foreach($this->cartItems as $item)
        {
            $total += $item['product']['Price'] * $item['quantity'];
        }
        return $total;
    }

    private function getProductFromDatabase($productId){
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