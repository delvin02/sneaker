<?php
require_once(__DIR__ . '/../includes/utils.php');


$databaseConnection = new DatabaseConnection();

$product = new Product($databaseConnection);

$limitedProducts = $product->getProductsLimited(10);

?>
<section>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 border-black border-x">
    <header>
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
        Sneakers
      </h2>

      <p class="mt-4 max-w-md text-gray-500">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque
        praesentium cumque iure dicta incidunt est ipsam, officia dolor fugit
        natus?
      </p>
    </header>

    <div class="w-1/4 mt-8 xs:w-full">
      <label for="Search" class="sr-only"> Search </label>

      <input type="text" id="Search" placeholder="Search for..."
        class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" />

      <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
        <button type="button" class="text-gray-600 hover:text-gray-700">
          <span class="sr-only">Search</span>

          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
          </svg>
        </button>
      </span>
    </div>
    <div class="mt-2 sm:flex sm:items-center sm:justify-between">

      <div class="block sm:hidden">

        <button
          class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
          <span class="text-sm font-medium"> Filters & Sorting </span>

          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4 rtl:rotate-180">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </button>
      </div>

      <div class="hidden sm:flex sm:gap-4">
        <div class="relative">
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary
              class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
              <span class="text-sm font-medium"> Availability </span>

              <span class="transition group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </summary>

            <div class="z-50 group-open:absolute group-open:top-auto group-open:mt-2 ltr:group-open:start-0">
              <div class="w-96 rounded border border-gray-200 bg-white">
                <header class="flex items-center justify-between p-4">
                  <span class="text-sm text-gray-700"> 0 Selected </span>

                  <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                    Reset
                  </button>
                </header>

                <ul class="space-y-1 border-t border-gray-200 p-4">
                  <li>
                    <label for="FilterInStock" class="inline-flex items-center gap-2">
                      <input type="checkbox" id="FilterInStock" class="h-5 w-5 rounded border-gray-300" />

                      <span class="text-sm font-medium text-gray-700">
                        In Stock (5+)
                      </span>
                    </label>
                  </li>

                  <li>
                    <label for="FilterPreOrder" class="inline-flex items-center gap-2">
                      <input type="checkbox" id="FilterPreOrder" class="h-5 w-5 rounded border-gray-300" />

                      <span class="text-sm font-medium text-gray-700">
                        Pre Order (3+)
                      </span>
                    </label>
                  </li>

                  <li>
                    <label for="FilterOutOfStock" class="inline-flex items-center gap-2">
                      <input type="checkbox" id="FilterOutOfStock" class="h-5 w-5 rounded border-gray-300" />

                      <span class="text-sm font-medium text-gray-700">
                        Out of Stock (10+)
                      </span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
          </details>
        </div>

        <div class="relative">
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary
              class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
              <span class="text-sm font-medium"> Price </span>

              <span class="transition group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </summary>

            <div class="z-50 group-open:absolute group-open:top-auto group-open:mt-2 ltr:group-open:start-0">
              <div class="w-96 rounded border border-gray-200 bg-white">
                <header class="flex items-center justify-between p-4">
                  <span class="text-sm text-gray-700">
                    The highest price is $600
                  </span>

                  <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                    Reset
                  </button>
                </header>

                <div class="border-t border-gray-200 p-4">
                  <div class="flex justify-between gap-4">
                    <label for="FilterPriceFrom" class="flex items-center gap-2">
                      <span class="text-sm text-gray-600">$</span>

                      <input type="number" id="FilterPriceFrom" placeholder="From"
                        class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    </label>

                    <label for="FilterPriceTo" class="flex items-center gap-2">
                      <span class="text-sm text-gray-600">$</span>

                      <input type="number" id="FilterPriceTo" placeholder="To"
                        class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </details>
        </div>
      </div>

      <div class="hidden sm:block">
        <label for="SortBy" class="sr-only">SortBy</label>

        <select id="SortBy" class="h-10 rounded border-gray-300 text-sm">
          <option>Sort By</option>
          <option value="Title, DESC">Title, DESC</option>
          <option value="Title, ASC">Title, ASC</option>
          <option value="Price, DESC">Price, DESC</option>
          <option value="Price, ASC">Price, ASC</option>
        </select>
      </div>
    </div>

    <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
      <?php foreach ($limitedProducts as $product): ?>
        <li class="flex">
          <a href="" class="flex flex-col justify-between text-center">
            <img src="<?php echo $product['ImageFile']; ?>" alt=""
              class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90 lg:h-[220px] h-auto" />
            <div class="mt-3">
              <div class="flex flex-col justify-between text-left mt-2 h-full"> <!-- Fixed height for product name -->
                <p class="text-sm text-gray-500">
                  <?php echo $product['CategoryName']; ?>
                </p>
                <p class="text-sm h-[40px]">
                  <?php echo $product['ProductName']; ?>
                </p>
                <p class="text-lg font-bold">A$
                  <?php echo $product['Price']; ?>
                </p>
              </div>
            </div>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
</section>