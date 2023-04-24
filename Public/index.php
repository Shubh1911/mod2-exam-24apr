<?php
require_once '../vendor/autoload.php'; //composer
require_once '../App/Config/Config.php'; //Config
require_once '../App/Helper/Session.php';// Helper
$param = $_SERVER['REQUEST_URI'];
$param = strtolower($param);
$parameters = explode("/", $param);
$control="Stock";
$function="header";
// if parameters are set then assign them try o variables
if (isset($parameters[1]) && $parameters[1] != '') {
    $control = $parameters[1];
    $control = ucfirst($control);
}
if (isset($parameters[2]) && $parameters[2] != '') {
    $function = $parameters[2];
}

// try  creating  the controller object if not possible then call default Home class
try {
    $class_name = "App\\Controllers\\$control";
    $class = new $class_name();
    //  if method exists then call the class method
    if (method_exists($class, $function)) {
        $class->$function();
    }
} catch (error) {
    $control = 'Home';
    $function = 'register';
    $class_name = "App\\Controllers\\$control";
    $class = new $class_name();
}
?>