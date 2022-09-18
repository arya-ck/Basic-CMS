<?php

	// start session
	session_start();
	
	define("PRIVATE_PATH", dirname(__FILE__));
	define("PROJECT_PATH", dirname(PRIVATE_PATH));
	define("PUBLIC_PATH", PROJECT_PATH . '/public');
	define("SHARED_PATH", PROJECT_PATH . '/private/shared');
	
	
	define("DB_HOST", 'localhost');
	define("DB_USER", 'globebankuser');
	define("DB_PASS", '$user$');
	define("DB_NAME", 'globe_bank');
	
	
	$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public')+7;
	$doc_root = substr($_SERVER['SCRIPT_NAME'], 0 , $public_end);
	define("WWW_ROOT", $doc_root);
	#echo WWW_ROOT;
	require_once('functions.php');
	
	$db = db_connect();
?>