<?php
// Start a session at the very beginning of your script
if (!empty($_SESSION['user_id'])) {
    header('Location: ./index.php');
    exit();
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check for missing input fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $errorMessage = "All fields are required.";
    } elseif ($confirm_password !== $password) {
        $errorMessage = "Password and Confirm Password do not match.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $servername = "127.0.0.1";
        $username = "lucid";
        $db_password = "password";
        $dbname = "ecommerce";

        $conn = new mysqli($servername, $username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the email already exists in the database
        $check_query = "SELECT * FROM USER WHERE Email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $errorMessage = "Email already exists. Please choose a different email.";
        } else {
            $insert_query = "INSERT INTO USER (Email, Password, FirstName, LastName) VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssss", $email, $hashed_password, $first_name, $last_name);

            if ($stmt->execute() && $stmt->affected_rows === 1) {
                // Registration successful
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['email'] = $email;
                $_SESSION['FirstName'] = $first_name;
                $_SESSION['LastName'] = $last_name;

                // Redirect to index.php after successful registration
                header("Location: index.php");
                exit();
            } else {
                $errorMessage = "User registration failed. Please try again.";
            }

            $stmt->close();
        }

        $conn->close();
    }
}
?>
<h2
    class="text-center text-[20px] leading-[1.2] md:text-[32px] md:leading-[1.25]"
>
    Register
</h2>
<div class="mt-5 w-full max-w-[440px]">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?' . http_build_query(['page' => 'register']); ?>" method="POST" class="mt-8">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label
                    for="FirstName"
                    class="block text-sm font-medium text-gray-500"
                >
                    First Name
                </label>

                <input
                    type="text"
                    id="FirstName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Florence"
                    required
                    name="FirstName"
                />
            </div>
            <div>
                <label
                    for="LastName"
                    class="block text-sm font-medium text-gray-500"
                >
                    Last Name
                </label>

                <input
                    type="text"
                    id="LastName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Lee"
                    required
                    name="LastName"
                />
            </div>
        </div>
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
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@mail.com"
                name="email"
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
        <div class="col-span-6 sm:col-span-3">
            <label
                for="Password"
                class="block text-sm font-medium text-gray-500"
            >
                Confirm password
            </label>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>

        <div class="sm:flex sm:items-center sm:gap-4">
            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Have an account?
                <a href="auth.php" class="text-gray-300 underline"
                    >Sign in</a
                >.
            </p>
        </div>
        <button
            class="block w-full shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 my-4 focus:outline-none focus:ring active:text-blue-500"
            type="submit"
        >
            Register now.
        </button>
    </form>
</div>