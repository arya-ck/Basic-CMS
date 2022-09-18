<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];
	
	// get subject details	
	$subject = find_subject_by_id($db, $id);

	// get all pages of subject
	$pages = find_all_pages_by_subject_id($db, $id);

	$message = get_message_for_display();
?>

<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="View Subject" ?>
		<?php $prev_page="/staff/subjects/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<?php if($message !== '') 
				echo "<div class=\"message\">" . $message . "</div>"
			?>
			<table class="form">
				<tr>
					<th>ID</th>
					<td><?php echo htmlspecialchars($subject['id']) ?></td>
				</tr>
				<tr>
					<th>Name</th>
					<td><?php echo htmlspecialchars($subject['menu_name']) ?></td>
				</tr>
				<tr>
					<th>Position</th>
					<td><?php echo htmlspecialchars($subject['position']) ?></td>
				</tr>
				<tr>
					<th>Visible</th>
					<td><?php echo htmlspecialchars($subject['visible']) == '1'? 'true': 'false' ?></td>
				</tr>
			</table>
			<hr>
			<h3>Pages</h3>
			<a href="<?php echo get_url_for('/staff/pages/create.php?subject_id=' . $subject['id']) ?>">Create New Page</a>
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
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>