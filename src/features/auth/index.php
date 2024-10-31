<?php
session_start();
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
        <form action="authenticate.php" method="POST">
            <div class="w-96 ring ring-1 ring-gray-300 rounded-lg p-4">
                <h2 class="text-2xl font-semibold mb-3">Login Form</h2>
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="username" class="font-medium">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 transition"
                        placeholder="Input username..." value="<?php if (isset($_POST['username'])) {
                            echo $_POST['username'];
                        } ?>" required>
                </div>
                <div class="input-field flex flex-col gap-1 mb-4">
                    <label for="password" class="font-medium">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 transition"
                        placeholder="Input password..." required>
                </div>
                <?php
                if (isset($_SESSION['messages'])) {
                    if (isset($_SESSION['messages']['error'])) {
                        ?>
                        <div class="bg-red-100 rounded-sm text-red-500 border-l-4 border-red-500 px-4 py-2 mb-3 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle mr-3 mt-0.5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9v4" />
                                <path
                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                <path d="M12 16h.01" />
                            </svg><?= $_SESSION['messages']['error'] ?>
                        </div>
                        <?php
                    } else if (isset($_SESSION['messages']['success'])) {
                        ?>
                            <div class="bg-green-100 rounded-sm text-green-500 border-l-4 border-green-500 px-4 py-2 mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check mr-3 mt-0.5">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                            <?= $_SESSION['messages']['success'] ?>
                            </div>
                        <?php
                    }
                }
                ?>
                <button
                    class="bg-gray-900 rounded-md w-full py-2 text-white font-semibold hover:text-blue-500 transition">Submit</button>
                <p class="text-center mt-2">Doesn't have an account yet? <a href="create.php"
                        class="text-blue-500 font-semibold">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>