<?php
// For registering user purposes
session_start();

include "../../connect.php";
include "../../../util/token.php";
include "../../../util/validation.php";
include "../../../core/config.php";

$connection = openConnection();

// Get and validate the input
$username = validateInput($_POST["username"]);
$password = validateInput($_POST["password"]);
$confirmPassword = validateInput($_POST["confirm_password"]);
$_token = $_POST["_token"];

if (!isset($username, $password, $confirmPassword)) {
    $_SESSION['messages']['error'] = 'Username, Password & Confirm Password field is required!';
    header("Location: create.php");
    exit();
}

// Password and Confirm Password validation
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

// Validate if there's same username already created
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

    // Storing account
    $statement = $connection->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

    if ($statement) {
        // Hashing the password using password_hash()
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

