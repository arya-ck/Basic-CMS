<?php
	require_once('../private/initialize.php');
	
	$page_id = isset($_GET['id'])? $_GET['id']: '';
	$subject_id = get_subject_by_page_id($db, $page_id)?? '';
	
	if($page_id == ''){
		$subject_id = isset($_GET['subject_id'])? $_GET['subject_id']: '';
		if($subject_id != ''){
			$page_id = get_first_page_by_subject_id($db, $subject_id, array('visible' => true));
		}
	}
?>
<html>
	<head>
		<title>GBI</title>
		<link rel="stylesheet" href="<?php echo get_url_for('/stylesheets/gbi.css'); ?>" />
	</head>
	<body>
		<header>
			<h1>Globe Bank</h1>
		</header>
		<div class="body-container">
			<nav>			
				<?php require_once(SHARED_PATH . '/public_nav.php'); ?>
			</nav>
			<div id="content">
				<?php 
					if($page_id != ''){
						$content = get_content_by_id($db, $page_id, array('visible' => true));
						echo $content;
					} else {
						echo '<div id="hero-image">
								<img src="images/page_assets/leadership_469723021.png" width="900" height="200" alt="" />
							</div>
							<div>							
								<div>
									<h4>Globe Bank International (NYSE: GBI), founded in 1950, is one of the newer financial institutions widely active in the world financial market. Despite our youth, we have a history solidly built on hard work, common-sense business practices, empowering investments, and an unyielding dedication to excellence.</h4>
								</div>
								<h2>Board of Directors</h2>
								<ul>
									<li>Robert Otis Bott, President</li>
									<li>Sarah M. Bott</li>
									<li>Alisha Bryan</li>
									<li>Henry Terry</li>
									<li>Meredith Jewel Coffey</li>
									<li>Jesse Gould</li>
									<li>Lea Sheryl Rodriquez</li>
									<li>Joseph Riley</li>
									<li>Martin Stephens</li>
									<li>Jimmie Frank</li>
								</ul>
							</div>';
					}
				?>
			</div>
		</div>
		<footer>
			&copy; <?php echo date('Y') . " Globe Bank International"; ?>
			<?php db_disconnect($db) ?>
		</footer>
	</body>
</html>