<?php
	
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];
	
	// get subject
	$subject_id = get_subject_by_page_id($db, $id);
	
	if(!isset($id)){
		header("Location: ./index.php");
	} else if($_SERVER["REQUEST_METHOD"] == "POST"){
		$resultset = delete_page($db, $id);

		if($resultset){
			set_message('Successfully deleted Page');
			header("Location: " . get_url_for("/staff/subjects/show.php?id=") . $subject_id);
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	} else {
		$page = find_page_by_id($db, $id);
		$menu_name=$page['menu_name'];
		$pos = $page['position'];
		$visible = $page['visible'];
		$content = $page['content'];
	}
?>

<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Delete Page" ?>
		<?php $prev_page="/staff/subjects/show.php?id=" . $subject_id ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<form action="" method="POST">
				<table class="form">
					<tr>
						<th>Name</th>
						<th><?php echo $menu_name ?></th>
					</tr>
					<tr>
						<th>Position</th>
						<th><?php echo $pos ?></th>
					</tr>
					<tr>
						<th>Visible</th>
						<th><?php if($visible==1) echo "checked" ?></th>
					</tr>
					<tr>
						<th>Content</th>
						<th><?php echo htmlspecialchars($content) ?></th>
					</tr>
				</table>
				<input type="submit" value="Delete" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>