<?php
class Route {
	private $uri;
	private $area;
	private $controller;
	private $action;
	private $params;

	public static function buildFromUri($uri) {
		$instance = new Route($uri);
		return $instance;
	}

	public static function buildFromRoute(Route $route) {
		//$instance = new Route($route->getUri());
		$instance = new Route();
		$instance->clone($route);
		return $instance;
	}
/*
	public static function getControllerData($controller) {
		if (isset(CONTROLLER_DATA[$controller]))
			return CONTROLLER_DATA[$controller];
		return CONTROLLER_DATA['404'];
	}
*/
	private static function createRouteByUri($aUri = '') {
		$route = BASE_ROUTE;
		$urlSegments = array_slice(explode('/', $aUri), ROUTE_LEVEL);

		foreach ($urlSegments as $index => $segment) {
	        if (SCHEME[$index] == SCHEME[PARAMS]) {
	            $route['params'] = array_slice($urlSegments, $index);
	            break;
	        } else {
	            $route[SCHEME[$index]] = $segment; # Senza lower case
	        }
	    }
		return $route;
	}

	private function __construct($aUri) {
		$route = Route::createRouteByUri($aUri);
		//var_dump($route);
		$this->uri 			= $aUri;
		$this->area 		= $route['area'];
		$this->controller 	= $route['controller'];
		$this->action 		= $route['action'];
		$this->params 		= $route['params'];

	}

	public function getUri() {
		return $this->uri;
	}

	public function getArea() {
		return $this->area;
	}

	public function getController() {
		return $this->controller;
	}

	public function getAction() {
		return $this->action;
	}

	public function getParams() {
		return $this->params;
	}

	public function clone($aRoute) {
		$this->uri 			= $aRoute->getUri();
		$this->area 		= $aRoute->getArea();
		$this->controller 	= $aRoute->getController();
		$this->action 		= $aRoute->getAction();
		$this->params 		= $aRoute->getParams();
	}
}
?>