<?php

if(isset($_POST['btnlogsubmit'])) {
    
    session_start();
    
    $dbServername   = "127.0.0.1";
    $dbUsername     = "ni578676_1sql2";
    $dbPassword     = "vkeZk5JeDaSdyGQ6";
    $dbName         = "ni578676_1sql2";
    
    $link = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    
    if(empty($username) || empty($password)) {
        header("Location: ../login.php?login=empty");
        exit();
    } else {
        
        $query = "SELECT * FROM registeredUsers WHERE username=?;";
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ../login.php?login=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            $resrows = mysqli_num_rows($result);
            
            if($resrows != 1) {
                header("Location: ../login.php?login=wrong");
                exit();
            } else {
                
                if($row = mysqli_fetch_assoc($result)) {
                    
                    $hashedPwdCheck = password_verify($password, $row['password']);
                    
                    if(!$hashedPwdCheck) {
                        header("Location: ../login.php?login=wrong");
                        exit();
                    } elseif($hashedPwdCheck) {
                        
                        $_SESSION['loggedin'] = 1;
                        $_SESSION['username'] = $username;
						$_SESSION['perms'] = $row['perms'];
                        
                        header("Location: ../index.php");
                        exit();                        
                    }                    
                }                
            }
        }        
    }    
}
