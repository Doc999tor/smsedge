<?php
namespace Lib\Models;

/**
 * Model class manages sql scripts and other User data operations
 */
class User {

	function __construct() {}
	/**
	 * returns a list of all users without filtration or pagination
	 * @param  \PDO
	 * @return array|null
	 */
	public static function getAll (\PDO $db): ?array {
		$query = "SELECT * FROM users;";
		$stmt = $db->query($query);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}