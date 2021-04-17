<?php

require_once __DIR__ . '/Monitor.php';

class ShellMonitor extends Monitor
{
	public function check()
	{
		exec($this->cfg['exec'], $out);
		$out = implode("\n", $out);
		if(mb_strpos($out, $this->cfg['expected_string'], 0, 'utf-8') === false){
			$status = false;
		}else{
			$status = true;
		}
		
		$res = [
			'status' => $status,
		];
		if(!empty($this->cfg['full_resp'])){
			$res['full_resp'] = $out;
		}
		return $res;
	}
	
}
