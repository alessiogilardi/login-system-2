<?php
/**
 * Il Dispatcher deve solo occuparsi di fornire il file controller con i vari controlli del caso, il file si occuperà di eseguire i comandi * giusti
 */
class Dispatcher {
	private $route;

	private $headers = array();
	private $controllersPath;
	private $action;
	
	public function __construct(Route $aRoute) {
		$this->$route = $aRoute;
	}

	public function controllerMatch() {
		$controller = Dispatcher::getRoute()->getController(); // $this->getRoute();
		if isset(CONTROLLERS[$controller])
			return true;
		return false;
	}

	public function actionMatch() {

	}

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