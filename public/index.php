<?php

use App\Core\App;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__DIR__));

// Подключаем авто загрузчик классов Composer
require ROOT . '/vendor/autoload.php';
require ROOT . '/config/routes.php';

App::run();