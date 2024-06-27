<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Inclure le fichier autoload de Composer...
require __DIR__.'/../vendor/autoload.php';

// Inclure le fichier bootstrap de Laravel...
$app = require_once __DIR__.'/../bootstrap/app.php';

// Capturer la requête entrante et la traiter par l'application Laravel...
$app->handleRequest(Request::capture());