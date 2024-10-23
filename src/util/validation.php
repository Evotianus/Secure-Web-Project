<?php

function validateInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);

    return $input;
}