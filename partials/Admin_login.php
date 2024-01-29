<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin_login.css">
  </head>
  <body>
  <?php
                session_start();
                require 'dbconnect.php';
                $login = false;
                $admin = false;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $username = $_POST['username'];
                  $password = $_POST['password'];


                  $sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
                  $result = mysqli_query($conn, $sql);
                  $num = mysqli_num_rows($result);
                  if($num>0){

                  
                  if (!$login) {
                    while ($row = mysqli_fetch_assoc($result)) {

                      if ($password==$row['password']) {
                        $login = true;
                        session_start();
                        $_SESSION['logedin'] = true;
                        $_SESSION['admin']= true;
                        $_SESSION['neckname'] = $row['username'];
                        header('location: /project/index.php?Loginsuccess=true');

                      } else {
                        $error = "Invalid Password";

                        header("location: /project/index.php?error= ".$error ." ");
                      }
                    }
                  }
                }else{
                    $error = "User doesn't exists!";
                    header('location: /project/index.php?error='.$error.'');
                }

                }
                ?>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form  action="Admin_login.php" method="post" >
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" class="form-control" i>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-12 d-flex justify-content-center login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>