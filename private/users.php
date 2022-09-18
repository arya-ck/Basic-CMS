<?php

    // find all users
    function find_all_users($db){
        $query = "select id, first_name, last_name, email, username, hashed_password from admins";
        $resultset = mysqli_query($db, $query);
        $page_count = mysqli_num_rows($resultset);
        $users = array();
		for($i = 0; $i < $page_count; $i++){
            $user = mysqli_fetch_assoc($resultset);
			$users[] = $user;
		}
        mysqli_free_result($resultset);
        return $users;
    }

    // find user by username
    function find_user_by_username($db, $username){
        $query = "select id, first_name, last_name, email, username, hashed_password "
        . "from admins where username = '" . mysqli_real_escape_string($db, $username) . "'";
        $resultset = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($resultset);
        mysqli_free_result($resultset);
        return $user;
    }

    // find user by username
    function find_user_by_id($db, $id){
        $query = "select id, first_name, last_name, email, username, hashed_password "
        . "from admins where id=" . (integer)$id;
        $resultset = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($resultset);
        mysqli_free_result($resultset);
        return $user;
    }

    // login user and regenerate session id
    function login_user($db, $user){
        session_regenerate_id();
        $_SESSION['userid']=$user['id'];
        $_SESSION['lastlogin']=time();
        $_SESSION['username']=$user['username'];
    }

    // logout user and update session
    function log_out_user() {
        unset($_SESSION['userid']);
        unset($_SESSION['lastlogin']);
        unset($_SESSION['username']);
    }

    // check if user is logged in
    function is_logged_in() {
        return isset($_SESSION['userid']);
    }

    // redirect to login page, if not logged in
    function require_login() {
        if(!is_logged_in()) {
        header("Location: " . get_url_for('/staff/login.php'));
        } else {
        // Do nothing
        }
    }

    // create new user
    function create_user($db, $first_name, $last_name, $email, $username, $password){
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "insert into admins(first_name, last_name, email, username, hashed_password) values('" 
		. $first_name . "', '" . $last_name . "', '" . $email . "', '" 
		. $username . "', '" . $password_hash . "')";
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }

    // delete user from database
    function delete_user($db, $id){
        $query = "delete from admins where id=" . (integer)$id;
        $resultset = mysqli_query($db, $query);
        return $resultset;    
    }

    // update user in database
    function update_user($db, $first_name, $last_name, $email, $username, $password){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
		$query = "update admins set "
		. "first_name='" . $first_name 
		."', last_name='" . $last_name
		."', email='" . $email
		."', username='". $username
		."', hashed_password='" . $password_hash . "' where id = " . (integer)$id;
		$resultset = mysqli_query($db, $query);
        return $resultset;
    }
?>