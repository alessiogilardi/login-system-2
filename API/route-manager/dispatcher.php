<?php
/**
 * Il Dispatcher deve solo occuparsi di fornire il file controller con i vari controlli del caso, il file si occuperà di eseguire i comandi * giusti
 */
//define('DIRECTORY_SEPARATOR', '/');
define('BASE_CONTROLLER', 'controller');

class Dispatcher {
	private $_rm; // RouteManager

	private $_headers = array();
	private $_controllerPath = __DIR__.DIRECTORY_SEPARATOR.'controllers';
	private $_delimiter = '-';

	private function loadClass($classPath) {
		require_once $classPath;
	}
	
	public function getClassPath($controller) {
		return $this->getControllerPath().DIRECTORY_SEPARATOR.str_replace($this->_delimiter, '_', $controller).'.php';
	}

	public function getClassName($controller) {
		return ucwords($controller, $this->_delimiter);
	}

	public function getMethod() {
		return $this->_rm->getRoute()->getAction();
	}

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
    
    public function dispatch() {
    	$route             = $this->getRouteManager()->getRoute();
    	$controllerName    = $route->getController();
    	$classPath 	       = $this->getClassPath($controllerName);
    	$className 	       = $this->getClassName($controllerName);
    	$method 	       = $this->getMethod();

    	//////////////////////
    	//echo $classPath.'<br>';
    	//echo $className.'<br>';
    	//echo $method.'<br>';
    	//////////////////////

    	if (!file_exists($classPath)) {
    		$classPath = $this->getClassPath(BASE_CONTROLLER);
    		$className = $this->getClassName(BASE_CONTROLLER);
    		echo "non esiste";
    	} else {
    		$this->loadClass($classPath);
    		echo 'QUI';
    	}

    	$controller = new $className;
    	$controller->setParams($route->getParams());
    	$controller->setAction($route->getAction());

    	if (method_exists($controller, $method)) {
    		//$controller->action();
    		return $controller;
    	} else {
    		//throw new RuntimeException('Page not found {'.$classPath.'}->{'.$method.'}', 404);
    	}
    }

	public function sendHeaders() {
        $headers = $this->getHeaders();
        foreach ($headers as $header) {
            header($header['string'], $header['replace'], $header['code']);
        }
    }

    public function clearHeaders() {
        $this->$headers = array();
    }

    public function addHeader($key, $value, $httpCode = 200, $replace  = true) {
        $this->_headers[] = array('string' => "{$key}:{$value}", 'replace'=> $replace, 'code' => (int)$httpCode);
    }

    public function getHeaders() {
        return $this->_headers;
    }
}

?>