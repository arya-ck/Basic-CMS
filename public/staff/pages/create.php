<?php
	require_once('../../../private/initialize.php');

	// validate if user logged in session
	require_login();
	
	// get subject id
	$subject_id=$_GET['subject_id'];

	// all subjects
	$subjects = find_all_subjects($db);

	$errors = array();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$menu_name = $_POST['menu_name'];
		$position = $_POST['position'];
		$visible = $_POST['visible'] ?? "0";
		$content = $_POST['content'];

		$errors = validate_page($menu_name, $position, $visible, $content, $subject_id);
		if(count($errors) < 1){
			$resultset = create_page($db, $menu_name, $position, $visible, $content, $subject_id);
			if($resultset){
				set_message('Successfully added Page ' . $menu_name);
				header("Location: " . get_url_for("/staff/subjects/show.php?id=" . $subject_id ));
			} else {
				echo mysqli_error($db);
				db_disconnect($db);
				exit;
			}
		}
	}
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<?php $page_title="Create Page" ?>
		<?php $prev_page="/staff/subjects/show.php?id=" . $subject_id ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content" class="admin-container">
			<?php foreach($errors as $error) { 
				echo "<div class='error'>" . $error ."</div>";
			}?>
			<form action="" method="POST" id="create-page">
				<table class="form">
					<tr>
						<th>Name *</th>
						<th>
							<input type="text" name="menu_name" />
						</th>
					</tr>
					<tr>
						<th>Position *</th>
						<th>
							<input type="number" name="position" />
						</th>
					</tr>
					<tr>
						<th>Visible</th>
						<th>
							<input type="checkbox" name="visible" />
						</th>
					</tr>
					<tr>
						<th>Subject *</th>
						<th>
							<select name="subject_id" form="create-page" disabled>
								<?php foreach($subjects as $subject) { ?>
									<option value="<?php echo $subject['id']; ?>" <?php if($subject['id']==$subject_id) { echo "selected";} ?> ><?php echo $subject['menu_name']; ?></option>
								<?php } ?>
							</select>
						</th>
					</tr>
					<tr>
						<th>Content *</th>
						<th>
							<textarea name="content" rows=20 cols=100 ></textarea>
						</th>
					</tr>
				</table>
				<input type="submit" value="Save" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>