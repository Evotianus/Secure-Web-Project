<?php
include "process.php";

$userId = $_SESSION['id'];

$personalNotes = getPersonalNotes($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../../util/header.php";
    ?>
    <title>Dashboard</title>
</head>

<body>


    <?php
    include "../../util/navbar.php";
    ?>

    <div class="mx-36 my-6">
        <?php
        if (isset($_SESSION['messages']['success'])) {
            ?>
            <div class="bg-green-100 rounded-sm text-green-500 border-l-4 border-green-500 px-4 py-2 mb-3 flex w-full">
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
        $_SESSION['messages']['success'] = null;
        ?>
        <div class="flex justify-between">
            <p class="text-2xl font-semibold">Your Notes</p>
            <a href="../notes/create.php"
                class="bg-gray-900 text-white hover:text-blue-500 px-4 py-2 rounded-md font-semibold transition">+
                Add
                notes</a>
        </div>
        <div class="grid grid-cols-3 gap-6 mt-4">
            <?php
            foreach ($personalNotes as $note) {
                ?>
                <div
                    class="bg-<?= $note['color'] ?>-200 p-4 border-l-4 border-<?= $note['color'] ?>-700 hover:scale-105 transition cursor-pointer">
                    <h2 class="font-medium mb-4 text-<?= $note['color'] ?>-900"><?= $note['title'] ?></h2>
                    <p class="text-<?= $note['color'] ?>-900"><?= $note['description'] ?></p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>