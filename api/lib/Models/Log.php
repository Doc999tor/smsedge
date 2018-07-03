<?php
namespace Lib\Models;

/**
 *
 */
class Log {

	function __construct() {}

	public static function getLogsByDates (
		\PDO $db,
		\DateTime $start,
		\DateTime $end,
		?int $usr_id = null,
		?int $num_id = null
	): ?array {
		$query = "
			SELECT log_created_aggregated as date,
			    sum(log_success) as success_count,
			    count(log_success) - sum(log_success) as success_fail
			FROM send_log_aggregated
			WHERE
				log_created_aggregated between :start and :end
				and
					case when :usr_id1 is not null then usr_id = :usr_id2 else true end
				and
					case when :num_id1 is not null then num_id = :num_id2 else true end
			GROUP BY log_created_aggregated
		";
		$stmt = $db->prepare($query);
		$stmt->bindValue(':start', $start->format('Y-m-d'), \PDO::PARAM_STR);
		$stmt->bindValue(':end', $end->format('Y-m-d'), \PDO::PARAM_STR);
		$stmt->bindParam(':usr_id1', $usr_id, \PDO::PARAM_INT);
		$stmt->bindParam(':usr_id2', $usr_id, \PDO::PARAM_INT);
		$stmt->bindParam(':num_id1', $num_id, \PDO::PARAM_INT);
		$stmt->bindParam(':num_id2', $num_id, \PDO::PARAM_INT);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}