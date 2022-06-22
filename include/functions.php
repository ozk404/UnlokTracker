<?php

session_start(); 

/*************************************************************
 * Database functions
 ************************************************************/

# Database connection function 
function dbConnect()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "unlok_tracking";

    $conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed.");
    return $conn;
}


/*************************************************************
 * User functions
 ************************************************************/

# Create / Register new user
function create_new_user($email, $password)
{
    $conn = dbConnect();
    $sql = "INSERT INTO users (email, pass) VALUES ('$email',  '$password')";
    $result = mysqli_query($conn, $sql);
    return $result;
}


# Get User ID by the email saved session:
function get_user_id($email)
{
    $conn = dbConnect();
    $sql = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total > 0) {
        return mysqli_fetch_array($result)['id'];
    } else {
        return false;
    }

}


#Check if the user is loged in (validate the session)
function check_user_logedin(){
    if (isset($_SESSION['user_email'])) {
        return true;
      } else {
        return false;
      }
}


# Check if mail already exists
function mail_exists($email)
{
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total > 0) {
        return true;
    } else {
        return false;
    }

}



/*************************************************************
 * Login functions
 ************************************************************/

# Force back to login
function back_to_login(){
    header("Location: index.php");
    die();
}

# Force go to the dashboard
function force_login(){
    header("Location: dashboard.php");
    die();
}


# Check if credentials exists and match in the database
function check_login_credentials($email, $pass){
    $conn = dbConnect();
    $sql = "SELECT * FROM users WHERE email='$email' and pass='$pass'";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total > 0) {
        return true;
    } else {
        return false;
    }

}



/*************************************************************
 * Tasks functions
 ************************************************************/

 # Create a new Task
function create_new_task($name, $description, $minutes, $date)
{
    $conn = dbConnect();
    $user_id = get_user_id($_SESSION['user_email']);
    $sql = "INSERT INTO tasks (title, description, date_creation, minutes, user_id) VALUES ('$name',  '$description', '$date', $minutes, $user_id)";
    $result = mysqli_query($conn, $sql);
    return $result;
}

# Edit a task
function edit_task($id, $name, $description, $minutes, $date){
    $conn = dbConnect();
    $sql = "UPDATE tasks SET title = '$name', description= '$description',  date_creation= '$date', minutes= $minutes WHERE id= $id;";
    $result = mysqli_query($conn, $sql);
    return $result;

}

#Delete a Task
function delete_task($id){
    $conn = dbConnect();
    $sql = "DELETE FROM tasks WHERE id=$id;";
    $result = mysqli_query($conn, $sql);
    return $result;

}


?>


