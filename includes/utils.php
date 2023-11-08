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

    public function createProduct($productName, $description, $price, $categoryId, $imageFile)
    {
        $sql = "INSERT INTO Product (ProductName, Description, Price, CategoryId, ImageFile) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdss", $productName, $description, $price, $categoryId, $imageFile);

            if ($stmt->execute()) {
                $productId = $stmt->insert_id;
                echo "Product '$productName' created successfully. <br>";

                $stmt->close();
                return $productId;
            } else {
                echo "Error creating product: " . $stmt->error . "<br>";
            }
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }
        return null;
    }

    // GETTERS
    public function getProductById($id)
    {
        $sql = "SELECT p.*, c.CategoryName, ps.Size, ps.Quantity
            FROM Product p
            LEFT JOIN Category c ON p.CategoryId = c.CategoryId
            LEFT JOIN ProductSize ps on p.ProductId = ps.ProductId
            WHERE p.ProductId = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $product = $result->fetch_assoc();
                    return $product;
                } else {
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

    public function getRandomProductsLimited($limit = 5)
    {
        $sql = "SELECT p.*, c.CategoryName 
                FROM Product p
                LEFT JOIN Category c ON p.CategoryId = c.CategoryId
                ORDER BY RAND()
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

    public function searchProducts($query)
    {
        // Use a prepared statement to search for products based on the query
        $sql = "SELECT p.*, c.CategoryName 
            FROM Product p
            LEFT JOIN Category c ON p.CategoryId = c.CategoryId
            WHERE (p.ProductName LIKE ? OR p.Description LIKE ? OR c.CategoryName LIKE ?)";

        $query = "%$query%"; // Add wildcard characters to search for partial matches

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $query, $query, $query);

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

class ProductSize
{
    private $DatabaseConnection;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection->getConnection();
    }

    public function create($productId, $size, $quantity)
    {
        $sql = "INSERT INTO ProductSize (ProductId, Size, Quantity) VALUES (?, ?, ?)";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("isi", $productId, $size, $quantity);
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error inserting product size: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error;
        }

        return false;
    }

    public function getProductById($productId)
    {
        $sql = "SELECT * FROM ProductSize WHERE ProductId = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $productId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    // Return the first (and only) row as an associative array
                    return $result->fetch_assoc();
                } else {
                    echo "No matching product size found for the given product and size.";
                }
            } else {
                echo "Error executing query: " . $stmt->error . "<br>";
            }
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }

        return null;
    }

    public function getProductByIdAndSize($productId, $size)
    {
        $sql = "SELECT * FROM ProductSize WHERE ProductId = ? AND Size = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $productId, $size);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    // Return the first (and only) row as an associative array
                    return $result->fetch_assoc();
                } else {
                    echo "No matching product size found for the given product and size.";
                }
            } else {
                echo "Error executing query: " . $stmt->error . "<br>";
            }
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error . "<br>";
        }

        return null;
    }

    public function getProductSizesByProductId($productId)
    {
        $sql = "SELECT Size FROM ProductSize WHERE ProductID = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $productId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $productSizes = array(); // Initialize an empty array

                while ($row = $result->fetch_assoc()) {
                    $productSizes[] = $row['Size']; // Add each size to the array
                }

                if (!empty($productSizes)) {
                    return $productSizes;
                } else {
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
    public function getProductSizeIdIdBySizeAndProductId($size, $productId)
    {
        $sql = "SELECT ProductSizeId FROM ProductSize WHERE ProductId = ? AND Size = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("is", $productId, $size);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row['ProductSizeId'];
                } else {
                    return null; // Size not found for the given product
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
class CartItem
{
    private $DatabaseConnection;
    private $productSize;

    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection->getConnection();
        $this->productSize = new ProductSize($DatabaseConnection); // Create an instance of ProductSize

    }

    public function getCartItemsByUserId($userId)
    {
        $sql = "SELECT ci.CartItemId, p.ProductName, ps.Size, ci.Quantity, p.Description, p.Price, p.ImageFile
            FROM CartItem ci
            INNER JOIN ProductSize ps ON ci.ProductSizeId = ps.ProductSizeId
            INNER JOIN Product p ON ci.ProductId = p.ProductId
            WHERE ci.UserId = ?";

        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $userId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $cartItems = array();

                while ($row = $result->fetch_assoc()) {
                    $cartItems[] = $row;
                }

                return $cartItems;
            } else {
                echo "Error retrieving cart items for the user: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error;
        }

        return array(); 
    }

    public function getCartItemByUserProduct($userId, $productId, $productSizeId, $size)
    {
        $sql = "SELECT * FROM CartItem WHERE UserId = ? AND ProductId = ? AND ProductSizeId = ?";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            // You need to fetch the ProductSizeId based on the provided size and productId
            $ProductSize = $this->productSize->getProductByIdAndSize($productId, $size);

            if (isset($ProductSize) && isset($ProductSize['ProductSizeId'])) {
                $productSizeId = $ProductSize['ProductSizeId'];

                $stmt->bind_param("iii", $userId, $productId, $productSizeId);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows === 1) {
                        return $result->fetch_assoc();
                    } else {
                        // No matching cart item found
                        return null;
                    }
                } else {
                    echo "Error retrieving cart item: " . $stmt->error;
                }
            } else {
                echo "Error: Product size not found for the given product and size.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error;
        }

        return null;
    }

    public function create($userId, $productId, $productSizeId, $quantity)
    {
        $sql = "INSERT INTO CartItem (UserId, ProductId, ProductSizeId, Quantity) VALUES (?, ?, ?, ?)";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            // You need to fetch the ProductSizeId based on the provided size and productId

            $stmt->bind_param("iiii", $userId, $productId, $productSizeId, $quantity);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error inserting cart item: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error;
        }

        return false;
    }
    public function delete($cartItemId)
    {
        $sql = "DELETE FROM CartItem WHERE CartItemId = ?";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $cartItemId);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error deleting cart item: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing delete statement: " . $this->DatabaseConnection->error;
        }

        return false;
    }

    public function updateQuantity($cartItemId, $newQuantity)
    {
        $sql = "UPDATE CartItem SET Quantity = ? WHERE CartItemId = ?";
        $stmt = $this->DatabaseConnection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $newQuantity, $cartItemId);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error updating cart item quantity: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->DatabaseConnection->error;
        }

        return false;
    }
}
?>