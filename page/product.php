<?php
if (isset($_GET['product_id'])) {
    require_once(__DIR__ . '/../includes/utils.php');

    $databaseConnection = new DatabaseConnection();

    $product = new Product($databaseConnection);
    $productSize = new ProductSize($databaseConnection);

    $product_id = intval($_GET['product_id']);

    $productDetails = $product->getProductById($product_id);

    if (!$productDetails) {
        http_response_code(404);
        include(__DIR__ . '/../page/404.php');
        exit;
    }

    $productSizes = $productSize->getProductSizesByProductId($productDetails['ProductId']);
}
?>
<section>
    <div class="border-x border-black max-w-screen-md px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
        <header class="text-center">
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                <?php echo $productDetails['CategoryName']; ?>
            </h2>

            <p class="max-w-md mx-auto text-lg text-gray-500">
                <?php echo $productDetails['ProductName']; ?>
            </p>
            <p class="py-6 ml-4 mt-4 dark:text-gray-400 text-sm text-justify"> <?php echo $productDetails['Description']; ?>
            </p>

        </header>
        <div class=" w-full">
            <div class="relative block group">
                <img src="<?php echo $productDetails['ImageFile'] ?>" alt="" class="object-cover transition duration-500 w-60 h-auto mx-auto group-hover:opacity-90">
            </div>
        </div>
        <div class="my-4 w-full d-flex flex-row items-center justify-center">

            <div class="my-8 sticky top-1">
                <h1 class="text-3xl text-center "> <span class="text-red-400">Pick a size.</span></h1>
            </div>
            <select id="sizes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                <option selected>Choose a size (UK)</option>
                <?php
                if (!empty($productSizes)) {
                    foreach ($productSizes as $size) {
                        echo '<option value="' . $size . '">' . $size . '</option>';
                    }
                }
                ?>
            </select>
            <div class="mx-auto flex justify-center">
                <button type="button" data-product-id="<?php echo $product_id; ?>" class=" add-to-cart mt-3 border text-black border-black hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2">
                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                    Add to Cart
                </button>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            // Get the product ID and selected size from the data attributes
            const productId = $(this).data('product-id');
            const size = $('#sizes').val(); // Assuming you add data-size attribute to your button

            // Make an AJAX request to add the product to the cart
            $.ajax({
                type: 'POST',
                url: 'index.php?page=cart', // Specify the correct URL for your cart handling script
                data: {
                    productId: productId,
                    size: size
                },
                success: function(response) {
                    // Handle the response, e.g., show a success message
                    //window.location.href = "./index.php?page=cart"; // Redirect to the cart page

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle errors, e.g., show an error message
                    console.error('Error adding product to cart:', errorThrown);
                },
            });
        });
    });
</script>