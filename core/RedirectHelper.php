<?php

class RedirectHelper
{

    public static function pageNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo '404 Page Not Found';
        exit;
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
    
    public static function logout($location = '/')
    {
        session_destroy();
        SELF::redirect($location);
    }
    
    public static function outputJson($array)
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($array, JSON_PRETTY_PRINT);
        exit;
    }

    public static function maintenance($hours=2)
    {
        $seconds = $hours * 3600;
        header("HTTP/1.1 503 Service Unavailable");
        header("Status: 503 Service Unavailable");
        header("Retry-After: $seconds");
        echo "At this moment schuduled maintenance is taking place. The duration is expected to be $hours hours. We apologize for the inconvenience";
        exit;
    }
}