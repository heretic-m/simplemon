<?php

require_once __DIR__ . '/Monitor.php';

class RedisMonitor extends Monitor
{
	public function check()
	{
		try{
			$redis = new Redis();
			$redis->connect('127.0.0.1');
			if(!empty($this->cfg['pass'])){
				$redis->auth($this->cfg['pass']);
			}
			
			$dbsize = $redis->dbSize();
			$res = 'dbSize: ' . $dbsize;
		
			if($dbsize){
				$status = $dbsize != 0;
			}
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
