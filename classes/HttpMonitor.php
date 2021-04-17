<?php

require_once __DIR__ . '/Monitor.php';

class HttpMonitor extends Monitor
{
	public function check()
	{
		if(!empty($this->cfg['expected_code'])){
			$expectedCode = $this->cfg['expected_code'];
		}else{
			$expectedCode = 200;
		}
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->cfg['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$status = true;
		$msg = [];
		if($httpcode != $expectedCode){
			$status = false;
			$msg[] = 'wrong http code';
		}
		if(!empty($this->cfg['expected_string'])){
			if(mb_strpos($output, $this->cfg['expected_string'], 0, 'utf-8') === false){
				$status = false;
				$msg[] = 'string not match';
			}	
		}
		
		$retval = [
			'status' => $status,
			'url' => $this->cfg['url'],
			'http_code' => $httpcode,
			'output_length' => mb_strlen($output, 'utf-8'),
			'msg' => $msg,
		];
		
		if(!empty($this->cfg['full_resp'])){
			$retval['full_resp'] = $output;
		}
		return $retval;
	}
	
}
