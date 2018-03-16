<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Core;

class Request
{
	public static function uri()
	{
		return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function put()
	{
		$registry = [];
		$data = explode('&', file_get_contents("php://input"));

		foreach ($data as $value) {
			$temp = explode('=', $value);
			$registry[$temp[0]] = $temp[1];
		}
		return $registry;
	}
}
