<?php
namespace Lib\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;

/**
 * Controller managas Countries requests
 */
class CountriesCtrl extends Controller {
	/**
	 * simple proxy method returns a json
	 * @param  Request
	 * @param  Response
	 * @return Response
	 */
	public function getAll (Request $request, Response $response):Response {

		$users = \Lib\Models\Country::getAll($this->db);
		return $response->withJson($users);
	}
}