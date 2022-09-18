<?php

    function value_is_present($value){
        return isset($value) && $value!='';
    }

    // validate page
    function validate_page($menu_name, $position, $visible, $content, $subject_id){
        $errors = array();
        if(!value_is_present($menu_name) || !value_is_present($position) || !value_is_present($visible) ||
        !value_is_present($content) || !value_is_present($subject_id)){
            $errors[] = 'Please enter values for all fields';
        }

        return $errors;
    }

    // validate subject
    function validate_subject($menu_name, $position, $visible){
        $errors = array();
        if(!value_is_present($menu_name) || !value_is_present($position) || !value_is_present($visible) ||
        !value_is_present($content) || !value_is_present($subject_id)){
            $errors[] = 'Please enter values for all fields';
        }

        return $errors;
    }

    // validate password
    function validate_password($password){
        if(strlen($password) < 8){
            return false;
        }

        if(!preg_match('/[0-9]+/', $password)){
            return false;
        }

        if(!preg_match('/[A-Z]+/', $password)){
            return false;
        }

        return true;
    }

    // validate user
    function validate_user($first_name, $last_name, $email, $username, $password){
        $errors = array();
        if(!value_is_present($first_name) || !value_is_present($last_name) || !value_is_present($username) ||
        !value_is_present($password)){
            $errors[] = 'Please enter values for all fields';
        }

        if(!validate_password($password)){
            $errors[] = 'Password must be minimum 8 charcters long with at least 1 uppercase character & 1 number';
        }

        return $errors;
    }
?>