<?php
    function require_login($redirect = "login.php"){
        session_start();
        if (!isset($_SESSION['session_token']) || empty($_SESSION['session_token'])) {
            header("Location: ".$redirect);
        }
    }

    function logout(){
        session_start();
        unset($_SESSION['session_token']);
    }

    function login_redirect($username, $password, $redirect): bool{
        session_start();

        //Change this if database will be available
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['session_token'] = bin2hex(random_bytes(256));
            header("Location: ".$redirect);
            return true; //this return should never be reached
        }
    
        return false;
    }

    function login($username, $password): bool{
        session_start();

        //Change this if database will be available
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['session_token'] = bin2hex(random_bytes(256));
            return true; //this return should never be reached
        }
    
        return false;
    }
?>