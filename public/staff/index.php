<?php
	require_once('./../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$message = get_message_for_display();
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Staff Menu" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
		<?php if($message !== '') 
			echo "<div class=\"message\">" . $message . "</div>"
		?>
		<ul>
			<li><a href="<?php echo get_url_for('/staff/subjects/index.php'); ?>">Subjects</a></li>
			<li><a href="<?php echo get_url_for('/staff/users/index.php'); ?>">Users</a></li>
		</ul>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>