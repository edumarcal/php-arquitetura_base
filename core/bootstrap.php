<?php // Agradeço a Deus pelo dom do conhecimento

use App\Core\App;
use App\Core\Database\{ QueryBuilder, Connection };

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
	Connection::make(App::get('config')['database'])
));

function view($view, $data = [])
{
	extract($data);
	return require "app/views/{$view}.php";
}

function redirect($uri = '')
{
	header("Location: /{$uri}");
}

function json($data)
{
	header('Content-Type: application/json');
	$json = json_encode($data, JSON_PRETTY_PRINT);
/*
	switch (json_last_error()) {
	    case JSON_ERROR_DEPTH:
	        die(json_encode([ 'error' => ' - Maximum stack depth exceeded']));;
	    break;
	    case JSON_ERROR_STATE_MISMATCH:
	        die(json_encode([ 'error' => ' - Underflow or the modes mismatch']));;
	    break;
	    case JSON_ERROR_CTRL_CHAR:
	        die(json_encode([ 'error' => ' - Unexpected control character found']));;
	    break;
	    case JSON_ERROR_SYNTAX:
	        die(json_encode([ 'error' => ' - Syntax error, malformed JSON']));;
	    break;
	    case JSON_ERROR_UTF8:
	        die(json_encode([ 'error' => ' - Malformed UTF-8 characters, possibly incorrectly encoded']));
	    break;
	    default:
	        die(json_encode([ 'error' => ' - Unknown error']));;
	    break;
	}
*/
	die($json);
}