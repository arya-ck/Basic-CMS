<?php
	require_once('../../private/initialize.php');
    
    
	$username = '';
    $password = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_POST['username'];
	    $password = $_POST['password'];
        $user = find_user_by_username($db, $username);
		echo print_r($user);
        if(password_verify($password, $user['hashed_password'])){
			login_user($db, $user);
			header("Location: " . get_url_for("/staff/index.php"));			
        } else {
            echo "failed";
        }
	} else {
		
	}
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