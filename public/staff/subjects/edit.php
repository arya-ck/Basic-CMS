<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();	

	$errors = array();
	
	$id = $_GET['id'];
	$menu_name = '';
	$pos = '';
	$visible = '';
	
	//echo htmlspecialchars($id);
	
	
	if(!isset($id)){
		header("Location: " . get_url_for("/staff/subjects/index.php"));
	} else if($_SERVER["REQUEST_METHOD"] == "POST"){
		$menu_name=$_POST['name'];
		$pos = $_POST['position'];
		$visible = $_POST['visible'] ?? 0;
		$errors = validate_subject($menu_name, $position, $visible);
		
		if(count($errors) < 1){
			$resultset = update_subject($db, $id, $menu_name, $pos, $visible);
			
			if($resultset){
				set_message('Successfully saved Subject ' . $menu_name);
				header("Location: " . get_url_for("/staff/subjects/index.php"));
			} else {
				echo mysqli_error($db);
				db_disconnect($db);
				exit;
			}
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
		<?php $page_title="Edit Subject" ?>
		<?php $prev_page="/staff/subjects/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div id="content"  class="admin-container">
			<?php foreach($errors as $error) { 
				echo "<div class='error'>" . $error ."</div>";
			}?>
			<form action="" method="POST">
				<table class="form">
					<tr>
						<th>
							<label for="name">Name *</label>
						</th>
						<th>
							<input type="text" name="name" value="<?php echo $menu_name ?>" />
						</th>
					</tr>
					<tr>
						<th>
							<label for="position">Position *</label>
						</th>
						<th>
							<input type="number" name="position" value="<?php echo $pos ?>" />
						</th>
					</tr>
					<tr>
						<th>
							<label for="visible">Visible</label>
						</th>
						<th>
							<input type="checkbox" name="visible" <?php if($visible==1) echo "checked" ?> />
						</th>
					</tr>
				</table>
				<input type="submit" value="Save" />
			</form>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>