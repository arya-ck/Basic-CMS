<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();
	
	$id = $_GET['id'];
	$subject_id = get_subject_by_page_id($db, $id);
	$menu_name = '';
	$pos = '';
	$visible = '';
	$content = '';	

	$errors = array();
	
	//echo htmlspecialchars($id);
	
	if(!isset($id)){
		header("Location: ./index.php");
	} else if($_SERVER["REQUEST_METHOD"] == "POST"){
		$menu_name=$_POST['name'];
		$pos = $_POST['position'];
		$visible = $_POST['visible'];
		$content = $_POST['content'];

		$errors = validate_page($menu_name, $position, $visible, $content, $subject_id);
		
		if(count($errors) < 1){
			$resultset = update_page($db, $id, $menu_name, $pos, $visible);
		
			if($resultset){
				set_message('Successfully saved Page ' . $menu_name);
				header("Location: " . get_url_for("/staff/subjects/show.php?id=" . $subject_id));
			} else {
				echo mysqli_error($db);
				db_disconnect($db);
				exit;
			}
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
		<?php $page_title="Edit Page" ?>
		<?php $prev_page="/staff/pages/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<form action="" method="POST">
				<table class="form">
					<tr>
						<th>Name *</th>
						<th>
							<input type="text" name="name" value="<?php echo $menu_name ?>" />
						</th>
					</tr>
					<tr>
						<th>Position *</th>
						<th>
							<input type="number" name="position" value="<?php echo $pos ?>" />
						</th>
					</tr>
					<tr>
						<th>Visible</th>
						<th>
							<input type="checkbox" name="visible" <?php if($visible==1) echo "checked" ?> />
						</th>
					</tr>
					<tr>
						<th>Content *</th>
						<th>
							<textarea name="content" rows=20 cols=100 ><?php echo $content ?></textarea>
						</th>
					</tr>
				</table>
				<input type="submit" value="Save" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>