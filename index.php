<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();


require_once 'classes/Movie.php';
require_once 'classes/DatabaseManager.php';

require_once 'Models/LoginModel.php';
require_once 'Models/MovieModel.php';

require_once 'Controllers/MovieController.php';
require_once 'Controllers/LoginController.php';


$page = $_GET['page'] ?? null;

switch ($page) {
    case 'login':
        (new LoginController())->login();
        break;

    case 'admin':
        (new MovieController())->search();
        break;

    case 'movie-details':
        (new MovieController())->show();
        break;

    case 'add-movie':
        (new MovieController())->addMovie();
        break;

    default:
        (new MovieController())->index();
        break;
}
