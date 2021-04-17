<?php

require_once __DIR__ . '/HttpMonitor.php';
require_once __DIR__ . '/MysqlMonitor.php';
require_once __DIR__ . '/RedisMonitor.php';

	
abstract class Monitor
{
	protected $cfg;
	abstract public function check();
	
	public function __construct($serviceCfg)
	{
		$this->cfg = $serviceCfg;
	}
	
	static public function createMonitor($serviceCfg)
	{
		$class = ucfirst($serviceCfg['type']) . 'Monitor';
		return new $class($serviceCfg);
	}
	
	static public function checkAll($hostname, $servicesCfg)
	{
		$fails = [];
		foreach($servicesCfg as $serviceCfg){
			$monitor = self::createMonitor($serviceCfg);
			$res = $monitor->check();
			//print_r($res);
			if(!$res['status']){
				$res['hostname'] = $hostname;
				$res['time'] = date("Y-m-d H:i:s");
				$res['type'] = $serviceCfg['type'];
				$fails[] = $res;
			}
		}
		return $fails;
	}
	
	
}
