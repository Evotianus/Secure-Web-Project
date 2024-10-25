<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../../util/header.php";
    ?>
    <title>Document</title>
</head>

<body>
    <?php
    include "../../util/navbar.php";
    ?>

    <div class="mx-36 my-4">
        <p class="text-2xl font-semibold">Add new note</p>
        <form action="" class="mt-4">
            <div class="flex flex-col gap-1 mb-3">
                <label for="title" class="font-semibold">Title</label>
                <input type="text" id="title" name="title"
                    class="ring-2 ring-gray-300 w-full rounded px-4 py-1 font-semibold"
                    placeholder="Type your title...">
            </div>
            <div class="flex flex-col gap-1 mb-3">
                <label for="title" class="font-semibold">Description</label>
                <textarea type="text" id="title" name="title" rows="6"
                    class="ring-2 ring-gray-300 w-full rounded px-4 py-1 font-semibold"
                    placeholder="Type your description..."></textarea>
            </div>
        </form>
    </div>
</body>

</html>