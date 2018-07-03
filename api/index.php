<?php
require 'vendor/autoload.php';
$config = [
	'displayErrorDetails' => true,
	'routerCacheFile' => false,
	'db' => [
		'host'   => '127.0.0.1',
		'dbname' => 'smsedge',
		'user' => 'root',
		'password' => '',
	]
];
$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();
$container['db'] = function ($c) {
	$db = $c['settings']['db'];
	try {
		$connection_string = "mysql:dbname={$db['dbname']};host={$db['host']};";
		$pdo = new PDO($connection_string, $db['user'], $db['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES , false);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return $pdo;
	} catch (PDOException $e) {
		throw $e;
	}
};
$container['LogCtrl'] = function () use ($container) {
	return new \Lib\Controllers\LogCtrl($container);
};
require_once 'routes.php';
$app->run();