<?php
	
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];	
	
	if(!isset($id)){
		header("Location: ./index.php");
	} else if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_POST['id'] ?? $id;
		$resultset = delete_subject($db, $id);
		
		if($resultset){
			set_message('Successfully deleted Subject ');
			header("Location: " . get_url_for("/staff/subjects/index.php"));
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	} else {		
		$subject = find_subject_by_id($db, $id);
		$menu_name=$subject['menu_name'];
		$pos = $subject['position'];
		$visible = $subject['visible'];
	}
?>

<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Delete Subject" ?>
		<?php $prev_page="/staff/subjects/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<form action="<?php echo get_url_for('/staff/subjects/delete.php?id=' . $id); ?>" method="POST">
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
				
				<input type="submit" value="Delete" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>