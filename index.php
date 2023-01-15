<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$starttime = microtime(true);
session_start();
include 'vendor/autoload.php';

//RedirectHelper::maintenance();

$router = new Router();
$page = $router->controller->getPage();
$page->debug = (round((microtime(true) - $starttime) * 100000) / 100) . ' ms - ' . round(memory_get_peak_usage() / 1024) . 'kb';
echo $page;