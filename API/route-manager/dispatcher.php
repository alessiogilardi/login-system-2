<?php
/**
 * Il Dispatcher deve solo occuparsi di fornire il file controller con i vari controlli del caso, il file si occuperà di eseguire i comandi * giusti
 */
//define('DIRECTORY_SEPARATOR', '/');
define('BASE_CONTROLLER', 'Controller');

class Dispatcher {
	private $_rm; // RouteManager

	private $_headers = array();
	//private $_controllerPath = .DIRECTORY_SEPARATOR.'controllers';
    // !!!!!ATTENZIONE DA MODIFICARE!!!!!! Il percorso deve essere ricavato!!!!!!
    private $_controllerPath = 'C:\\xampp\\htdocs\\login-system'.DIRECTORY_SEPARATOR.'controllers'; 
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

	public function getMethod($action) {
		//return $this->_rm->getRoute()->getAction();
		return lcfirst(ucwords($action, $this->_delimiter)); // Va ritornata la action in camel case con la prima lettera minuscola
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
    	$method            = $this->getMethod($route->getAction());

    	//////////////////////
    	//echo $classPath.'<br>';
    	//echo $className.'<br>';
    	//echo $method.'<br>';
    	//////////////////////

    	//echo $classPath;

    	if (!file_exists($classPath)) {
    		//$classPath = $this->getClassPath(BASE_CONTROLLER);
    		$classPath = __DIR__.DIRECTORY_SEPARATOR.'controller'.'.php';
    		
    		$className = $this->getClassName(BASE_CONTROLLER);
    	} else {
    		$this->loadClass($classPath);
    	}

    	$controller = new $className;
    	$controller->setParams($route->getParams());
    	$controller->setAction($method);
        //echo $method;
    	/*if (isset($method)) { */ if ($method != '') {
	    	if (method_exists($controller, $method)) {
	    		$controller->setParams($route->getParams());
	    		$controller->setAction($method);
                //$controller->$method('');
	    		return $controller;
	    	} else {
	    		throw new RuntimeException('Page not found '.$classPath.'->'.$method, 404);
	    	}
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