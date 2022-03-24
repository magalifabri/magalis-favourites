<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();


require_once 'classes/Movie.php';
require_once 'Controllers/AdminController.php';


$page = $_GET['page'] ?? null;

switch ($page) {
    case 'admin':
        (new AdminController())->index();
        break;

    default:
        # code...
        break;
}
