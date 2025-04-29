<?php
session_start();

require_once(__DIR__ . '/../includes/utils.php');

$databaseConnection = new DatabaseConnection();

// Assuming you have a Product and Session class defined elsewhere
$ProductSize = new ProductSize($databaseConnection);
$CartItem = new CartItem($databaseConnection);
$OrderedItem = new OrderedItem($databaseConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product ID and size from the form
    $shippingAddress = $_POST['shippingAddress'];
    $userId = $_SESSION['user_id'];

    // Process payment here
    if (true) {

        $existingCartItem = $CartItem->getCartItemsByUserId($userId);

        foreach ($existingCartItem as $item) {
            // Add each cart item to order items
            $totalAmount = $item['Price'] * $item['CartQuantity'];
            print_r($totalAmount);
            $id = $OrderedItem->addOrderItem(
                $userId, 
                $item['ProductId'], 
                $item['ProductSizeId'], 
                $item['CartQuantity'], 
                $totalAmount, 
                $shippingAddress
            );

        }
        $CartItem->clearCart($userId);
        echo '<script>window.location.href = "../index.php?page=order_successful&order_id=' . $id . '";</script>';

    } else {
        // Invalid data or user not logged in
        echo "Payment failed.";
    }
} else 
{
    echo "Invalid request method.";
}

?>