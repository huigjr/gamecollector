<?php

class RedirectHelper
{

    public static function pageNotFound($message = null)
    {
        http_response_code(404);
        SELF::outputPlainText($message ?: '404 Page Not Found');
    }

    public static function forbidden($message = null)
    {
        http_response_code(403);
        SELF::outputPlainText($message ?: '403 Forbidden');
    }

    public static function redirect($url)
    {
        header("Location: $url", true, 301);
        exit;
    }

    public static function logout($location = '/')
    {
        session_destroy();
        SELF::redirect($location);
    }

    public static function maintenance($hours=2)
    {
        http_response_code(503);
        header("HTTP/1.1 503 Service Unavailable");
        header("Status: 503 Service Unavailable");
        header("Retry-After: " . $hours * 3600);
        SELF::outputPlainText("At this moment schuduled maintenance is taking place. The duration is expected to be $hours hours. We apologize for the inconvenience.");
    }

    public static function outputJson($array)
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($array, JSON_PRETTY_PRINT);
        exit;
    }

    public static function outputPlainText($plaintext)
    {
        header("Content-type:text/plain;charset=utf-8");
        echo $plaintext;
        exit;
    }
}