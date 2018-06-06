<?php
require_once './API/core.php';
$sec = new Security(128);


//echo parse_url($url, PHP_URL_PATH);



/*
$rm = new RouteManager();
$dis = new Dispatcher();
$dis->setRouteManager($rm);
$dis->setControllerPath(__DIR__.DIRECTORY_SEPARATOR.'controllers');
$dis->dispatch();
*/
// In base alle eccezzioni uso il dispatcher per aggiungere ed inviare header


?>