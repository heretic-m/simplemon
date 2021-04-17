<?php
	
	return [
		'hostname' => 't480',
		'notifiers' => [
			[
				'type' => 'log',
				'filename' => __DIR__ . '/../log/log.txt'
			],
			[
				'type' => 'telegram',
				'chat_id' => 0,
				'bot_id' => ''
			]
		],
		'services' => [
			[
				'type' => 'http',
				'url' => 'http://localhost:80/',
				'expected_code' => 200,
				'expected_string' => 'html'
			],
			[
				'type' => 'mysql',
				'host' => '127.0.0.1',
				'user' => 'root',
				'db' => 'user',
				'password' => 'root',
				'query' => 'select version();'
			],
			[
				'type' => 'redis',
				'pass' => ''
			],
			[
				'type' => 'http',
				'url' => 'http://localhost:9200/_cluster/health',
				'expected_code' => 200,
				'full_resp' => true
			],
		]
	];
