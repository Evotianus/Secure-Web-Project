<?php
session_start();

include "../../connect.php";
include "../../../util/validation.php";

$connection = openConnection();

$title = validateInput($_POST['title']);
$description = validateInput($_POST['description']);
$color = validateInput($_POST['color']);
$userId = $_SESSION['id'];

$statement = $connection->prepare('INSERT INTO notes (title, description, user_id, color) VALUES (?, ?, ?, ?)');

if ($statement) {
    $statement->bind_param('ssis', $title, $description, $userId, $color);
    $statement->execute();

    $statement->close();
}