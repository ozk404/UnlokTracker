<?php 
include "include/frontend-functions.php";
include "include/functions.php";

if (check_user_logedin() == true) {
  create_tasks_view();
} else {
  back_to_login();
}


function create_tasks_view(){
  echo '<head>';
  getHead('Tasks');
  data_table_scripts();
  echo '</head>';
  echo '<body>';
  getNavBar();
  $user_id = get_user_id($_SESSION['user_email']);
  if ( isset($_POST['date-compare-1']) ){
    $task_sql = "SELECT * FROM tasks WHERE user_id={$user_id} AND date_creation BETWEEN '{$_POST['date-compare-1']}' AND '{$_POST['date-compare-2']}';";
    $data_range_text = "Date range: ".$_POST['date-compare-1']." - ".$_POST['date-compare-2'];
  }else{
    $task_sql = "SELECT * FROM tasks WHERE user_id={$user_id} ORDER BY id DESC";
    $data_range_text = "Showing all tasks in the system";

  }
  
  $conn = dbConnect();
            
  $result = mysqli_query($conn, $task_sql);
  if (mysqli_num_rows($result) > 0) {
    echo '
    <div class="container">
    <div class="row">
    <div class="col">
    </div>
    <div class="col-md-12">
    <br><br>
    <div style="text-align: center;">
    <h2>Hey <br>'. $_SESSION['user_email'].'!</h2>
    <p>Here is all your tasks:</p>
    <p>'.$data_range_text.'</p>
    <br>
    </div>
    <hr>
    <p>Need to export? use this buttons to get a report!</p>
    <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Minutes to complete</th>
                </tr>
            </thead>
            <tbody>
            ';
    while($row = $result->fetch_assoc()) {
              echo "
              <tr>
              <td>".$row["id"]."</td>
              <td>".$row["title"]."</td>
              <td>".$row["description"]."</td>
              <td>".$row["date_creation"]."</td>
              <td>".$row["minutes"]."</td>
              </tr>";
            }
        echo '</tbody>
        </table>
        <br><hr><br>
        </div>
        <div class="col">
        </div>
      </div>
    </div>';

  } else {
    echo "0 results";
  }
  echo '</body>'; 

  echo '
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <script>
$(document).ready(function() {
    $("#example").DataTable( {
        dom: "Bfrtip",
        buttons: [
            "copy", "csv", "excel", "pdf", "print"
        ]
    } );
} );
  </script>


  
  ';
    }

?>

