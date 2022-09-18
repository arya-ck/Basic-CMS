<?php

    // find all subjects
    function find_all_subjects($db, $options=[]){
        $visible = $options['visible'] ?? false;		
        $query = "select id, menu_name, position, visible from subjects ". ($visible? "where visible=1": "" ) . " order by position";
        $resultset = mysqli_query($db, $query);
        $page_count = mysqli_num_rows($resultset);
        $subjects = array();
		for($i = 0; $i < $page_count; $i++){
			$subject = mysqli_fetch_assoc($resultset);
			$subjects[] = $subject;
		}
        mysqli_free_result($resultset);
        return $subjects;
    }

    // find all subjects
    function find_subject_by_id($db, $id, $options=[]){
        $visible = $options['visible'] ?? false;		
        $query = "select id, menu_name, position, visible from subjects "
        . ($visible? "where visible=1": "" ) . " where id=" .  (integer)$id
        ." order by position";
        $resultset = mysqli_query($db, $query);
        $subject = mysqli_fetch_assoc($resultset);
        mysqli_free_result($resultset);
        return $subject;
    }

    // find subject which has page, by id
    function get_subject_by_page_id($db, $id, $options=[]){
		$visible = $options['visible'] ?? false;	
		$query = "select id, subject_id from pages where id = " . (integer)$id . ($visible? " and visible=1": "" ) . "";
		$resultset = mysqli_query($db, $query);
		$page = mysqli_fetch_assoc($resultset);
        mysqli_free_result($resultset);
		return $page['subject_id']?? '';
	}

    // create a subject
    function create_subject($db, $menu_name, $position, $visible){
		$query = "insert into subjects(menu_name, position, visible) values('" 
			. $menu_name . "', " . $position . ", " . (integer)($visible=='on') 
		. ")";
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }

    // delete subject & child pages from database
    function delete_subject($db, $id){
        $query = "delete from pages where subject_id=" . (integer)$id;
		$resultset = mysqli_query($db, $query);
        $query = "delete from subjects where id=" . (integer)$id;
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }

    // update subject in database
    function update_subject($db, $id, $menu_name, $pos, $visible){
        $query = "update subjects set menu_name='"
        . htmlspecialchars($menu_name) . "', position=" . (integer)$pos 
        . ", visible=" . (integer)($visible=='on') . " where id=" . (integer)$id;
		
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }
?>