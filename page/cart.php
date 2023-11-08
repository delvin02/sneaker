<?php
require_once(__DIR__ . '/../includes/MiddlewareDispatcher.php');
require_once(__DIR__ . '/../middleware/AuthenticationMiddleware.php');

$dispatcher = new MiddlewareDispatcher();
$dispatcher->addMiddleware(new AuthenticationMiddleware());
$dispatcher->handle();

require_once(__DIR__ . '/../includes/utils.php');

$databaseConnection = new DatabaseConnection();

// Assuming you have a Product and Session class defined elsewhere
$ProductSize = new ProductSize($databaseConnection);
$CartItem = new CartItem($databaseConnection);

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['cartItemId'])) {
  $cartItemId = $_GET['cartItemId'];
  $success = $CartItem->delete($cartItemId); // Implement the deleteCartItem method in your CartItem class

  if ($success) {
    // Redirect back to the cart page or perform any other action as needed
    echo '<script>window.location.href = "./index.php?page=cart";</script>';
    exit;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve product ID and size from the form
  $productId = $_POST['productId'];
  $size = $_POST['size'];

  echo "Receiveda :" . $size . " " . $_SESSION['user_id'];

  $user = $_SESSION['user_id'];

  echo "ProductId " . $productId;
  // Example: Fetch ProductSizeId based on the Size (You should have a method to do this)
  $ProductSizeId = $ProductSize->getProductSizeIdIdBySizeAndProductId($size, $productId);

  // Check if the product and size are valid and if the user is logged in.
  if (!empty($ProductSizeId)) {

    // Check if the product already exists in the cart for the user
    $existingCartItem = $CartItem->getCartItemByUserProduct($user, $productId, $ProductSizeId, $size);

    if (!empty($existingCartItem)) {

      // Product already exists in the cart, so update the quantity
      $newQuantity = $existingCartItem['Quantity'] + 1;

      if ($CartItem->updateQuantity($existingCartItem['CartItemId'], $newQuantity)) {

        //header('Location: /index.php?page=cart.php'); // Redirect to the cart page
        exit;
      } else {
        // Failed to update quantity
        echo "Failed to update the quantity in the cart.";
      }
    } else {
      echo "create";
      // Product doesn't exist in the cart, create a new cart item
      $quantity = 1; // You can set the quantity as needed
      if ($CartItem->create($user, $productId, $ProductSizeId, $quantity)) {
        // Cart item created successfully
        //header('Location: cart.php'); // Redirect to the cart page
        exit;
      } else {
        // Failed to create a cart item
        echo "Failed to create a cart item.";
      }
    }
  } else {
    // Invalid data or user not logged in
    echo "Invalid data or user not logged in.";
  }
}

$userId = $_SESSION['user_id'];
$cartItems = $CartItem->getCartItemsByUserId($userId);
$totalCost = 0; // Initialize the total cost

foreach ($cartItems as $item) {
  $totalCost += $item['Price'] * $item['Quantity']; // Calculate the subtotal for each item and add it to the total cost
}

?>


<div class="container mx-auto">
  <div class="flex">
    <div class="w-3/4 border-x border-black bg-white px-10 py-10">
      <div class="flex justify-between border-b pb-8">
        <h1 class="font-semibold text-2xl">Shopping Cart</h1>
        <h2 class="font-semibold text-2xl"><?php echo count($cartItems) ?> Item(s)</h2>
      </div>
      <div class="flex mt-10 mb-5">
        <h3 class="font-semibold text-gray-600 text-xs uppercase w-3/5">Product Details</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Quantity</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Price</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Total</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"></h3>

      </div>
      <?php foreach ($cartItems as $item) : ?>
        <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
          <div class="flex w-3/5">
            <div class="w-3/5">
              <img class="h-auto min-w-full p-5" src="<?php echo $item['ImageFile']; ?>" alt="">
            </div>
            <div class="flex flex-col justify-center  ml-4 flex-grow">
              <span class="font-bold text-sm"><?php echo $item['ProductName']; ?></span>
              <span class="text-red-500 text-xs">Size: <?php echo $item['Size']; ?></span>
            </div>
          </div>
          <div class="flex justify-center w-1/5">
            <input class="mx-2  border text-center w-12" type="text" readonly disabled value="<?php echo $item['Quantity']; ?>">
          </div>
          <span class="text-center w-1/5 font-semibold text-sm">$<?php echo $item['Price']; ?></span>
          <span class="text-center w-1/5 font-semibold text-sm">$<?php echo $item['Price'] * $item['Quantity']; ?></span>
          <span class="text-center w-1/5 font-semibold text-sm">
            <a href="index.php?page=cart&action=delete&cartItemId=<?php echo $item['CartItemId']; ?>" class="font-semibold hover:text-red-500 text-gray-500 text-xs"><i data-feather="trash-2"></i></a>
          </span>
        </div>
      <?php endforeach; ?>

      <a href="index.php" class="flex font-semibold text-indigo-600 text-sm mt-10">

        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
          <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
        </svg>
        Continue Shopping
      </a>
    </div>

    <div id="summary" class=" border-r border-black w-1/4 px-8 py-10">
      <h1 class="font-semibold text-2xl border-b  pb-8">Order Summary</h1>
      <div class="flex justify-between mt-10 mb-5">
        <span class="font-semibold text-sm uppercase">Items <?php echo count($cartItems) ?></span>
        <span class="font-semibold text-sm"><?php echo $totalCost ?>$</span>
      </div>
      <div>
        <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
        <select class="block p-2 text-gray-600 w-full text-sm">
          <option>Standard shipping - $10.00</option>
        </select>
      </div>
      <div class="py-10">
        <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
        <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
      </div>
      <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
      <div class="border-t mt-8">
        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
          <span>Total cost</span>
          <span>$<?php echo $totalCost + 10 ?></span>
        </div>
        <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
      </div>
    </div>

  </div>
</div>