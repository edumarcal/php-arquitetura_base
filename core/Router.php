<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Core;

class Router
{
	protected $routes = [
		'GET' => [],
		'POST' => [],
		'PUT' => [],
		'DELETE' => []
	];

	public static function load($file)
	{
		$router = new static;
		require $file;
		return $router;
	}

	public function get($uri, $controller)
	{
		$this->routes['GET'][$uri] = $controller;
	}

	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}

	public function update($uri, $controller)
	{
		$this->routes['PUT'][$uri] = $controller;
	}

	public function delete($uri, $controller)
	{
		$this->routes['DELETE'][$uri] = $controller;
	}

	public function dispatch($uri, $method)
	{
		if (array_key_exists($uri, $this->routes[$method]))
			return $this->callAction(
				...explode('@', $this->routes[$method][$uri])
			);

		$match = $this->matchUriParam($uri);

		if (null !== $match)
		{
			if (array_key_exists($match['uri'], $this->routes[$method]))
			{
				$obj = explode('@', $this->routes[$method][$match['uri']]);
				#die(var_dump($obj[0], $obj[1], $match['param']));
				return $this->callAction($obj[0], $obj[1], $match['param']);	
			}
		}

		#throw new \Exception('Rota não encontrada');
		throw new Error('Rota não encontrada');
	}

	public function callAction($controller, $action, $param = null)
	{
		$controller = "App\\Controllers\\{$controller}";
		$controller = new $controller;
		if (method_exists($controller, $action))
			if (null !== $param)
				return $controller->$action($param);
			else
				return $controller->$action();

		throw new Error("O controlador {$controller} não possui o metódo {$action} especificado");
	}

	public function matchUriParam($uri)
	{
		$uri = explode('/', $uri);
		if (is_numeric($uri[1])) {
			$param = $uri[1]; # Get ID parameter URL
			$uri[1] = '{id}'; # Change for parameter is validate
			$uri = implode('/', $uri); #Set router default
			return [
				'uri' => $uri,
				'param' => $param
			];
		}
	}
}