<?php
namespace Lib\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;

/**
 * Controller manages users
 */
class UsersCtrl extends Controller {
	/**
	 * simple proxy method returns a json response
	 * @param  Request
	 * @param  Response
	 * @return Response
	 */
	public function getAll (Request $request, Response $response):Response {

		$users = \Lib\Models\User::getAll($this->db);
		return $response->withJson($users);
	}
}