<?php

/**
 * 
 */
class Prova extends Controller {
	
	function __construct() {
		parent::__construct();
		echo "Classe Prova";
	}

	public function print($data) {
		var_dump($this->getParams());
	}
}

?>