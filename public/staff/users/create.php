<?php
	require_once('../../../private/initialize.php');

	// validate if user logged in session
	require_login();		

	$errors = array();
	$first_name = $_POST['first_name'] ?? '';
	$last_name = $_POST['last_name'] ?? '';
	$email = $_POST['email'] ?? '';
	$username = $_POST['username'] ?? '';
	$password = $_POST['password'] ?? '';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$errors = validate_user($first_name, $last_name, $email, $username, $password);
		
		if(count($errors) < 1){
			$resultset = create_user($db, $first_name, $last_name, $email, $username, $password);
			
			if($resultset){
				set_message('Successfully added User ' . $username);
				header("Location: " . get_url_for("/staff/index.php"));
			} else {
				echo mysqli_error($db);
				db_disconnect($db);
				exit;
			}
		}
	}
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Create User" ?>
		<?php $prev_page="/staff/users/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<?php foreach($errors as $error) { 
				echo "<div class='error'>" . $error ."</div>";
			}?>
			<form action="" method="POST" id="create-page">
				<table class="form">
					<tr>
						<th>First Name</th>
						<th>
							<input type="text" name="first_name" value="<?php echo $first_name; ?>" />
						</th>
					</tr>
					<tr>
						<th>Last Name</th>
						<th>
							<input type="text" name="last_name" value="<?php echo $last_name; ?>" />
						</th>
					</tr>
					<tr>
						<th>Email</th>
						<th>
							<input type="email" name="email" value="<?php echo $email; ?>" />
						</th>
					</tr>
					<tr>
						<th>Username</th>
						<th>
							<input type="text" name="username" value="<?php echo $username; ?>" />
						</th>
					</tr>
					<tr>
						<th>Password</th>
						<th>
							<input type="password" name="password" value="<?php echo $password; ?>" />
						</th>
					</tr>
				</table>
				<input type="submit" value="Save" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>