<?php
namespace Lib\Models;

/**
 *
 */
class Country {

	function __construct() {}

	public static function getAll ($db): ?array {
		$query = "SELECT * FROM countries;";
		$stmt = $db->query($query);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}