<?php

require_once __DIR__ . '/Notifier.php';

class LogNotifier extends Notifier
{
	public function notify($notifierCfg, string $msg)
    {
        file_put_contents( $notifierCfg['filename'], $msg . "\n", FILE_APPEND);
    }	
}
