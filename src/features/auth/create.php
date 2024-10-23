<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.20.0/tabler-icons.min.css">
    <title>Document</title>
</head>

<body>
    <div class="h-screen flex justify-center items-center">
        <form action="store.php" method="POST">
            <div class="w-96 ring ring-1 ring-gray-300 rounded-lg p-4">
                <h2 class="text-2xl font-semibold mb-3">Registration Form</h2>
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="username" class="font-medium">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500 transition"
                        placeholder="Input username..." required>
                </div>
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="password" class="font-medium">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500 transition"
                        placeholder="Input password..." required>
                </div>
                <div class="input-field flex flex-col gap-1 mb-4">
                    <label for="password" class="font-medium">Confirm Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" name="confirm_password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500 transition"
                        placeholder="Input confirm password..." required>
                </div>
                <?php
                if (isset($_SESSION['error_register'])) {
                    ?>
                    <div class="bg-red-100 rounded-sm text-red-500 border-l-4 border-red-500 px-4 py-2 mb-3">
                        <?= $_SESSION['error_register'] ?>
                    </div>
                    <?php
                }
                ?>
                <button
                    class="bg-sky-500 rounded-md w-full py-2 text-white font-semibold hover:bg-sky-700 transition">Submit</button>

                <p class="text-center mt-2">Already have an account? <a href="index.php"
                        class="text-sky-500 font-semibold">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>