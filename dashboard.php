<?php 
include "include/frontend-functions.php";
include "include/functions.php";



if (check_user_logedin() == true) {
  create_dashboard_view();
} else {
  back_to_login();
}


#Check validations to show an alert

if (isset($_GET['success'])){
    create_alert('success', 'New Task added!', 'The task has been created succesfuly!.');
}
else if (isset($_GET['success2'])){
  create_alert('success', 'Task Updated!', 'The task has been updated succesfuly!.');
}
else if (isset($_GET['success3'])){
  create_alert('success', 'Task Deleted!', 'The task has been deleted succesfuly!.');
}
else if (isset($_GET['error'])) {
    create_alert('error', 'Error!', 'An error ocurred, try again later..');
}



function create_dashboard_view(){
  echo '<head>'.getHead('Dashboard').'</head>';
    echo '<body>'.getNavBar().
    '<section class="">

    <div class="container ">

    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <br><br>
        <div style="text-align: center;">
        <h2>Welcome <br>'. $_SESSION['user_email'].'</h2>
        <p>What do you want to do? Select an option:</p>
        <br>
        <div class="d-grid gap-2">
    <hr>
        <a href="tasks.php" class="btn btn-primary">See all Tasks!</a>
        <button class="btn btn-secondary" data-bs-toggle="modal" onclick="clearInput("#task-date-select")"  data-bs-target="#task-date-select" type="button">See tasks in date range</button>
    <hr>
    <button class="btn btn-primary" data-bs-toggle="modal" onclick="clearInput("#newTaskModal")" data-bs-target="#newTaskModal" type="button">Create new task</button>
    <button class="btn btn-secondary" data-bs-toggle="modal" onclick="clearInput("#TaskEditModal")"  data-bs-target="#TaskEditModal" type="button">Edit a Task</button>
    <button class="btn btn-danger" data-bs-toggle="modal" onclick="clearInput("#deleteTaskModal")"  data-bs-target="#deleteTaskModal" type="button">Delete a Task</button>
    <hr>
    <a href="logout.php" class="btn btn-secondary">Logout</a>
    <hr>
    </div>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>


    </div>

    </section>

    <!-------- Modal Section ---------->

    <!-- New Task Modal -->

    <div class="modal fade" class="modal" id="newTaskModal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="newTaskModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Task!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="new-task.php" method="POST">
            <div class="mb-3">
              <label for="new-task-name" class="col-form-label">Task Name:</label>
              <input type="text" class="form-control" name="new-task-name" required id="new-task-name">
            </div>
            <div class="mb-3">
              <label for="new-task-description" class="col-form-label">Task description:</label>
              <textarea class="form-control" required name="new-task-description" id="new-task-description"></textarea>
            </div>
            <div class="mb-3">
              <label for="new-task-description" class="col-form-label">Task date :</label>
              <input data-format="dd/MM/yyyy"  required name = "new-task-date" type="date"></input>
            </div>
            <div class="mb-3">
              <label for="new-task-minutes" class="col-form-label">Task time to complete (minutes):</label>
              <input type="number"  min="0" required class="form-control" name="new-task-minutes"  id="new-task-minutes"></input>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
        </form>
      </div>
    </div>
    </div>
    <!--------------------------------------------------------------------------------------->


    <!-- Edit Task Modal -->

    <div class="modal fade" id="TaskEditModal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="TaskEditModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Task!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="edit-task.php" method="POST">
            <p>To edit a task, you first need to now Task ID, you can see ID in the task"s list: <a href="tasks.php" >see all tasks!</a></p>
            <hr>
          <div class="mb-3">
              <label for="task-id" class="col-form-label">Task ID:</label>
              <input type="number"  min="0" required class="form-control" name="task-id"></input>
            </div>
            <hr>
            <div class="mb-3">
              <label for="task-name" class="col-form-label">Task Name:</label>
              <input type="text" class="form-control" required name="task-name">
            </div>
            <div class="mb-3">
              <label for="task-description" class="col-form-label">Task description:</label>
              <textarea class="form-control" required name="task-description"></textarea>
            </div>
            <div class="mb-3">
            <label for="new-task-description" class="col-form-label">Task date :</label>
            <input data-format="dd/MM/yyyy"  required name = "task-date" type="date"></input>
          </div>
            <div class="mb-3">
              <label for="task-minutes" class="col-form-label">Task time to complete (minutes):</label>
              <input type="number"  min="0" required class="form-control" name="task-minutes"></input>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>
    </div>
    <!--------------------------------------------------------------------------------------->


    <!-- Delete Task Modal -->

    <div class="modal fade" id="deleteTaskModal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="deleteTaskModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Task!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>To edit a task, you first need to now Task ID, you can see ID in the task"s list: <a href="tasks.php" >see all tasks!</a></p>
            <hr>
            <form action="delete-task.php" method="POST">
          <div class="mb-3">
              <label for="delete-task-id" class="col-form-label">Task ID:</label>
              <input type="number"  min="0" required class="form-control" name="delete-task-id"></input>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        </form>
      </div>
    </div>
    </div>
    <!--------------------------------------------------------------------------------------->



    <!-- Task Date Modal -->

    <div class="modal fade" id="task-date-select" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="task-date-select" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Search Task!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <hr>
            <form action="tasks.php" method="POST">
          <div class="mb-3">
              <label for="delete-task-id" class="col-form-label">Start date::</label>
              <input data-format="dd/MM/yyyy"  required name = "date-compare-1" type="date"></input>
              <label for="delete-task-id" class="col-form-label">End date::</label>
              <input data-format="dd/MM/yyyy"  required name = "date-compare-2" type="date"></input>

              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
        </form>
      </div>
    </div>
    </div>
    <!--------------------------------------------------------------------------------------->



    <!-- Function to clear Modal -->

    <script>
    function clearInput (modal) {
      $(modal).find("form")[0].reset();
    };
    </script>'.
    '</body>';
    }

?>

