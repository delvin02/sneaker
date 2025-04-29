<?php

require_once(__DIR__ . '/../includes/utils.php');

$databaseConnection = new DatabaseConnection();
$OrderedItem = new OrderedItem($databaseConnection);

$userId = $_SESSION['user_id'];
$isValidOrder = false; // Flag to check if order_id is valid

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    $items = $OrderedItem->getCartItemsByUserId($userId, $orderId);

    if ($items) {
        $isValidOrder = true;
    }
}

if (!$isValidOrder) {
    echo "Error: Invalid Order ID";
    exit; // Stop script execution if the order is not valid
}
?>



<section>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:py-12 sm:px-6 lg:py-16 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
            <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
                <img alt="Party" src="https://images.unsplash.com/photo-1603787081151-cbebeef20092?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute inset-0 h-full w-full object-cover" />
            </div>

            <div class="lg:py-24">
                <h2 class="text-3xl font-bold sm:text-4xl">Payment successful.</h2>
                <p>Order Id: <span class="text-blue-800">
                        <?php echo htmlspecialchars($orderId); ?>
                    </span>
                </p>
                <div>
                    <p class="mt-4 text-gray-600">
                        Your ship is on the way.
                    </p>
                </div>
                <?php foreach ($items as $item) : ?>
                    <p class="mt-2 border-b border-black">
                        N:<?php echo $item['ProductName']; ?>
                    </p>
                    <p class="mt-2 border-b text-red-600 border-black">
                        S:<?php echo $item['Size']; ?>
                    </p>
                    <p class="mt-2 border-b border-black">
                        P:<?php echo $item['Price']; ?>
                    </p>
                <?php endforeach; ?>
                <a href="index.php?page=products" class="mt-8 inline-block rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400">
                    Back to marketplace
                </a>
            </div>
        </div>
    </div>
</section>