<?php 
include "include/frontend-functions.php";
include "include/functions.php";


if (check_user_logedin() == true) {
  force_login();
} else {
  create_register_view();
}


#Validate erros to show an alert:

if (isset($_GET['error'])){
  if ($_GET['error'] == 'email'){
    create_alert('error', 'Register Failed', 'This email is already in use.');
  }
  else{
    create_alert('error', 'Register Failed', 'An error ocurred, try again later..');
  }
}



function create_register_view(){
echo '<head>'.getHead('Register').'</head>';
echo '<body  style="background-color: #4142e3;">
<section class="">
  <div class="container ">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">

            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="register-function.php" method="POST">

                  <h2 class="fw-normal" style="letter-spacing: 1px; color: #4142e3;">Register in Unlok Tracker!</h2>
                  <p>Thanks for register in the best time tracker app!</p>
                  <hr style="color: #4142e3;">

                  <div class="form-outline mb-4">
                  <label class="form-label" for="register_email">Email address:</label>
                    <input type="email" name = "register_email" id="register_email" required class="form-control form-control-lg" />
                  </div>



                  <div class="form-outline mb-4">
                  <label class="form-label" for="register_pass">Password:</label>
                    <input type="password" name="register_pass" id="register_pass" required class="form-control form-control-lg" />
                  </div>


                  <div class="pt-1 mb-4">
                    <div class="d-grid gap-2">
                    <button class="btn btn-primary" id="btn-register" type="submit">Register</button>
                    </div>  
                </div>
                    <hr style="color: #4142e3;">
                    <br>
                  <h5 class="" style="color: #393f81;">Already have an account? <a href="index.php"
                      style="color: #393f81;">Login here</a></h5>

                </form>

              </div>
            </div>
            <div class="col-md-6 col-lg-5 justify-content-center align-self-center">
              <img src="include/images/unlok.jpg"
                alt="login form" class="img-fluid " />
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>


';

}

?>


