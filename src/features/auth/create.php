<?php
session_start();
include "../../../core/config.php";
include "../../../util/token.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../../../util/header.php";
    ?>
    <title>Document</title>
</head>

<body>
    <div class="h-screen flex justify-center items-center">
        <form action="store.php" method="POST">
            <div class="w-96 ring ring-1 ring-gray-300 rounded-lg p-4">
                <h2 class="text-2xl font-semibold mb-3">Registration Form</h2>
                <input type="hidden" name="_token" value="<?= createToken() ?>">
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="username" class="font-medium">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 transition"
                        placeholder="Input username..." required>
                </div>
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="password" class="font-medium">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 transition"
                        placeholder="Input password..." required>
                </div>
                <div class="input-field flex flex-col gap-1 mb-4">
                    <label for="password" class="font-medium">Confirm Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" name="confirm_password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 transition"
                        placeholder="Input confirm password..." required>
                </div>
                <?php
                if (isset($_SESSION['messages']['error'])) {
                    ?>
                    <div class="bg-red-100 rounded-sm text-red-500 border-l-4 border-red-500 px-4 py-2 mb-3">
                        <?= $_SESSION['messages']['error'] ?>
                    </div>
                    <?php
                }
                ?>
                <button
                    class="bg-gray-900 rounded-md w-full py-2 text-white font-semibold hover:text-blue-500 transition">Submit</button>

                <p class="text-center mt-2">Already have an account? <a href="index.php"
                        class="text-blue-500 font-semibold">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>