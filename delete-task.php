<?php 
include "include/functions.php";


if (check_user_logedin() == false) {
    back_to_login();
  }

if (isset($_POST['delete-task-id']) ){
    $new_task =  delete_task($_POST['delete-task-id']);
    if($new_task) {
        header("Location: dashboard.php?success3");
        die();
    }else{
        header("Location: dashboard.php?error");
        die();
    }

}else{
    header("Location: dashboard.php");
    die();
}



?>