<?php

    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email))
        {
            $errorMessage = "Username is required";
        }

        if (empty($password))
        {
            $errorMessage = "Password is missing";
        }
        if (empty($errorMessage))
        {
            $servername = "127.0.0.1";
            $username = "lucid";        
            $password = "password";            
            $dbname = "ecommerce"; 

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn-> connect_error)
            {
                die("Connection failed: " . $conn->$connect_error);
            }

            $query = "SELECT UserId, Email, Password, FirstName, LastName FROM User WHERE Email = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            if ($result-> num_rows === 1) {
                $row = $result->fetch_assoc();
                $validated = password_verify($password, $row["Password"]);
                print_r($validated);
                if($validated){
                    session_start();
                    $_SESSION['user_id'] = $row["UserId"];
                    $_SESSION['FirstName'] = $row["FirstName"];

                    header("Location: index.php");
                    exit();
                }
                else
                {
                    $errorMessage = "Invalid password.";
                }
            } else
            {
                $errorMessage = "Username not found";
            }

            $stmt->close();
            $conn->close();
        }

    }
?>


<h2
    class="text-center text-[20px] leading-[1.2] md:text-[32px] md:leading-[1.25]"
>
    Login
</h2>
<div class="mt-5 w-full max-w-[440px]">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-8">
        <div class="col-span-6">
            <label
                for="Email"
                class="block text-sm font-medium text-gray-500"
            >
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@mail.com"
                required
            />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label
                for="Password"
                class="block text-sm font-medium text-gray-500"
            >
                Password
            </label>

            <input
                type="password"
                id="Password"
                name="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>

        <div class="sm:flex sm:items-center sm:gap-4">
            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Don't have an account yet?
                <a href="auth.php?page=register" class="text-gray-300 underline"
                    >Sign up</a
                >.
            </p>
        </div>
        <button
            class="block w-full shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 my-4 focus:outline-none focus:ring active:text-blue-500"
            type="submit"
        >
            Login
        </button>
        <!-- add inline-flex when printing error -->
        <div class="font-regular <?php echo (!empty($errorMessage) ? 'inline-flex' : 'hidden'); ?> mb-4 w-full text-red-600 rounded-lg border border-red-500 p-4 text-base leading-5 opacity-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true"
                class="h-6 w-6"
                >
                <path
                    fill-rule="evenodd"
                    d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                    clip-rule="evenodd"
                ></path>
            </svg>    
            <span class="my-auto pl-3"><?php echo $errorMessage; ?></span>
        </div>
    </form>
</div>