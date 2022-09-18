<?php $nav_subjects=find_all_subjects($db, array('visible' => true)); ?>
<ul class="subjects">
	<?php foreach($nav_subjects as $nav_subject) { ?>
		<li>
			<?php if($subject_id==$nav_subject['id']){ echo " \/ ";} else { echo " > ";}  ?>
			
			<a href=<?php echo get_url_for("/index.php?subject_id=") . $nav_subject['id']  ?> >
				<?php echo htmlspecialchars($nav_subject['menu_name']); ?>
			</a>
			
			<ul class=<?php if($subject_id==$nav_subject['id']){ echo "pages";} else { echo "pages-collapsed";}  ?>>
			
				<?php $nav_pages=find_all_pages_by_subject_id($db, $nav_subject['id'], array('visible' => true)); ?>
				<?php foreach($nav_pages as $nav_page) { ?>
					<li>
						<a href=<?php echo get_url_for("/index.php?id=") . $nav_page['id']  ?> 
							class=<?php if($page_id==$nav_page['id']){ echo "selected";}  ?> 
						>
							<?php echo htmlspecialchars($nav_page['menu_name']); ?>
						</a>
					</li>
				<?php } ?>
			</ul>	
		</li>
	<?php } ?>
</ul>