<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;

$app->add(new Tuupola\Middleware\CorsMiddleware);


$app->get('/users', 'UsersCtrl:getAll');
$app->get('/countries', 'CountriesCtrl:getAll');
$app->get('/logs', 'LogsCtrl:getLogsByDates');
