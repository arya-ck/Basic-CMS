<?php	
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];	
	
	// get user details
	$user = find_user_by_id($db, $id);
	
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="View User" ?>
		<?php $prev_page="/staff/users/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<table class="form">
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
				<tr>
					<td><a href="<?php echo get_url_for('/staff/users/edit.php') . '?id=' . $user['id'] ?>">Edit</a></td>
					<td><a href="<?php echo get_url_for('/staff/users/delete.php') . '?id=' . $user['id'] ?>">Delete</a></td>
				</tr>
			</table>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>