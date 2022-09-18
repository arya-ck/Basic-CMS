<?php	
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];	
	
	// get page details
	$page = find_page_by_id($db, $id);

	// get subject
	$subject_id = get_subject_by_page_id($db, $id);
	
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="View Page" ?>
		<?php $prev_page="/staff/subjects/show.php?id=" . $subject_id ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<table class="form">
				<tr>
					<th>ID</th>
					<td><?php echo htmlspecialchars($page['id']) ?></td>
				</tr>
				<tr>
					<th>Position</th>
					<td><?php echo htmlspecialchars($page['position']) ?></td>
				</tr>
				<tr>
					<th>Name</th>
					<td><?php echo htmlspecialchars($page['menu_name']) ?></td>
				</tr>
				<tr>
					<th>Visible</th>
					<td><?php echo htmlspecialchars($page['visible']) == '1'? 'true': 'false' ?></td>
				</tr>
				<tr>
					<th>Content</th>
					<td><?php echo sanitize_html($page['content']) ?></td>
				</tr>
			</table>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>