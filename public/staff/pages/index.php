<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	// get all pages
	$pages = find_all_pages($db);

	$message = get_message_for_display();
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Pages" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div class="admin-container">
			<a href="<?php echo get_url_for('/staff/pages/create.php') ?>">Create New Page</a>
			<?php if($message !== '') 
				echo "<div class=\"message\">" . $message . "</div>"
			?>
			<div id="content">
				<table class="pages">
					<thead>
						<th>ID</th>
						<th>Position</th>
						<th>Visible</th>
						<th>Name</th>
						<th>View</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<?php foreach($pages as $page){ ?>
						<tr>
							<td><?php echo $page['id'] ?></td>
							<td><?php echo $page['position'] ?></td>
							<td><?php echo $page['visible'] == '1'? 'true': 'false' ?></td>
							<td><?php echo $page['menu_name'] ?></td>
							<td><a href="<?php echo get_url_for('/staff/pages/show.php') . '?id=' . $page['id'] ?>">View</a></td>
							<td><a href="<?php echo get_url_for('/staff/pages/edit.php') . '?id=' . $page['id'] ?>">Edit</a></td>
							<td><a href="<?php echo get_url_for('/staff/pages/delete.php') . '?id=' . $page['id'] ?>">Delete</a></td>
						</tr>					
					<?php } ?>
				</table>
			</div>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>