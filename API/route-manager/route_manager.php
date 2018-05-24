<?php
include_once 'route_data.php';
include_once 'route.php';
include_once 'web_page.php';

class RouteManager {
	private $mRoute;

	private static function getCurrentUri() {
 		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	private static function generateCurrentRoute() {
		//return new Route(getCurrentUri());
		return Route::buildFromUri(RouteManager::getCurrentUri());
	}

	public function __construct() {
		$this->mRoute = RouteManager::generateCurrentRoute();
		//$this->mWebPage = RouteManager::generateWebPage();
	}

	public function getRoute() {
		return $this->mRoute;
	}

	public function dispatch() {
		$controller = $this->getRoute()->getController();
		$action 	= $this->getRoute()->getAction();
		$params		= $this->getRoute()->getParams();
		
	}
}

?>