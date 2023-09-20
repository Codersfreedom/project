<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="\project\css\login.css">


    <title>Student Login Page</title>
</head>

<body>
  <?php 

  // echo $log;
 

  if (isset($_GET['success']) == true) {

    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
<strong>Successfully Registered!</strong> You have been registered.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
  }
  else if(isset($_GET['log'])){
    $log = $_GET['log'];
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong></strong> '.$log.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';

  }
  
  ?>
    <section class=" bg-image"
    style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask  d-flex align-items-center  gradient-custom-3 " >
      <div class="container ">
        <div class="row d-flex justify-content-center align-items-center ">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

<!-- Signup logic -->
<?php  
                require 'dbconnect.php';
                $signup =false;
                $ShowError ='false';
                

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                      $fname = $_POST['fname'];
                      $lname = $_POST['lname'];
                      $roll = $_POST['roll'];
                      $email = $_POST['email'];
                      $pass = $_POST['pass'];
                      $cpass = $_POST['cpass'];
                      
                      // Check if email is already exits
                $existsql = "SELECT * FROM `student` WHERE `email` = '$email'";
                $existresult = mysqli_query($conn, $existsql);
                $num = mysqli_num_rows($existresult);
                if ($num > 0) {
                    $ShowError= "Email id already exists";
                    header("location: signup.php?log=' .$ShowError. '");
                }
                else{

                      if($pass == $cpass){

                        $hash = password_hash($pass,PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `student`( `f_name`, `l_name`, `roll`, `email`, `password`) VALUES ('$fname','$lname','$roll','$email','$hash')";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                          $signup =true;
                          header("location: /project/index.php?success=' .$signup. '");
                          exit;
                        }
                        else{
                          $ShowError = "Invalid Credentials";
                          header("location: signup.php?log=' .$ShowError. '");
                        }
                      }
                      else{
                        $ShowError ="Password Doesn't match";
                        header("location: signup.php?log=' .$ShowError. '");
                      }


                }
                     
                     


                }

                
                ?>
               
                <form  action="signup.php" method="post">
  
                  <div class="form-outline mb-4">
                  <label class="form-label" for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" class="form-control form-control-lg" required />
                   
                  </div>
                  <div class="form-outline mb-4">
                  <label class="form-label" for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" class="form-control form-control-lg"  />
                    
                  </div>
                  <div class="form-outline mb-4">
                  <label class="form-label" for="roll">Roll No.</label>
                    <input type="number" id="roll" name="roll" class="form-control form-control-lg" required />
                    
                  </div>
  
                  <div class="form-outline mb-4">
                  <label class="form-label" for="email">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                    
                  </div>
  
                  <div class="form-outline mb-4">
                  <label class="form-label" for="pass">Password</label>
                    <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />
                    
                  </div>
  
                  <div class="form-outline mb-4">
                  <label class="form-label" for="cpass">Repeat your password</label>
                    <input type="password" id="cpass" name="cpass" class="form-control form-control-lg" required/>
                    
                  </div>
  
                 
  
                  <div class="d-flex justify-content-center">
                    <button type="submit"
                      class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                  </div>
  
                  <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="studentLogin.php"
                      class="fw-bold text-body"><u>Login here</u></a></p>
  
                </form>
           
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>