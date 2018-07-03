<?php
namespace Lib\Models;

/**
 * Log model
 */
class Log {

	function __construct() {}

	/**
	 * Returns array of \strClass log rows
	 * @param  \PDO
	 * @param  \DateTime  required
	 * @param  \DateTime  required
	 * @param  int|null   optional
	 * @param  int|null   optional
	 * @return array|null
	 */
	public static function getLogsByDates (
		\PDO $db,
		\DateTime $start,
		\DateTime $end,
		?int $usr_id = null,
		?int $cnt_id = null
	): ?array {
		$query = "
			SELECT log_created_aggregated as date,
				sum(log_success) as success_count,
				count(log_success) - sum(log_success) as success_fail
			FROM send_log_aggregated l
			JOIN numbers n on n.num_id = l.num_id
			WHERE
				log_created_aggregated between :start and :end
				and
					case when :usr_id1 is not null then usr_id = :usr_id2 else true end
				and
					case when :cnt_id1 is not null then n.cnt_id = :cnt_id2 else true end
			GROUP BY log_created_aggregated
		";
		$stmt = $db->prepare($query);
		$stmt->bindValue(':start', $start->format('Y-m-d'), \PDO::PARAM_STR);
		$stmt->bindValue(':end', $end->format('Y-m-d'), \PDO::PARAM_STR);
		$stmt->bindParam(':usr_id1', $usr_id, \PDO::PARAM_INT);
		$stmt->bindParam(':usr_id2', $usr_id, \PDO::PARAM_INT);
		$stmt->bindParam(':cnt_id1', $cnt_id, \PDO::PARAM_INT);
		$stmt->bindParam(':cnt_id2', $cnt_id, \PDO::PARAM_INT);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return $res;
	}
}