<?php
	#phpinfo();
	$db = db_connect();
	
	require_once('users.php');
	require_once('subjects.php');
	require_once('pages.php');
	require_once('validations.php');

	// generate url
	function get_url_for($script_path){
		if($script_path[0] != '/'){
			$script_path = '/' . $script_path;
		}
		
		return WWW_ROOT . $script_path;
	}
	
	// connect to database
	function db_connect(){
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		#mysql_select_db(DB_NAME);
		return $connection;
	}
	
	// disconnect from database
	function db_disconnect($handle){
		mysqli_close($handle);
	}
	
	// sanitize html content to strip out dangerous tags
	function sanitize_html($content){
		$allowed_tags = "<div><img><h1><h2><h3><h4><h5><h6><p><br><strong><em><i><ul><ol><li>";
		return strip_tags($content, $allowed_tags);
	}
	
	// set message to session
	function set_message($msg){
		$_SESSION['message'] = $msg;
	}

	// get message from session
	function get_message_for_display(){
		$msg = '';
		if(isset($_SESSION['message'])){
			$msg = $_SESSION['message'];
			unset($_SESSION['message']);
		}
		return $msg;
	}
?>