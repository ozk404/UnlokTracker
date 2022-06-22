<?php 
include "include/frontend-functions.php";
include "include/functions.php";


if (check_user_logedin() == true) {
    force_login();
  } else {
    create_login_view();
  }



  ###Function to check login credentials an login in the user

  if ( isset($_POST["user_email"]) && isset($_POST["user_pass"])) {

    if ( check_login_credentials( $_POST["user_email"], $_POST["user_pass"]) ) {
        $_SESSION['user_email'] = $_POST["user_email"];
        header("Location: dashboard.php");
        die();
    }else{
        create_alert('error', 'Login Failed', 'The email and pass mistmatch.');
    }
}

?>



<?php 
function create_login_view(){
echo '<head> '.getHead('Index').'</head>';
echo '<body  style="background-color: #4142e3;">
<section class="">
  <div class="container ">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 justify-content-center align-self-center">
              <img src="include/images/unlok.jpg"
                alt="login form" class="img-fluid " />
            </div> 
            
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="index.php" method="POST">

                  <h2 class="fw-normal" style="letter-spacing: 1px; color: #4142e3;">Welcome to Unlok Tracker!</h2>
                  <p>The best time tracker app!</p>
                  <hr style="color: #4142e3;">
                  <h5 class="fw-normal mb-3 pb-3" >Sign into your account</h5>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="user_email">Email address:</label>
                    <input type="email" name="user_email" id="user_email" required class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="user_pass">Password:</label>
                    <input type="password" name="user_pass" id="user_pass" required class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Login</button>
                    </div>  
                </div>
                    <hr style="color: #4142e3;">
                    <br>
                  <h5  style="color: #4142e3;">Don t have an account? <a href="register.php"
                      style="color: #4142e3;">Register here</a></h5>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>';


}



?>



