<?php

require_once __DIR__ . '/TelegramNotifier.php';
require_once __DIR__ . '/LogNotifier.php';

abstract class Notifier
{
	abstract public function notify($notifierCfg, string $msg);
	
	static public function createNotifier($notifierCfg)
	{
		$class = ucfirst($notifierCfg['type']) . 'Notifier';
		return new $class($notifierCfg);
	}
	
	static public function notifyAll($notifiersCfg, $msg)
	{
		$msg = print_r($msg, true);
		foreach($notifiersCfg as $notifierCfg){
			$notifier = self::createNotifier($notifierCfg);
			$notifier->notify($notifierCfg, $msg);
		}
	}
	
	
}
