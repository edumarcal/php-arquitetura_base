<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Core;

use App\Core\Error;

class App
{
	protected static $registry = [];

	public static function bind($key, $value)
	{
		static::$registry[$key] = $value;
	}

	public static function get($key)
	{
		if (array_key_exists($key, static::$registry))
			return static::$registry[$key];
		throw new Error("Chave {$key} não encontrada");
	}
}
