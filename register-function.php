<?php 
include "include/functions.php";


if ( isset($_POST["register_email"]) && isset($_POST["register_pass"])) {

        if (mail_exists($_POST["register_email"]) == false){
            
            if ( create_new_user($_POST["register_email"], $_POST["register_pass"]) ){
                $_SESSION['user_email'] = $_POST["register_email"];
                force_login();
            } 
            else{
                header("Location: register.php?error");
            }
            
        }else{
            header("Location: register.php?error=email");
            die();
            }

}else{        
        header("Location: register.php");
        die();  
    }
       



?>