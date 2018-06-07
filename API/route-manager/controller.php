<?php
/**
 * 
 */
class Controller {

	private $_params;
	private $_action;
	
	public function __construct() {
		echo '<br>Controller started.<br>';
	}

	public function setParams($params) {
		$this->_params = $params;
	}

	public function getParams() {
		return $this->_params;
	}

	public function init() {

	}

	public function setAction($action) {
		// set the method to execute
		$this->_action = $action;
	}

	public function action() {
		// calls the method saved in action
		$this->_action($this->_params);
	}

	

}

?>