<?php // Agradeço a Deus pelo dom do conhecimento

# Show Erros
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use App\Core\{ Router, Request };

Router::load('app/routes.php')->dispatch(Request::uri(), Request::method());
