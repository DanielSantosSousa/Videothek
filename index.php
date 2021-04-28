<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'HomePageController@index',
	'/ausleihen/' => 'RentController@rent',
	'/ausleihen/validate' => 'RentController@validate',
];

$db = [
	'name'     => 'tasklist',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');