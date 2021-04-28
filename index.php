<?php
require 'core/bootstrap.php';

$routes = [
	'/videothek/' => 'HomePageController@index',
	'/videothek/ausleihen/' => 'RentController@rent',
];

$db = [
	'name'     => 'tasklist',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');