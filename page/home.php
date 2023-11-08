<?php
require_once(__DIR__ . '/../includes/utils.php');

$databaseConnection = new DatabaseConnection();

$product = new Product($databaseConnection);

$limitedProducts = $product->getProductsLimited(5);
$LimitedHypedProducts = $product->getRandomProductsLimited();


?>
<section>
  <div class="border-x border-black max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
    <header class="text-center">
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
        Welcome,
        <?php echo $name ?>
      </h2>

      <p class="max-w-md mx-auto mt-4 text-gray-500">
        What are you looking for today?
      </p>
    </header>
    <div class="my-4 w-full">
      <div class="relative block group">
        <img src="src/images/sneaker-wallpaper.png" alt="" class="object-cover transition duration-500 aspect-auto group-hover:opacity-90 lg:h-auto h-[480px]">
        <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
          <div class="my-10">
            <h3 class="text-5xl font-bold text-white">AUTHENTICATED. GURANTEED.</h3>
            <h6 class="text-center text-white mb-1">Find your dream <span class="underline ">sneaker</span> now. </h6>
          </div>
          <div class="flex flex-row">
            <input id="searchInput" class="basis-3/4 w-3/5 inline-block bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white" type="text" placeholder="Search Now">
            <div class="basis-1/4 flex  mx-1 border-1 grow justify-center self-center">
              <button id="searchButton" class=" border-2 p-3 border-black">
                <svg class="text-red-500 w-5 h-auto" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 183.792 183.792" xml:space="preserve">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path d="M54.734,9.053C39.12,18.067,27.95,32.624,23.284,50.039c-4.667,17.415-2.271,35.606,6.743,51.22 c12.023,20.823,34.441,33.759,58.508,33.759c7.599,0,15.139-1.308,22.287-3.818l30.364,52.592l21.65-12.5l-30.359-52.583 c10.255-8.774,17.638-20.411,21.207-33.73c4.666-17.415,2.27-35.605-6.744-51.22C134.918,12.936,112.499,0,88.433,0 C76.645,0,64.992,3.13,54.734,9.053z M125.29,46.259c5.676,9.831,7.184,21.285,4.246,32.25c-2.938,10.965-9.971,20.13-19.802,25.806 c-6.462,3.731-13.793,5.703-21.199,5.703c-15.163,0-29.286-8.146-36.857-21.259c-5.676-9.831-7.184-21.284-4.245-32.25 c2.938-10.965,9.971-20.13,19.802-25.807C73.696,26.972,81.027,25,88.433,25C103.597,25,117.719,33.146,125.29,46.259z"></path>
                  </g>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="my-4 w-full">
        <div class="flex mt-8 justify-between sticky top-1">
          <h1 class="text-3xl my-auto "> latest <span class="text-red-400">releases</span>./</h1>
          <a href="index.php?page=products" class=" px-2 my-auto underline">See more > </a>
        </div>

        <ul class="grid lg:grid-cols-5 lg:gap-10 mt-2 grid-cols-2 gap-2">
          <?php foreach ($limitedProducts as $product) : ?>
            <li class="flex">
              <a href="index.php?page=product&product_id=<?php echo $product['ProductId']; ?>" class="flex flex-col justify-between text-center">
                <img src="<?php echo $product['ImageFile']; ?>" alt="" class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90 lg:h-[211px] h-auto" />
                <div class="mt-3">
                  <div class="flex flex-col justify-between text-left mt-2 h-full"> <!-- Fixed height for product name -->
                    <p class="text-sm text-gray-500">
                      <?php echo $product['CategoryName']; ?>
                    </p>
                    <p class="text-sm h-[40px]">
                      <?php echo $product['ProductName']; ?>
                    </p>
                    <p class="text-lg font-bold">A$<?php echo $product['Price']; ?>
                    </p>
                  </div>
                </div>
              </a>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
      <div class="my-6 w-full">
        <div class="flex mt-8 justify-between">
          <h1 class="text-3xl my-auto"> hype <span class="text-red-400">NOW</span>./</h1>
          <a href="index.php?page=products" class=" px-2 my-auto underline">See more > </a>
        </div>

        <ul class="grid lg:grid-cols-5 lg:gap-10 mt-2 grid-cols-2 gap-2">
          <?php foreach ($LimitedHypedProducts as $product) : ?>
            <li class="flex">
              <a href="index.php?page=product&product_id=<?php echo $product['ProductId']; ?>" class="flex flex-col justify-between text-center">
                <img src="<?php echo $product['ImageFile']; ?>" alt="" class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90 lg:h-[211px] h-auto" />
                <div class="mt-3">
                  <div class="flex flex-col justify-between text-left mt-2 h-full"> <!-- Fixed height for product name -->
                    <p class="text-sm text-gray-500">
                      <?php echo $product['CategoryName']; ?>
                    </p>
                    <p class="text-sm h-[40px]">
                      <?php echo $product['ProductName']; ?>
                    </p>
                    <p class="text-lg font-bold">A$<?php echo $product['Price']; ?>
                    </p>
                  </div>
                </div>
              </a>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
    </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");

    searchButton.addEventListener("click", function() {
      const query = searchInput.value.trim();
      if (query.length > 0) {
        // Construct the URL with the search query
        const newUrl = window.location.pathname + "?page=products&q=" + encodeURIComponent(query);

        // Redirect to the new URL
        window.location.href = newUrl;
      }
    });
  });
</script>