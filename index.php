<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'HomePageController@index',
	'/ausleihen' => 'RentController@rent',
	'/uebersicht' => 'OverviewController@view',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');
