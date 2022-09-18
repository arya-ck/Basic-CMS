<?php
	require_once('../../../private/initialize.php');
	
	// validate if user logged in session
	require_login();	

	$errors = array();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
        $menu_name=$_POST['menu_name'];
		$position=$_POST['position'];
		$visible=$_POST['visible'] ?? "0";
		$errors = validate_subject($menu_name, $position, $visible);
		
		if(count($errors) < 1){
			$resultset = create_subject($db, $menu_name, $position, $visible);
		
			if($resultset){
				set_message('Successfully added Subject ' . $menu_name);
				header("Location: " . get_url_for("/staff/subjects/index.php"));
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
		<?php $page_title="Create Subject" ?>
		<?php $prev_page="/staff/subjects/index.php" ?>
		<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
		<div class="admin-container">
			<?php foreach($errors as $error) { 
				echo "<div class='error'>" . $error ."</div>";
			}?>
			<div id="content">
				<form action="" method="POST">
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
					</table>
					<input type="submit" value="Save" />
				</form>
			</div>
		</div>
		<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
	</body>
</html>