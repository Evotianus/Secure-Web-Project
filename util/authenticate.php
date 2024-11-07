<?php
$loggedIn = $_SESSION['logged_in'];

if (!$loggedIn) {
    header('Location: /secure-web-project/src/features/auth');
    exit();
}