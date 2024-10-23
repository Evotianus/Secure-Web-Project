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
    <div class="container mx-32 my-8">
        <?php
        if (isset($_SESSION['messages']['success'])) {
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
        ?>
        <p class="text-2xl">Hello, <?= $_SESSION['name'] ?></p>
        <form action="../auth/logout.php" method="POST" class="mt-3">
            <button type="submit"
                class="bg-sky-500 py-2 px-4 rounded-md text-white font-semibold hover:bg-sky-700 transition">Logout</button>
        </form>
    </div>
</body>

</html>