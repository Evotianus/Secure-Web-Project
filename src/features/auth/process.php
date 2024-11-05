<?php
session_start();

include "../../../util/connect.php";
include "../../../util/token.php";
include "../../../util/validation.php";
include "../../../util/message.php";
include "../../../core/config.php";

$connection = openConnection();

function authenticate($connection, $username, $password, $_token)
{
    if (!isset($username, $password)) {
        $_SESSION['messages']['error'] = 'Username and Password field is required!';
        exit();
    }

    $statement = $connection->prepare('SELECT id, username, password FROM users WHERE username = ?');

    if ($statement) {
        $statement->bind_param('s', $username);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows > 0) {
            $fetchId = "";
            $fetchUsername = "";
            $fetchPassword = "";

            $statement->bind_result($fetchId, $fetchUsername, $fetchPassword);
            $statement->fetch();

            if (password_verify($password, $fetchPassword)) {
                session_regenerate_id();

                $_SESSION['logged_in'] = True;
                $_SESSION['name'] = $username;
                $_SESSION['id'] = $fetchId;
                $_SESSION['messages']['error'] = null;
                $_SESSION['messages']['success'] = "Successfully logged in!";

                header("Location: ../notes");
                exit();
            }

            $_SESSION['username'] = $username;
            // $_SESSION['message']
            // $_SESSION['errors_login'] = "Failed to authenticate!";
            $_SESSION['messages']['error'] = "Failed to authenticate!";
            header("Location: index.php");
            exit();
        }

        $statement->close();

        $_SESSION['username'] = $username;
        // $_SESSION['errors_login'] = "Failed to authenticate!";
        $_SESSION['messages']['error'] = "Failed to authenticate!";
        header("Location: index.php");
        exit();
    }

    $connection->close();
}

function register($connection, $username, $password, $confirmPassword, $_token)
{
    if (!isset($username, $password, $confirmPassword)) {
        $_SESSION['messages']['error'] = 'Username, Password & Confirm Password field is required!';
        header("Location: create.php");
        exit();
    }

    if ($password != $confirmPassword) {
        $_SESSION['messages']['error'] = 'Password & Confirm Password doesn\'t match!';
        header("Location: create.php");
        exit();
    }


    if (!validateToken($_token)) {
        $_SESSION['messages']['error'] = 'Unknown token request source!';
        header("Location: create.php");
        exit();
    }

    $statement = $connection->prepare('SELECT username FROM users WHERE username = ?');

    if ($statement) {
        $statement->bind_param('s', $username);
        $statement->execute();

        $statement->store_result();

        if ($statement->num_rows > 0) {
            $_SESSION['messages']['error'] = 'Username already exists, please choose another!';
            header("Location: create.php");
            exit();
        }

        $statement = $connection->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

        if ($statement) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $statement->bind_param('ss', $username, $password);
            $statement->execute();

            $statement->close();

            $_SESSION['messages']['success'] = 'Successfully registered account!';
            $_SESSION['messages']['error'] = null;
            header('Location: index.php');
            exit();
        }

        $_SESSION['messages']['error'] = 'Something went wrong when registering your account!';
        header("Location: create.php");
        exit();
    }

    $connection->close();

    $_SESSION['messages']['error'] = 'Something went wrong when registering your account!';
    header("Location: create.php");
    exit();
}

if (isset($_POST['authenticate-user'])) {
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    $_token = validateInput($_POST['_token']);

    authenticate($connection, $username, $password, $_token);
} else if (isset($_POST['register-user'])) {
    $username = validateInput($_POST["username"]);
    $password = validateInput($_POST["password"]);
    $confirmPassword = validateInput($_POST["confirm_password"]);
    $_token = $_POST["_token"];

    register($connection, $username, $password, $confirmPassword, $_token);
} else if (isset($_POST['logout-user'])) {
    session_start();

    session_unset();
    session_destroy();

    header("Location: index.php");
}