<?php

$toInclude = array('./API/utils/utils_functions.php',
	'./API/route-manager/route_manager.php',
	'./API/constants/cookies.php',
	'./API/constants/database.php',
	'./API/constants/error_codes.php',
	'./API/constants/html_form.php',
	'./API/constants/security.php',
	'./API/constants/session.php');

foreach ($toInclude as $inc) {
	include_once $inc;
}
?>