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

<?php

require 'dbconnect.php';

$login = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['email'];
    $password = $_POST['pass'];
    
   

    // checking for duplicate username

    $sql = "SELECT * FROM `student` WHERE `email` = '$username'";
    $result = mysqli_query($conn,$sql);
if(!$login){
    while($row=mysqli_fetch_assoc($result)){
           
        if(password_verify($password,$row['password']))  {
            $login = true;
            session_start();
            $_SESSION['logedin']=true;
            $_SESSION['user'] = $username;
            $_SESSION['neckname'] = $row['f_name'];
            header('location: /project/index.php?Loginsuccess=true');
            
        }
        else{
          
            header("location: /project/index.php?error=true");
        }

    
        



    }
}
}

?>




<body>
    <section class="   bg-image" 
    style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center gradient-custom-3 h-100">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center ">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">Login to your account</h2>
  
                <form action="studentLogin.php" method="post">
  
                 

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Your Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" />
                    
                  </div>
  
                  <div class="form-outline mb-4">
                    <label class="form-label" for="pass">Password</label>
                    <input type="password" id="pass" name = " pass" class="form-control form-control-lg" />
                    
                  </div>
  

  
                 
  
                  <div class="d-flex justify-content-center">
                    <button type="submit"
                      class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                  </div>
  
                  <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="signup.php"
                      class="fw-bold text-body"><u>Signup here</u></a></p>
  
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