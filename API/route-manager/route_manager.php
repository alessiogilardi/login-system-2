<?php

class RouteManager {
	private $mRoute;


	public static function getCurrentUri() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
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
}

?>