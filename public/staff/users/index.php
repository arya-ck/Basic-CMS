<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	// get all users
	$users = find_all_users($db);

	$message = get_message_for_display();
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Users" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div class="admin-container">
			<a href="<?php echo get_url_for('/staff/users/create.php') ?>">Create New Admin User</a>
			<?php if($message !== '') 
				echo "<div class=\"message\">" . $message . "</div>"
			?>
			<div id="content">
				<table class="pages">
					<thead>
						<th>Username</th>
						<th>Name</th>
						<th>Email</th>
						<th>View</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<?php foreach($users as $user){ ?>
						<tr>
							<td><?php echo $user['username'] ?></td>
							<td><?php echo $user['last_name'] . ", " . $user['first_name'] ?></td>
							<td><?php echo $user['email'] ?></td>
							<td><a href="<?php echo get_url_for('/staff/users/show.php') . '?id=' . $user['id'] ?>">View</a></td>
							<td><a href="<?php echo get_url_for('/staff/users/edit.php') . '?id=' . $user['id'] ?>">Edit</a></td>
							<td><a href="<?php echo get_url_for('/staff/users/delete.php') . '?id=' . $user['id'] ?>">Delete</a></td>
						</tr>					
					<?php } ?>
				</table>
			</div>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>