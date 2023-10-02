<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/css/base.css" rel="stylesheet">
  <link href="src/css/home.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Recursive&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <?php
  session_start();

  $name = "guest";
  if (!empty($_SESSION['user_id'])) {
    $name = $_SESSION['FirstName'];
  }
  ?>
  <?php include 'includes/banner.php'; ?>

  <?php include 'includes/header.php'; ?>
  <div class="content">

    <?php
    // Check the 'page' parameter in the URL
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'index'; // Default to 'index' if 'page' is not set

    if ($currentPage === 'index') {
      include 'page/home.php';
    } elseif ($currentPage === 'cart') {
      include 'page/cart.php';
    } elseif ($currentPage === 'about') {
      include 'page/about.php';
    } elseif ($currentPage === 'products' && isset($_GET['q'])) {
      include 'page/products.php';
    } elseif ($currentPage === 'products') {
      include 'page/products.php';
    } elseif ($currentPage === 'product' && isset($_GET['product_id'])) {
      include 'page/product.php';
    } elseif ($currentPage === 'product_detail') {
      include 'page/product_detail.php';
    } else {
      include 'page/404.php'; // Include a 404 page for unknown values
    }
    ?>
    <?php include 'includes/cart.php'; ?>

  </div>

  <?php include 'includes/footer.php'; ?>
  <script>
    feather.replace();
  </script>
</body>

</html>