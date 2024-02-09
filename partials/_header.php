<?php require 'dbconnect.php';
session_start();

?>

<nav class=" sticky-top navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NITMAS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>

      <?php

      if (isset($_SESSION['admin'])) {
        echo '
 <li class="nav-item">
        <a class="nav-link" href="Admin_panel.php">Admin Panel</a>
      </li>';
      }

      if(isset($_SESSION['faculty'])){
        echo '
        <li class="nav-item">
               <a class="nav-link" href="Faculty_panel.php">Faculty Panel</a>
             </li>';
      }
      ?>


    </ul>
  </div>
  <?php

  if (isset($_SESSION['logedin'])) {
    echo '
    
  <p class="text-light my-2 mx-2">Welcome ' . $_SESSION['neckname'] . ' </p>
<button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="button" name ="logoutbtn"class="btn btn-primary" data-toggle="modal" data-target="#logoutbtn">
  <a href="partials/logout.php" class="text-decoration-none text-light">Logout</a>
</button>


</div>
';

  } else {
    echo '

    
    
<div class="btn-group dropleft">
  <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Login
  </button>
  <div class="dropdown-menu" style="position: absolute; transform: translate3d(-165px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
    <a class="dropdown-item" href="partials/Faculty_login.php">Faculty</a>
    <a class="dropdown-item" href="partials/Admin_login.php">Admin</a>
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
    $error = $_GET['error'];
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Login Failed! </strong> ' .$error.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';


  }

  ?>