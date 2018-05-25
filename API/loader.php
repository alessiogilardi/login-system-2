<?php
/**
 * 
 */
class Loader
{
	/*
	public static function register() {
		spl_autoload_register(function($className) {

		});
	}*/

	public static function classmap() {
		$routing = array(
			'./API/utils/utils_functions.php',
			'./API/route-manager/route_manager.php',
			'./API/route-manager/route.php',
			'./API/route-manager/dispatcher.php',
			'./API/route-manager/route_data.php',
			'./API/route-manager/controller.php'
		);
		$constants = array(
			'./API/constants/cookies.php',
			'./API/constants/database.php',
			'./API/constants/error_codes.php',
			'./API/constants/html_form.php',
			'./API/constants/security.php',
			'./API/constants/session.php'
		);

		$database = array(
			'./API/db/db_adapter.php'
		);

		$classes = array_merge($routing, $constants, $database);
		foreach ($classes as $className) {
			require_once $className;
		}
	}
}
?>