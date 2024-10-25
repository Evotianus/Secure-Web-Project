<?php
// For authenticating user purposes
session_start();

include '../../connect.php';
include '../../util/validation.php';

$connection = openConnection();

// Get and validate the input
$username = validateInput($_POST['username']);
$password = validateInput($_POST['password']);

if (!isset($username, $password)) {
    $_SESSION['messages']['error'] = 'Username and Password field is required!';
    exit();
}

// Authentication
$statement = $connection->prepare('SELECT id, username, password FROM users WHERE username = ?');

if ($statement) {
    $statement->bind_param('s', $username);
    $statement->execute();

    $statement->store_result();

    // To validate the user's password
    if ($statement->num_rows > 0) {
        $statement->bind_result($fetchId, $fetchUsername, $fetchPassword);
        $statement->fetch();

        if (password_verify($password, $fetchPassword)) {
            session_regenerate_id();

            $_SESSION['logged_in'] = True;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $fetchId;
            $_SESSION['messages']['error'] = null;
            $_SESSION['messages']['success'] = "Successfully logged in!";

            header("Location: ../dashboard");
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
