<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Core\Database;

use App\Core\Error;

class Connection
{
	public static function make($config)
	{
		try {
			return new \PDO(
				$config['connection'] .';dbname=' . $config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);
		} catch(\PDOException $e) {
			throw new Error('Não foi possível conectar ao Banco de Dados. por este motivo:  '. $e->getMessage());
			#die('Não foi possível conectar ao Banco de Dados. por este motivo:  '. $e->getMessage());
		}
	}
}
