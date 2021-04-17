<?php

require_once __DIR__ . '/Monitor.php';

class MysqlMonitor extends Monitor
{
	public function check()
	{
		try{
			$db = new PDO(
				'mysql:host='.$this->cfg['host'].';dbname='.$this->cfg['db'],
				$this->cfg['user'],
				$this->cfg['password'],
				[
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
				]
			);
		
			$sth = $db->prepare($this->cfg['query']);
			$sth->execute();
			$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		
			$status = !empty($res[0]);
			$res = $res[0];
		}catch(\Exception $e)
		{
			$status = false;
			$res = $e->getMessage();
		}
		return [
			'status' => $status,
			'res' => $res
		];
	}
}
