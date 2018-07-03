<?php
namespace Lib\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;

/**
 *
 */
class UsersCtrl extends Controller {
	public function getAll (Request $request, Response $response):Response {

		$users = \Lib\Models\User::getAll($this->db);
		return $response->withJson($users);
	}
}