<?php	
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$resultset = delete_user($db, $id);
		
		if($resultset){
			set_message('Successfully deleted User');
			header("Location: " . get_url_for("/staff/users/index.php") . "?id=" . $id);
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	} else {
		
		// get user details
		$user = find_user_by_id($db, $id);
	}
	
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Delete User" ?>
		<?php $prev_page="/staff/users/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<form action="" method="POST">
				<table class="form">
					<tr>
						<th>ID</th>
						<th>
							<?php echo $user['id']; ?>
						</th>
					</tr>
					<tr>
						<th>First Name</th>
						<th>
							<?php echo $user['first_name']; ?>
						</th>
					</tr>
					<tr>
						<th>Last Name</th>
						<th>
							<?php echo $user['last_name']; ?>
						</th>
					</tr>
					<tr>
						<th>Email</th>
						<th>
							<?php echo $user['email']; ?>
						</th>
					</tr>
					<tr>
						<th>Username</th>
						<th>
							<?php echo $user['username']; ?>
						</th>
					</tr>
				</table>
				<input type="submit" value="Delete" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>