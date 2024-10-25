<?php
session_start();

include "../../connect.php";

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
            $_SESSION['message']['error'] = 'Something went wrong!';
            exit();
        }
        $_SESSION['message']['error'] = 'Something went wrong!';
        exit();
    }

    $connection->close();

    $_SESSION['message']['error'] = "Something went wrong!";
    exit();
}