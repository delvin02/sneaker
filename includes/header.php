<header class="bg-white sticky top-0 z-20 border-b-black border">
  <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <div class="relative">
        <button type="button" class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900"
          aria-expanded="false" onclick="toggleDropdown()">
          Menu
          <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
              clip-rule="evenodd" />
          </svg>
        </button>

        <div id="menuDropdown"
          class="hidden -left-8 top-full z-10 mt-3 w-screen max-w-md absolute overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
          <div class="p-4">
            <div class="group relative d flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
              <div
                class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <i class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" data-feather="home"></i>
              </div>
              <div class="flex-auto">
                <a href="index.php" class="block font-semibold text-gray-900">
                  Home
                  <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">
                  trending sneakers
                </p>
              </div>
            </div>
            <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
              <div
                class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">


                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path
                      d="M2.7,9.45a4.235,4.235,0,0,0,.3.3V22a1,1,0,0,0,1,1H20a1,1,0,0,0,1-1V9.752a4.235,4.235,0,0,0,.3-.3,4,4,0,0,0,.731-3.456L20.97,1.758A1,1,0,0,0,20,1H4a1,1,0,0,0-.97.758L1.972,5.994A4,4,0,0,0,2.7,9.45ZM13,21H11V16h2Zm6,0H15V15a1,1,0,0,0-1-1H10a1,1,0,0,0-1,1v6H5V10.9A3.989,3.989,0,0,0,8.914,9.61c.026.03.053.059.08.089A4.086,4.086,0,0,0,12.041,11a4.039,4.039,0,0,0,2.965-1.3c.027-.03.054-.059.08-.089A3.989,3.989,0,0,0,19,10.9ZM3.911,6.479,4.781,3H19.219l.87,3.479A2.029,2.029,0,0,1,18.12,9,2.041,2.041,0,0,1,16.1,7.14l-.042-.5a1,1,0,0,0-1.993.166v0a2.006,2.006,0,0,1-.529,1.539A2.059,2.059,0,0,1,11.959,9,2.029,2.029,0,0,1,9.937,6.806v0a1,1,0,0,0-.914-1.079.989.989,0,0,0-1.079.913l-.042.5A2.041,2.041,0,0,1,5.88,9,2.029,2.029,0,0,1,3.911,6.479Z">
                    </path>
                  </g>
                </svg>
              </div>
              <div class="flex-auto">
                <a href="index.php?page=products" class="block font-semibold text-gray-900">
                  Marketplace
                  <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">
                  buy sneakers
                </p>
              </div>
            </div>
            <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
              <div
                class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
              </div>
              <div class="flex-auto">
                <a href="index.php?page=about" class="block font-semibold text-gray-900">
                  About Us
                  <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">
                  Build strategic funnels that will convert
                </p>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
            <a href="#"
              class="flex items-center justify-center gap-x-2.5 p-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-100">
              <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm6.39-2.908a.75.75 0 01.766.027l3.5 2.25a.75.75 0 010 1.262l-3.5 2.25A.75.75 0 018 12.25v-4.5a.75.75 0 01.39-.658z"
                  clip-rule="evenodd" />
              </svg>
              Admin
            </a>
            <a href="#"
              class="flex items-center justify-center gap-x-2.5 p-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-100">
              <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                  clip-rule="evenodd" />
              </svg>
              Contact sales
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
      <a href="index.php" class="-m-1.5 p-1.5 text-2xl font-bold leading-1 relative text-center">
        <span class="relative inline-block">
          <span class="relative px-2 z-10">EON</span>
          <span class="absolute bottom-0 left-0 w-full bg-slate-300 h-1/2 transform origin-bottom"></span>
        </span>
        <p class="text-xs">fortified by sneaker authenticity</p>
      </a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      <?php
      if ($name != "guest") {
        echo '<a href="logout.php" class="text-sm font-semibold leading-6 text-red-600"
              >Log Out <span aria-hidden="true">&rarr;</span></a
            >';

      } else {
        echo '<a href="auth.php" class="text-sm font-semibold leading-6 text-gray-900"
              >Log in <span aria-hidden="true">&rarr;</span></a
            >';
      }
      ?>
    </div>
  </nav>
  <!-- Mobile menu, show/hide based on menu open state. -->
  <div class="lg:hidden" role="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 z-10"></div>
    <div
      class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="#" class="-m-1.5 p-1.5 text-2xl font-bold leading-1 relative text-center">
          <span class="relative inline-block">
            <span class="relative px-2 z-10">EON</span>
            <span class="absolute bottom-0 left-0 w-full bg-slate-300 h-1/2 transform origin-bottom"></span>
          </span>
          <p class="text-xs">fortified by sneaker authenticity</p>
        </a>
        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Close menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            <div class="-mx-3">
              <button type="button"
                class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                aria-controls="disclosure-1" aria-expanded="false">
                Product
                <!--
                  Expand/collapse icon, toggle classes based on menu open state.

                  Open: "rotate-180", Closed: ""
                -->
                <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <!-- 'Product' sub-menu, show/hide based on menu state. -->
              <div class="mt-2 space-y-2" id="disclosure-1">
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Analytics</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Engagement</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Security</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Integrations</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Automations</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Watch
                  demo</a>
                <a href="#"
                  class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Contact
                  sales</a>
              </div>
            </div>
            <a href="#"
              class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
            <a href="#"
              class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
            <a href="#"
              class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
          </div>
          <div class="py-6">
            <a href="auth.php"
              class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
              in</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  function toggleDropdown() {
    var dropdown = document.getElementById("menuDropdown");
    dropdown.classList.toggle("hidden");
  }
</script>