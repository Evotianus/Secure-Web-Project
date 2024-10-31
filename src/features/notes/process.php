<?php
session_start();

include "../../connect.php";
include "../../../util/validation.php";
// include "../../../util/token.php";

$connection = openConnection();

function getPersonalNotes($userId)
{
    global $connection;

    $statement = $connection->prepare('SELECT id, username FROM users WHERE id = ?');

    if ($statement) {
        $statement->bind_param('i', $userId);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows > 0) {
            $fetchId = null;
            $fetchUsername = null;

            $statement->bind_result($fetchId, $fetchUsername);
            $statement->fetch();

            $statement = $connection->prepare('SELECT * FROM notes WHERE user_id = ?');

            if ($statement) {
                $statement->bind_param('i', $fetchId);
                $statement->execute();

                $result = $statement->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                return $data;
            }
            $_SESSION['messages']['error'] = 'Something went wrong!';
            exit();
        }
        $_SESSION['messages']['error'] = 'Something went wrong!';
        exit();
    }

    $connection->close();

    $_SESSION['messages']['error'] = "Something went wrong!";
    exit();
}

function showNote($noteId)
{
    global $connection;
    $userId = $_SESSION['id'];

    $statement = $connection->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ? LIMIT 1");

    if ($statement) {
        $statement->bind_param("ii", $noteId, $userId);
        $statement->execute();

        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            return $data;
        }

        $_SESSION['messages']['error'] = "Invalid request!";
        exit();
    }

    $_SESSION['messages']['error'] = "Invalid request!";
    exit();
}

function updateNote($noteId, $title, $description, $color)
{

}

if (isset($_POST['update-note'])) {
    $title = validateInput($_POST['title']);
    $description = validateInput($_POST['description']);
    $color = validateInput($_POST['color']);
    $noteId = validateInput($_POST['noteId']);
    $_token = $_POST['_token'];

    if (empty($title) || empty($description) || empty($color)) {
        echo "Field cannot be empty!";
        $_SESSION['messages']['error'] = "Field cannot be empty!";
        exit();
    }
    if (!validateToken($_token)) {
        echo "Unknown request source!";
        $_SESSION["messages"]["error"] = "Unknown request source!";
        exit();
    }

    $statement = $connection->prepare('SELECT * FROM notes WHERE title = ? AND description = ? AND color = ?');

    if ($statement) {
        $statement->bind_param('sss', $noteId, $title, $description, $color);
    }
}