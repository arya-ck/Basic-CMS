<header>
	<h1>Globe Bank - Staff Area</h1>
</header>
<h2 style="margin-left:1.5em"><?php echo $page_title ?></h2>
<nav>
	<ul class="menu">
		<li>
			<?php
				if(isset($prev_page)){
					echo '<a href="' . get_url_for($prev_page) . '">&lt;&nbsp;Back</a>
					|';
				}
			?>
			<a href="<?php echo get_url_for('/staff/index.php') ?>">Menu</a>
			|
			<a href="<?php echo get_url_for('/staff/logout.php') ?>">Logout</a>
		</li>
	</ul>
</nav>