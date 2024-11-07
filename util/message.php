<?php
function error($message)
{
    echo $message;
    $_SESSION['messages']['error'] = $message;
    exit();
}

function success($message)
{
    $_SESSION['messages']['success'] = $message;
    exit();
}