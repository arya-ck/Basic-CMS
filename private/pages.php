<?php

	// find all pages of a subject
	function find_all_pages($db, $options=[]){
		$visible = $options['visible'] ?? false;		
		$query = "select id, menu_name, position, visible from pages"
		. ($visible? " where visible=1": "" ) . " order by position";
		$resultset = mysqli_query($db, $query);
		$resultset = mysqli_query($db, $query);
		$page_count = mysqli_num_rows($resultset);
	
		$pages = array();
	
		for($i = 0; $i < $page_count; $i++){
			$page = mysqli_fetch_assoc($resultset);
			$pages[] = $page;
		}
		mysqli_free_result($resultset);
		return $pages;
	}

    // find all pages of a subject
    function find_all_pages_by_subject_id($db, $id, $options=[]){
		$visible = $options['visible'] ?? false;		
		$query = "select id, menu_name, position, visible from pages where subject_id = " . (integer)$id 
		. ($visible? " and visible=1": "" ) . " order by position";
		$resultset = mysqli_query($db, $query);
		$page_count = mysqli_num_rows($resultset);
		$pages = array();
	
		for($i = 0; $i < $page_count; $i++){
			$page = mysqli_fetch_assoc($resultset);
			$pages[] = $page;
		}
		mysqli_free_result($resultset);
		return $pages;
	}

    // get page using id
    function find_page_by_id($db, $id, $options=[]){
		$visible = $options['visible'] ?? false;		
		$query = "select id, menu_name, position, visible, content from pages where id = " . (integer)$id 
		. ($visible? " and visible=1": "" ) . "";
		$resultset = mysqli_query($db, $query);
		$page = mysqli_fetch_assoc($resultset);
		mysqli_free_result($resultset);
		return $page;
	}

    // get page content using id
    function get_content_by_id($db, $id, $options=[]){
		$page = find_page_by_id($db, $id, $options);
		return $page? sanitize_html($page['content']): "<h3>Access denied!!!</h3>";
	}
	
    // get first page of subject
	function get_first_page_by_subject_id($db, $id, $options=[]){
		$visible = $options['visible'] ?? false;
		$query = "select id, menu_name, position, visible, content from pages where subject_id = " . (integer)$id 
		. ($visible? " and visible=1": "" ) . " order by position";
		$resultset = mysqli_query($db, $query);
		$page = mysqli_fetch_assoc($resultset);
		mysqli_free_result($resultset);
		return $page['id'];
	}

    // create a page
    function create_page($db, $menu_name, $position, $visible, $content, $subject_id){
        $query = "insert into pages(menu_name, position, visible, content, subject_id) values('" 
		. $menu_name . "', " . $position . ", " . (integer)($visible=='on') . ", '" 
		. mysqli_real_escape_string($db, $content) . "', " . $subject_id . ")";
		$resultset = mysqli_query($db, $query);
		return $resultset;
    }

    // delete page from database
    function delete_page($db, $id){
        $query = "delete from pages where id=" . (integer)$id;
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }

    // update page in database
    function update_page($db, $id, $menu_name, $pos, $visible){
        $query = "update pages set menu_name='". htmlspecialchars($menu_name) 
        . "', position=" . (integer)$pos . ", visible=" . (integer)($visible=='on') 
        . ", content='" . mysqli_real_escape_string($db, $content) 
        . "'" . " where id=" . (integer)$id;
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }
?>