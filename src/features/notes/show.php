<?php
include "./process.php";

$noteId = $_GET['id'];

$note = showNote($noteId);
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
    <?php
    include "../../../util/navbar.php";
    ?>

    <div class="mx-36 my-6">
        <a href="./"
            class="ring-1 ring-gray-900 text-gray-900 hover:text-white hover:bg-gray-900 px-4 py-2 rounded-md font-semibold transition">
            < Back</a>
                <p class="text-2xl font-semibold mt-6"><?= $note['title'] ?></p>
                <p class="mt-4 mb-5"><?= $note['description'] ?></p>
                <div class="flex gap-1">
                    <a href="./edit.php?id=<?= $noteId ?>"
                        class="ring-1 ring-orange-500 text-orange-500 hover:text-white hover:bg-orange-500 px-4 py-2 rounded-md font-semibold transition mr-2">
                        Edit</a>
                    <form action="process.php" method="POST">
                        <input type="hidden" name="note_id" value="<?= $noteId ?>">
                        <input type="hidden" name="_token" value="<?= createToken() ?>">
                        <button type="submit" name="delete-note"
                            class="ring-1 ring-red-500 text-red-500 hover:text-white hover:bg-red-500 px-4 py-2 rounded-md font-semibold transition">
                            Delete
                        </button>
                    </form>
                </div>
    </div>
</body>

</html>