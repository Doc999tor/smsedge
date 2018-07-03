<?php
namespace Lib\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;

/**
 *
 */
class LogCtrl extends Controller {
	public function getLogsByDates (Request $request, Response $response):Response {
		$params = $request->getQueryParams();

		if (
			   (!isset($params['start']) || !\DateTime::createFromFormat(('Y-m-d'), $params['start']))
			|| (!isset($params['end'])) || !\DateTime::createFromFormat(('Y-m-d'), $params['end'])
			|| (isset($params['usr_id']) && !ctype_digit($params['usr_id']))
			|| (isset($params['num_id']) && !ctype_digit($params['num_id']))
		) {
			return $response->withStatus(400);
		}

		$start = \DateTime::createFromFormat(('Y-m-d'), $params['start']);
		$end = \DateTime::createFromFormat(('Y-m-d'), $params['end']);
		$usr_id = isset($params['usr_id']) ? (int) filter_var($params['usr_id'], FILTER_SANITIZE_NUMBER_INT) : null;
		$num_id = isset($params['num_id']) ? (int) filter_var($params['num_id'], FILTER_SANITIZE_NUMBER_INT) : null;

		$logs = \Lib\Models\Log::getLogsByDates(
			$this->db,
			$start,
			$end,
			$usr_id,
			$num_id
		);
		return $response->withJson($logs);
	}
}