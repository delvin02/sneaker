<!DOCTYPE html>

<?php
ob_start();
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="src/css/base.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Recursive&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"
        />
    </head>
    <body>
        <div
            class="flex w-screen flex-col supports-[min-height:100dvh]:min-h-[100dvh] md:grid md:grid-cols-2 lg:grid-cols-[60%_40%["
        >
            <div
                id="container"
                class="relative flex flex-1 flex-col justify-center px-5 pt-8 bg-white text-gray-500 md:px-6 md:py[22px] lg:px-8"
            >
                <nav
                    class="absolute left-0 top-0 flex w-full px-6 md:top-[22px] md:px-6 lg:px-8"
                >
                    <div
                        class="flex cursor-default items-center text-[20px] font-bold leading-none lg:text-[22px]"
                    >
                        <div>
                            <a
                                href="#"
                                class="-m-1.5 p-1.5 text-6xl font-bold leading-1 relative"
                            >
                                <span class="relative inline-block">
                                    <span class="relative px-2 z-10 text-black"
                                        >EON</span
                                    >
                                    <span
                                        class="absolute bottom-0 left-0 w-full bg-slate-300 h-1/2 transform origin-bottom"
                                    ></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </nav>
                <div class="flex-col transition-opacity duration-1000">
                    <div
                        class="text-[64px] leading-[1.2] md:flex md:text-[32px]"
                    >
                        <div
                            class="absolute left-0 z-10 top-1/2 flex w-full z-3 px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-black">
                                    buy/sell authentic sneakers only.
                                </h1>
                            </div>
                        </div>
                        <div
                            class="absolute left-1 top-[calc(50%+1px)] z-0 flex w-full px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-gray-400">
                                    buy/sell authentic sneakers only.
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex-col opacity-0 transition-opacity duration-1000"
                >
                    <div
                        class="text-[64px] leading-[1.2] md:flex md:text-[32px]"
                    >
                        <div
                            class="absolute left-0 z-10 top-1/2 flex w-full z-3 px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-black">
                                    expressing your unique style and love.
                                </h1>
                            </div>
                        </div>
                        <div
                            class="absolute left-1 top-[calc(50%+1px)] z-0 flex w-full px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-gray-400">
                                    expressing your unique style and love.
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex-col opacity-0 transition-opacity duration-1000"
                >
                    <div
                        class="text-[64px] leading-[1.2] md:flex md:text-[32px]"
                    >
                        <div
                            class="absolute left-0 z-10 top-1/2 flex w-full z-3 px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-black">
                                    collect moments, collect kicks.
                                </h1>
                            </div>
                        </div>
                        <div
                            class="absolute left-1 top-[calc(50%+1px)] z-0 flex w-full px-5 transition-[transform,opacity] duration-500 md:pl-6 md:pr-8 lg:pl-8 lg:pr-10"
                        >
                            <div class="relative font-bold">
                                <h1 class="text-gray-400">
                                    collect moments, collect kicks.
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-t-[30px] bg-white px-5 py-8 text-black dark:bg-black dark:text-white md:rounded-none md:px-6"
            >
                <?php
                session_start();
                if (isset($_SESSION) && !empty($_SESSION['user_id'])){
                    header("Location: index.php");
                }
                // Check the query parameter to determine the content
                $page = isset($_GET['page']) ? $_GET['page'] : '';

                // Include the appropriate PHP content based on the query parameter
                if ($page === 'register') {
                    include 'includes/register.php';
                }
                else {
                    include 'includes/login.php';
                }
                ?>
            </div>
        </div>

        <script>
            const container = document.getElementById("container");
            const containers = container.querySelectorAll(".flex-col");

            let currentIndex = 0;

            function toggleContainers() {
                containers[currentIndex].classList.remove("opacity-100");
                containers[currentIndex].classList.add("opacity-0");

                currentIndex = (currentIndex + 1) % containers.length;

                containers[currentIndex].classList.remove("opacity-0");
                containers[currentIndex].classList.add("opacity-100");
            }

            setInterval(toggleContainers, 3000);
        </script>
    </body>
</html>
