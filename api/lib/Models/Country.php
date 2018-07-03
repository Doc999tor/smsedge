<?php
namespace Lib\Models;

/**
 * Model class manages sql scripts and other Country data operations
 */
class Country {

	function __construct() {}
	/**
	 * returns a list of all countries without filtration or pagination
	 * @param  \PDO
	 * @return array|null
	 */
	public static function getAll (\PDO $db): ?array {
		$query = "SELECT * FROM countries;";
		$stmt = $db->query($query);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}