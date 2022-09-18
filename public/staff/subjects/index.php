<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$subjects = find_all_subjects($db);
	
	$message = get_message_for_display();
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Subjects" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div class="admin-container">
			<a href="<?php echo get_url_for('/staff/subjects/create.php') ?>">Create New Subject</a>
			<?php if($message !== '') 
				echo "<div class=\"message\">" . $message . "</div>"
			?>
			<div id="content">
				<table class="subjects">
					<thead>
						<th>ID</th>
						<th>Position</th>
						<th>Visible</th>
						<th>Name</th>
						<th>View</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<?php foreach($subjects as $subject){ ?>
						<tr>
							<td><?php echo htmlspecialchars($subject['id']) ?></td>
							<td><?php echo htmlspecialchars($subject['position']) ?></td>
							<td><?php echo htmlspecialchars($subject['visible']) == '1'? 'true': 'false' ?></td>
							<td><?php echo htmlspecialchars($subject['menu_name']) ?></td>
							<td><a href="<?php echo get_url_for('/staff/subjects/show.php') . '?id=' . $subject['id'] ?>">View</a></td>
							<td><a href="<?php echo get_url_for('/staff/subjects/edit.php') . '?id=' . $subject['id'] ?>">Edit</a></td>
							<td><a href="<?php echo get_url_for('/staff/subjects/delete.php') . '?id=' . $subject['id'] ?>">Delete</a></td>
						</tr>					
					<?php } ?>
				</table>
			</div>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>