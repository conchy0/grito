<?php

//valors per defecte
define('WEBBASE', "http://localhost/Grito/");
define('DIRBASE', "C:/xampp/htdocs/Grito");
define('WEBROOT', str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ESTILS', "styles/style.css");
define('PGDEFAULT', "");
define('ERRDEFAULT', "./error.html");
define('TITOL', "Grito Festival");
define('DESCRIPCIO', "... a exemple MVC3.1 ...");

/**
	Funci� que treu WEBROOT de la URL
**/
function treuWEBROOT($cadena) {
	if (stripos($cadena, WEBROOT) == 0) {
		$retorn = substr($cadena, strlen(WEBROOT));
	} else {
		$retorn = $cadena;
	}
	return $retorn;
}

function autoloadFunction($class)
{
    // Ends with a string "Controller"?
	if (($class == "Controller") or ($class == "RouterController") or ($class == "BdD"))
		$dirClass = "../vendors/me/";
	else if (preg_match('/.Controller$/', $class))
		$dirClass = str_replace("Controller", "", $class) . "/controllers/";
	else
		$dirClass = str_replace("Manager", "", $class) . "/models/";
	$file = "./bundle/" . $dirClass .  $class . ".php";
    require($file);
}

// Afegit per Twig
require_once './vendors/autoload.php';
//Twig_Autoloader::register();
spl_autoload_register("autoloadFunction");
?>