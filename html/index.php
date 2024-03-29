<?php
declare(strict_types = 1);

// Autoload from composer
require_once __DIR__ . '/../html/vendor/autoload.php';

// Custom auto loader to include path files
/*
spl_autoload_register(function($path) {
	// Find file
	$path = __DIR__ . '/' . str_replace('\\', '/', $path) . '.php';
	if(file_exists($path))
	{
		require $path;
	}
});
*/


// Namespaces use
use App\Router;


$router = new Router();
session_start();

// Upload storage path
define('STORAGE_PATH', __DIR__ . '/storage');
define('VIEW_PATH', __DIR__ . '/Views');


// Routes -> can chain methods as router returns self
$router
	->get('/', [App\Controllers\HomeController::class, 'index']) // [Class, 'method']
	->post('/upload', [App\Controllers\HomeController::class, 'upload'])
	->get('/utilisateur', [App\Controllers\UtilisateurController::class, 'menu'])
	->get('/utilisateur/create', [App\Controllers\UtilisateurController::class, 'create'])
	->post('/utilisateur/create', [App\Controllers\UtilisateurController::class, 'store']);

// Try routing or catch exception
try { 
	echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
} catch (\App\Exceptions\RouteNotFoundException $e) {
	echo $e->getErrorMessage();
} 




// // Session test
// $_SESSION['count'] = $_SESSION['count'] + 1 ?? 0;
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
?>











































<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Conservatoire</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.38" />
</head>

<body>
	<a href="login.php">Login</a>
	<a href="directeur/main.php">Directeur</a>
	<?php
	if(isset($_SESSION['id_utilisateur']))
	{
		require 'menu.php';
	}
	else
	{
		require 'login.php';
	}
	// require 'professeurs.php';
	// require 'eleves.php';
	?>
</body>

</html> -->
