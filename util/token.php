<?php
function createToken()
{
    $seed = random_bytes(8);
    $time = time();

    $hash = hash_hmac("sha256", session_id() . $seed . $time, CSRF_TOKEN_SECRET, true);

    return urlSafeEncode($hash . '|' . $seed . '|' . $time);
}

function validateToken($token)
{
    $parts = explode('|', urlSafeDecode($token));

    if (count($parts) === 3) {
        $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], CSRF_TOKEN_SECRET, true);

        if (hash_equals($hash, $parts[0])) {
            return true;
        }
    }

    return false;
}

function urlSafeEncode($message)
{
    return rtrim(strtr(base64_encode($message), '+/', '-_'), '=');
}

function urlSafeDecode($message)
{
    return base64_decode(strtr($message, '-_', '+/'));
}