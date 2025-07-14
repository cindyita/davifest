<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

session_start();

require_once 'utils/router.php';

require_once 'data.php';
require_once 'controller/pageController.php';
require_once 'controller/formController.php';

$router = new Router();

// GET ----------------------------
$router->get('/', function () {
    PageController::header();
    PageController::home();
    PageController::footer();
});

$router->get('admin', function () {
    PageController::admin();
});

$router->get('logout', function () {
    PageController::logout();
});

// POST --------------------------
$router->post('confirm', function () {
    FormController::saveCongrats();
});

$router->post('admin', function () {
    PageController::admin();
});


$router->get('admin/getcongrats', function () {
    FormController::getCongrats();
});

$router->get('admin/getstats', function () {
    FormController::getStats();
});

$router->post('getname', function () {
    FormController::getName();
});

$router->get('admin/delete/{id}', function ($id) {
    FormController::deleteCongrats($id);
});

$router->post('admin/update', function () {
    FormController::updateGuest();
});

// RUN ------------------------------
$router->dispatch($_SERVER['REQUEST_METHOD'], $_GET['r'] ?? '');

register_shutdown_function(function () {
    DBModel::disconnect();
});