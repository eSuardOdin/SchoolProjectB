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
use App\Model\Utilisateurs;
use App\Router;


$router = new Router();
// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// Routes

// Old way
// $router->register(
// 	'/',
// 	function() {
// 		echo 'Home';
// 	}
// );

$router->register('/', [App\Classes\Home::class, 'index']); // [Class, 'method']
$router->register(
	'/prof',
	function() {
		echo 'Professeur';
	}
);

// echo '<pre>';
// var_dump($router);
// echo '</pre>';

// Try routing or catch exception
try { 
	echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (\App\Exceptions\RouteNotFoundException $e) {
	echo $e->getErrorMessage();
} 
// $user = new Utilisateurs(1, "Suard", "Erwann", "1234", "e.suard");

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
