<?php require 'dbconnect.php';





?>

<nav class=" sticky-top navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NITMAS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
  </div>
  <?php
        session_start();
        if (isset($_SESSION['logedin'])) {
          echo '
    
  <p class="text-light my-2 mx-2">Welcome ' . $_SESSION['neckname'] . ' </p>
<button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="button" name ="logoutbtn"class="btn btn-primary" data-toggle="modal" data-target="#logoutbtn">
  <a href="partials/logout.php" class="text-decoration-none text-light">Logout</a>
</button>


</div>
</nav>';

        } else {
          echo '

<button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="button" name ="signupbtn"class="btn btn-primary" data-toggle="modal" data-target="#signupbtn">
<a class="text-success text-decoration-none " href="partials/signup.php">Signup</a>

</button>
<div class="btn-group">
  <button type="button" class="btn btn-outline-success">Login</button>
  <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="partials/studentLogin.php">Student </a>
    <a class="dropdown-item" href="partials/teacherLogin.php">Teacher </a>
    
  </div>
</div>



  
</div>
</nav>';
        }


        if (isset($_GET['success']) == 'true') {

          echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Successfully Registered!</strong> You have been registered.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        } else if (isset($_GET['Loginsuccess'])) {
          echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Login Succcessfull!</strong> You are logged in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        } else if (isset($_GET['error'])) {
          echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Login Failed!</strong> Invalid Credentials.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';


        }

        ?>