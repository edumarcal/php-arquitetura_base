<?php // Agradeço a Deus pelo dom do conhecimento

return [
	'database' => [
		'name' => 'database_name',
		'username' => 'username',
		'password' => 'password',
		'connection' => 'SGBD:host=127.0.0.1',
		'options' => [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		]
	]
];