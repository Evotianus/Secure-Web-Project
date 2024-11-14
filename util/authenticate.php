<?php
$loggedIn = $_SESSION['logged_in'];

if (!$loggedIn) {
    header('Location: ./src/features/auth');
    exit();
}
