<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Controllers;

use App\Models\ExampleModel as Model;

use App\Core\App;

class ExampleController
{
	public function index()
	{
		$title = new Model('Olá Mundo');
		return view('index', ['title' => $title ]);
	}

	public function list()
	{
		$resultSet = App::get('database')->selectAll('table_name');
		return json($resultSet);
	}
}
