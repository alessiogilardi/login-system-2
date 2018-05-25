<?php
/**
 * Il Dispatcher deve solo occuparsi di fornire il file controller con i vari controlli del caso, il file si occuperà di eseguire i comandi * giusti
 */
define('DIRECTORY_SEPARATOR', '/');
define('BASE_CONTROLLER', 'Controller');

class Dispatcher {
	private $_rm; // RouteManager

	private $_headers = array();
	private $_controllerPath = __DIR__.DIRECTORY_SEPARATOR.'controllers'
	private $_delimiter = '-';

	// per poter ottenere il camel case dei controllers usa i nomi dei file così: nome-del-file.php
	// per i metodi vediamo

	private function getControllerPath() {
    	return $this->_controllerPath;
    }

	private function getClassPath($controller) {
		return $this->getControllerPath().DIRECTORY_SEPARATOR.$controller.'.php'
	}

	private function getClassName($controller) {
		return ucwords($controller, $_delimiter);
	}

	private function loadClass($classPath) {
		require_once $classPath;
	}

	private function getMethod() {
		return $this->_rm->getRoute()->getAction();
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

    
    public function dispatch() {
    	$route = $this->getRouteManger()->getRoute();
    	$controllerName = $route->getController();
    	$classPath 	= $this->getClassPath($controller);
    	$className 	= $this->getClassName($controller);
    	$method 	= $this->getMethod();
    	if (!file_exists($classPath)) {
    		$classPath = $this->getClassPath(BASE_CONTROLLER);
    		$className = $this->getClassName(BASE_CONTROLLER);
    	} else {
    		$this->loadClass($classPath);
    	}

    	$controller = new $className;
    	$controller->setParams($route->getParams());
    	$controller->setAction($route->getAction());

    	if (method_exists($controller, $method)) {
    		$controller->action();
    	} else {
    		throw new RuntimeException('Page not found {'.$classPath.'}->{'.$method.'}', 404);

    	}
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