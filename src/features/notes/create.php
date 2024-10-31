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
    <?php
    include "../../../util/navbar.php";
    ?>

    <div class="mx-36 my-4">
        <p class="text-2xl font-semibold">Add new note</p>
        <form action="store.php" class="mt-4" method="POST">
            <div class="flex flex-col gap-1 mb-3">
                <label for="title" class="font-semibold">Title</label>
                <input type="text" id="title" name="title"
                    class="ring-1 ring-gray-300 w-full rounded px-4 py-1 font-normal" placeholder="Type your title..."
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-3">
                <label for="description" class="font-semibold">Description</label>
                <textarea type="text" id="description" name="description" rows="6"
                    class="ring-1 ring-gray-300 w-full rounded px-4 py-1 font-normal"
                    placeholder="Type your description..." required></textarea>
            </div>
            <div class="flex flex-col gap-1 mb-3">
                <label for="description" class="font-semibold">Color</label>
                <select name="color" id="color" class="bg-gray-50 border border-gray-300 rounded px-4 pr-4 py-1"
                    required>
                    <option selected disabled>-- Pick a color for your note --</option>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                    <option value="blue">Blue</option>
                    <option value="yellow">Yellow</option>
                    <option value="orange">Orange</option>
                    <option value="purple">Purple</option>
                </select>
            </div>
            <button class="bg-blue-500 rounded text-white px-4 py-2 font-semibold mt-2" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>