<?php
define('ROUTE_LEVEL', 1);
define('PARAMS', 3);
define('SCHEME', array('area', 'controller', 'action', 'params'));
define('BASE_ROUTE', array('area' => '', 'controller' => '', 'action' => '', 'params' => ''));

define('CONTROLLERS', array('', 'login', 'logout', 'register', 'user', 'welcome'));

define('DEFAULT_CONTROLLER_PATH', __DIR__.'/controllers')





//////////////////////
define('CONTROLLER_DATA', array(
	'' => array('title' => 'Main | MySite', 
				'styles' => array(1,2,3), 
				'scripts' => array(1,2,3), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => '')), 
	'login' => array('title' => 'Login | MySite', 
				'styles' => array(1,2,3), 
				'scripts' => array(1,2,3), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => '')), 
	'register' => array('title' => 'Register | MySite', 
				'styles' => array(1,2,3), 
				'scripts' => array(1,2,3), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => '')), 
	'logout' => array('title' => '', 
				'styles' => array(), 
				'scripts' => array(), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => '')), 
	'welcome' => array('title' => 'Welcome | MySite', 
				'styles' => array(1,2,3), 
				'scripts' => array(1,2,3), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => '')), 
	'404' => array('title' => '', 
				'styles' => array(1,2,3), 
				'scripts' => array(1,2,3), 
				'files' => array('head' => '', 
							'body' => '', 
							'footer' => ''))));

define(ACTIONS, array(
	'login' => array('' => function() {}), 
	'register' => array('' => function() {}, 'activate' => function() {}),
	'users' => array()));


$dispatcher = array(
  '' => function() {
  },
  'login' => function() {
  	/*
  		Se sono impostati i dati POST loggo l'utente altrimenti mostro la pagina
  	*/
  },
  'register' => function() {
  	/*
  		Se sono impostati i dati POST controllo l'ACTION,  se corrispondono eseguo un'azione
  		altrimenti do errore.
  		Se i POST non sono impostati e non c'è action mostro la pagina di registrazione
  	*/
  },
  'logout' => function() {
  	/*
  		Non dovrebbero esserci azioni
  	*/
  },
  'welcome' => function() {
	},
  '404' => function() {
	}
);

?>