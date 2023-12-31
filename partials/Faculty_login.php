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


    <title>Faculty login</title>
</head>

<body>
    <section class="vh-100 bg-image"
        style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Login to your account</h2>

                                <?php
                                session_start();
                                require 'dbconnect.php';
                                $login = false;
                                $faculty = false;
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                    $id = $_POST['fac_id'];
                                    $password = $_POST['pass'];


                                    $sql = "SELECT * FROM `faculty_login` WHERE `fac_id` = '$id'";
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);

                                    if ($num > 0) {


                                        if (!$login) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                    $facid = $row['fac_id'];
                                                if ($password == $row['password']) {
                                                    $login = true;
                                                    session_start();
                                                    $sql1 = "select name from faculty join faculty_login on faculty.fac_id = faculty_login.fac_id where faculty_login.fac_id='$id'";
                                                    $Faculty = mysqli_fetch_assoc(mysqli_query($conn,$sql1));

                                                    $_SESSION['logedin'] = true;
                                                    $_SESSION['faculty'] = true;
                                                    $_SESSION['fac_id'] = $id;
                                                    $_SESSION['neckname'] = $Faculty['name'];
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

                                <form action="Faculty_login.php" method="post">



                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="fac_id">Faculty Id</label>
                                        <input type="text" id="fac_id" name="fac_id"
                                            class="form-control form-control-lg" />

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="pass">Password</label>
                                        <input type="password" id="pass" name="pass"
                                            class="form-control form-control-lg" />

                                    </div>





                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Remember this is an admin login <a
                                            href="#" class="fw-bold text-body"><u>Learn more</u></a></p>

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