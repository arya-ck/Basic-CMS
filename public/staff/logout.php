<?php
	require_once('../../private/initialize.php');
	log_out_user();
	require_login();
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Login" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content"  class="admin-container">
			<form action="" method="POST">
				<table class="form">
					<tr>
						<th>
							<label for="username">Username</label>
						</th>
						<th>
							<input type="text" name="username" value="<?php echo $username ?>" />
						</th>
					</tr>
					<tr>
						<th>
							<label for="passowrd">Password</label>
						</th>
						<th>
							<input type="password" name="password" value="<?php echo $password ?>" />
						</th>
					</tr>
				</table>
				<input type="submit" value="Login" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>