<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];
	
	//echo htmlspecialchars($id);
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_POST['id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$resultset = update_user($db, $first_name, $last_name, $email, $username, $password);

		if($resultset){
			set_message('Successfully saved User ' . $username);
			header("Location: " . get_url_for("/staff/users/index.php"));
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
		<?php $page_title="Edit User" ?>
		<?php $prev_page="/staff/users/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
		<form action="" method="POST" id="create-page">
				<table class="form">
					<tr>
						<th>ID</th>
						<th>
							<input type="text" name="id" value="<?php echo $user['id']; ?>" />
						</th>
					</tr>
					<tr>
						<th>First Name</th>
						<th>
							<input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" />
						</th>
					</tr>
					<tr>
						<th>Last Name</th>
						<th>
							<input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" />
						</th>
					</tr>
					<tr>
						<th>Email</th>
						<th>
							<input type="email" name="email" value="<?php echo $user['email']; ?>" />
						</th>
					</tr>
					<tr>
						<th>Username</th>
						<th>
							<input type="text" name="username" value="<?php echo $user['username']; ?>" />
						</th>
					</tr>
					<tr>
						<th>Password</th>
						<th>
							<input type="password" name="password" value="<?php echo $user['hashed_password']; ?>" />
						</th>
					</tr>
				</table>
				<input type="submit" value="Save" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>