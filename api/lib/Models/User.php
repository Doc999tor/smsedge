<?php
namespace Lib\Models;

/**
 *
 */
class User {

	function __construct() {}

	public static function getAll ($db): ?array {
		$query = "SELECT * FROM users;";
		$stmt = $db->query($query);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}