<?php
session_start();

require_once "src/Repository/Repository.php";
require_once "src/Controller/UserController.php";
require_once "src/Repository/UserRepository.php";

require_once "src/Controller/UserController.php";
require_once "src/Controller/ArticleController.php";
require_once "src/Repository/ArticleRepository.php";
require_once "core/Database/Database.php";
require_once "core/View/View.php";
require_once "core/Response/Response.php";

$controller = new \Controller\UserController();
$controller->signInAction();