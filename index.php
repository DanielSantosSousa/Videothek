<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'HomePageController@index',
	'/ausleihen/' => 'RentController@rent',
	'/ausleihen/validate' => 'RentController@validate',
	'/uebersicht' => 'OverviewController@view',
    '/uebersicht/bearbeiten' => 'OverviewController@edit',
    '/uebersicht/bearbeiten/validate' => 'OverviewController@validate',
];


$router = new Router($routes);
$router->run($_GET['url'] ?? '');
