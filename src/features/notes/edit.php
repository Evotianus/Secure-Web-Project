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
        <a href="./show.php?id=<?= $noteId ?>"
            class="ring-1 ring-gray-900 text-gray-900 hover:text-white hover:bg-gray-900 px-4 py-2 rounded-md font-semibold transition">
            < Back</a>
                <p class="text-2xl font-semibold mt-4">Edit note</p>
                <form action="process.php" class="mt-4" method="POST">
                    <input type="hidden" name="_token" value="<?= createToken() ?>">
                    <input type="hidden" name="note_id" value="<?= $noteId ?>">
                    <div class="flex flex-col gap-1 mb-3">
                        <label for="title" class="font-semibold">Title</label>
                        <input type="text" id="title" name="title"
                            class="ring-1 ring-gray-300 w-full rounded px-4 py-1 font-normal"
                            placeholder="Type your title..." value="<?= $note['title'] ?>" required>
                    </div>
                    <div class="flex flex-col gap-1 mb-3">
                        <label for="description" class="font-semibold">Description</label>
                        <textarea type="text" id="description" name="description" rows="6"
                            class="ring-1 ring-gray-300 w-full rounded px-4 py-1 font-normal"
                            placeholder="Type your description..." required><?= $note['description'] ?></textarea>
                    </div>
                    <div class="flex flex-col gap-1 mb-3">
                        <label for="description" class="font-semibold">Color</label>
                        <select name="color" id="color" class="bg-gray-50 border border-gray-300 rounded px-4 pr-4 py-1"
                            required>
                            <option disabled>-- Pick a color for your note --</option>
                            <option value="red" <?= ($note['color'] == 'red') ? 'selected' : ''; ?>>Red</option>
                            <option value="green" <?= ($note['color'] == 'green') ? 'selected' : ''; ?>>Green</option>
                            <option value="blue" <?= ($note['color'] == 'blue') ? 'selected' : ''; ?>>Blue</option>
                            <option value="yellow" <?= ($note['color'] == 'yellow') ? 'selected' : ''; ?>>Yellow</option>
                            <option value="orange" <?= ($note['color'] == 'orange') ? 'selected' : ''; ?>>Orange</option>
                            <option value="purple" <?= ($note['color'] == 'purple') ? 'selected' : ''; ?>>Purple</option>
                        </select>
                    </div>
                    <button class="bg-blue-500 rounded text-white px-4 py-2 font-semibold mt-2" type="submit"
                        name="update-note">Update</button>
                </form>
    </div>
</body>

</html>