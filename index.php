<?php 

require_once 'config/config.php';
require_once 'model/db.php';

if(!isset($_GET["controller"])) $_GET["controller"] = 'tarea';
if(!isset($_GET["action"])) $_GET["action"] = 'list';

$controller_path = 'controllers/'.$_GET["controller"].'.php';

if(!file_exists($controller_path)) $controller_path = 'controllers/tarea.php';

require_once $controller_path;
$controllerName = $_GET["controller"].'Controller';
$controller = new $controllerName();

$dataView["data"] = array();
if(method_exists($controller,$_GET["action"])) $dataView["data"] = $controller->{$_GET["action"]}();


require_once 'views/layouts/header.php';
require_once 'views/'.$controller->view.'.php';
require_once 'views/layouts/footer.php';

?>