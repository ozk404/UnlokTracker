<?php 
include "include/functions.php";


if (check_user_logedin() == false) {
    back_to_login();
  }

if (isset($_POST['task-minutes']) && isset($_POST['task-name'])  && isset($_POST['task-description'])  && isset($_POST['task-id']) ){
    $minutes =  (is_numeric($_POST['task-minutes']) ? (int)$_POST['task-minutes'] : 0);
    $new_task =  edit_task($_POST['task-id'], $_POST['task-name'],$_POST['task-description'], $minutes, $_POST['task-date']);
    if($new_task) {
        header("Location: dashboard.php?success2");
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