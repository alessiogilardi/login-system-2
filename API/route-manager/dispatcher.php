<?php
/**
 * Il Dispatcher deve solo occuparsi di fornire il file controller con i vari controlli del caso, il file si occuperà di eseguire i comandi * giusti
 */
class Dispatcher {
	private $_rm; // RouteManager

	private $_headers = array();
	private $_controllerPath;

	private function getFileName($controller) {
		return $this->getControllerPath().$controller.'.php'
	}

	private function getClassName($controller) {

	}
/*
	public function __construct(RouteManager $rm) {
		$this->_rm = $rm;
	}
*/
	public function __construct() {
		//
	}

	public function setRouteManager(RouteManager $rm) {
		$this->_rm = $rm;
	}

	public function getRouteManager() {
		return $this->_rm;
	}

	public function setControllerPath($path) {
        $this->_controllerPath = $path;
    }

    public function getControllerPath() {
    	return $this->_controllerPath;
    }

// Controller e method (action) vanno convertiti in camel case
    public function match() {
    	$controller = $this->getRouteManager()->getRoute()->getController();
    	$action 	= $this->getRouteManager()->getRoute()->getAction();
    	if file_exists($this->getFileName($controller)) {
    		if method_exists($controller, $action) {
    			require_once getFileName($controller);
    		}
    	}

    	// header 404
    }

/*
	//  Valutare se utilizzare un piccolo DB magari embedded per i controllers e le actions
	public function addController($name, $actions = array()) {
		// aggiunge una riga ad un file dove rimangono registrati i controllers e le actions consentite

	}

	public function addAction($controllerName, $actionName) {

	}

	public function deleteController($name) {

	}

	public function deleteAction($controllerName, $actionName) {

	}

	private function loadControllersData() {
		// carica il file
	}
*/	
	
/*
	public function controllerMatch() {
		$controller = Dispatcher::getRoute()->getController(); // $this->getRoute();
		if isset(controllersData[$controller])
			return true;
		return false;
	}

	public function actionMatch() {
		$controller = Dispatcher::getRoute()->getController();
		$action 	= Dispatcher::getRoute()->getAction();
		if isset(controllersData[$controller][$action])
			return true;
		return false;

	}
*/
	public function dispatch() {
		if !(controllerMatch() && actionMatch()) {

		}
	}

	public function getRoute() {
		return $route;
	}

	public function sendHeaders() {
        $headers = $this->getHeaders();
        foreach ($headers as $header) {
            header($header["string"], $header["replace"], $header["code"]);
        }
    }

    public function clearHeaders() {
        $this->$headers = array();
    }

    public function addHeader($key, $value, $httpCode = 200, $replace  = true) {
        $this->_headers[] = array('string' => "{$key}:{$value}", "replace" => $replace, "code" => (int)$httpCode);
    }

    public function getHeaders() {
        return $this->_headers;
    }
}

?>