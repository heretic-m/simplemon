<?php
	
	require_once __DIR__ . '/classes/Monitor.php';
	require_once __DIR__ . '/classes/Notifier.php';
	$cfg = require_once __DIR__ . '/cfg/cfg.php';

	$fails = Monitor::checkAll($cfg['hostname'], $cfg['services']);
	if(!empty($fails)){
		Notifier::notifyAll($cfg['notifiers'], $fails);
	}
	
	
