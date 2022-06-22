<?php 
include "include/functions.php";


if (check_user_logedin() == false) {
    back_to_login();
  }

if (isset($_POST['new-task-minutes']) && isset($_POST['new-task-name'])  && isset($_POST['new-task-description'])){
    $minutes =  (is_numeric($_POST['new-task-minutes']) ? (int)$_POST['new-task-minutes'] : 0);
    $new_task =  create_new_task($_POST['new-task-name'],$_POST['new-task-description'], $minutes, $_POST['new-task-date']);
    if($new_task) {
        header("Location: dashboard.php?success");
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