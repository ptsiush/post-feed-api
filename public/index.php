<?php
require_once '../core/Router.php';
require_once '../core/Database.php';
require_once '../app/Controllers/PostController.php';
require_once '../app/Models/Post.php';

$router = new Router();
$router->run();
