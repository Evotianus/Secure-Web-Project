<?php
session_start();

include "../../../util/authenticate.php";
include "../../../util/connect.php";
include "../../../util/validation.php";
include "../../../core/config.php";
include "../../../util/token.php";
include "../../../util/message.php";

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
            error('Something went wrong!');
        }
        error('Something went wrong!');
    }

    $connection->close();

    error('Something went wrong!');
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

        error('Invalid request!');
    }

    error('Something went wrong!');
}

function storeNote($connection, $title, $description, $userId, $color, $_token)
{
    if (!validateToken($_token)) {
        error('Unknown request source!');
    }

    $statement = $connection->prepare('INSERT INTO notes (title, description, user_id, color) VALUES (?, ?, ?, ?)');

    if ($statement) {
        $statement->bind_param('ssis', $title, $description, $userId, $color);
        $statement->execute();

        $statement->close();

        header('Location: ./');

        success('Successfully update note!');
    }

    error('Something went wrong!');
}

function updateNote($connection, $noteId, $title, $description, $color, $userId, $_token)
{
    if (empty($title) || empty($description) || empty($color)) {
        error('All field must be filled!');
    }
    if (!validateToken($_token)) {
        error('Unknown request source!');
    }

    $statement = $connection->prepare('SELECT id, title, description, user_id, color FROM notes WHERE id = ?');

    if ($statement) {
        $statement->bind_param('i', $noteId);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows == 1) {
            $fetchId = null;
            $fetchTitle = null;
            $fetchDescription = null;
            $fetchUserId = null;
            $fetchColor = null;

            $statement->bind_result($fetchId, $fetchTitle, $fetchDescription, $fetchUserId, $fetchColor);
            $statement->fetch();

            if ($noteId != $fetchId || $userId != $fetchUserId) {
                echo "Unauthorized!";
                $_SESSION['messages']['error'] = 'Unauthorized!';
                exit();
            }

            $statement = $connection->prepare('UPDATE notes SET title = ?, description = ?, color = ? WHERE id = ? AND user_id = ?');

            if ($statement) {
                $statement->bind_param('sssii', $title, $description, $color, $fetchId, $fetchUserId);
                $statement->execute();

                header('Location: ./');

                success('Successfully updated note!');
            }
            error('Something went wrong!');
        }
        error('Couldn\'t find data!');
    }
    error('Something went wrong!');
}

function deleteNote($connection, $noteId, $userId, $_token)
{
    if (!validateToken($_token)) {
        error('Unknown request source!');
    }

    $statement = $connection->prepare('SELECT id, user_id FROM notes WHERE id = ?');

    if ($statement) {
        $statement->bind_param('i', $noteId);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows == 1) {
            $fetchNoteId = null;
            $fetchUserId = null;

            $statement->bind_result($fetchNoteId, $fetchUserId);
            $statement->fetch();

            if ($userId != $fetchUserId) {
                error('Unauthorized user!');
            }

            $statement = $connection->prepare('DELETE FROM notes WHERE id = ? AND user_id = ?');

            if ($statement) {
                $statement->bind_param('ii', $fetchNoteId, $fetchUserId);
                $statement->execute();

                header('Location: ./');

                success('Successfully deleted data!');
            }
            error('Something went wrong!');
        }
        error('Couldn\'t find data!');
    }
    error('Something went wrong!');
}

if (isset($_POST['store-note'])) {
    $title = validateInput($_POST['title']);
    $description = validateInput($_POST['description']);
    $color = validateInput($_POST['color']);
    $_token = $_POST['_token'];
    $userId = $_SESSION['id'];

    storeNote($connection, $title, $description, $color, $userId, $_token);
} else if (isset($_POST['update-note'])) {
    $title = validateInput($_POST['title']);
    $description = validateInput($_POST['description']);
    $color = validateInput($_POST['color']);
    $noteId = validateInput($_POST['note_id']);
    $userId = $_SESSION['id'];
    $_token = $_POST['_token'];

    updateNote($connection, $noteId, $title, $description, $color, $userId, $_token);
} else if (isset($_POST['delete-note'])) {
    $noteId = $_POST['note_id'];
    $userId = $_SESSION['id'];
    $_token = $_POST['_token'];

    deleteNote($connection, $noteId, $userId, $_token);
}