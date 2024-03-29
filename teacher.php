<?php
session_start();
if (!isset($_SESSION['logedin'])) {
  header("location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <!-- Bootstrap CSS -->


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png" />
  <!-- Custom CSS -->
  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="./dist/css/style.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <title>Faculty</title>
</head>

<body>

  <style>
    .alert {
      width: 350px;
      /* margin-left: 150px; */
      left: 460px;



    }
  </style>

  <!-- Inserting Data into faculty table from modal -->
  <div class="wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php
    // session_start();
    include 'header.php';
    include 'aside.php';
    require 'partials/dbconnect.php';
    $insert = false;
    $delete = false;
    $showError = 'false';
    // echo $_SESSION['logedin'];
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $facid = $_POST['facid'];
      $name = $_POST['name'];
      $designation = $_POST['designation'];
      $alias = $_POST['alias'];
      $email = $_POST['email'];
      $phone = $_POST['ph'];
      $workload = $_POST['workload'];
      $experience = $_POST['experience'];
      $basic = $_POST['basic'];
      $address = $_POST['address'];
      $area = $_POST['area'];

      //? Current Year
      $currYear = date('Y');
      $currMonth = date('m');

      if($currMonth >3 ){
        $financial_year = $currYear . '-' . $currYear + 1;

      }else{
        $financial_year = $currYear-1 .'-'. $currYear;
      }

      // Check if faculty id already exists or not
    
      $existsql = "SELECT * FROM `faculty` WHERE `fac_id` = '$facid'";
      $existresult = mysqli_query($conn, $existsql);
      $num = mysqli_num_rows($existresult);

      if ($num > 0) {
        $ShowError = "Faculty id is already exists";
        header("location: teacher.php?insertlog='.$ShowError.'");
      } else {

        // insert into faculty table

        $sql = "INSERT INTO `faculty`(`fac_id`, `name`, `alias`, `designation`, `phone`, `email`, `addr`, `area`, `experience`,`basic_salary`,`financial_year`) VALUES ('$facid','$name','$alias','$designation',$phone,'$email', '$address','$area'  ,$experience,$basic,'$financial_year')";
        $result = mysqli_query($conn, $sql);

        // insert into totalworkload table
        $totalWlSql = "INSERT INTO `total_wl`( `fac_id`, `totalWL`) VALUES ('$facid',$workload)";
        $totalWlRes = mysqli_query($conn, $totalWlSql);

        // insert into individual workload table
        for ($i = 1; $i < 5; $i++) {

          $eachWlSql = "insert into workload (facId,year,workLoad) values ('$facid', $i , 0)";
          $eachWlRes = mysqli_query($conn, $eachWlSql);
        }

        // insert into fac_status table
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

        foreach ($days as $day) {

          $sql = "insert into fac_status (day,fac_id,slot1,slot2,slot3,slot4,slot5,slot6,slot7) values('$day','$facid',1,1,1,1,1,1,1)";
          mysqli_query($conn, $sql);


        }
        // insert into tax table
    
        $taxInsertSql = "insert into tax (fac_id,tax,total_pay,financial_year,refund_amount) values('$facid',0,0,$financial_year,0)";
        $insertTaxRes = mysqli_query($conn, $taxInsertSql);



        if ($result && $totalWlRes && $eachWlRes && $insertTaxRes) {
          $insert = true;


        } else {
          $showError = "Can't insert";
          header("location: teacher.php?insertlog='.$ShowError.'");

        }
      }
    }

    // Delete function
    

    if (isset($_GET['delete'])) {
      $sno = $_GET['delete'];

      //? Getting number of rows from sub_allot table
      $FacExistsSql = "Select distinct year from sub_allot join faculty on sub_allot.fac_id= faculty.fac_id where sub_allot.fac_id = '$sno'";
      $FacExistsRes = mysqli_query($conn, $FacExistsSql);
      $FacNum = mysqli_num_rows($FacExistsRes);

      //? Getting number of row rows from faculty table
      $FacSql = "SELECT * FROM faculty WHERE fac_id='$sno'";
      $FacRes = mysqli_query($conn, $FacSql);
      $FacNumRow = mysqli_num_rows($FacRes);



      //? if faculty exists in sub_allot table 
      if ($FacNum > 0) {

        //? Deleting from status table
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

        foreach ($days as $day) {
          $FacExistsSql = "Select distinct year from sub_allot join faculty on sub_allot.fac_id= faculty.fac_id where sub_allot.fac_id = '$sno'";
          $FacExistsRes = mysqli_query($conn, $FacExistsSql);
          while ($FacRow = mysqli_fetch_assoc($FacExistsRes)) {
            $year = $FacRow['year'];
            $DelStatusSql = " Delete from status where day = '$day' and fac_id = '$sno' and year = $year";
            mysqli_query($conn, $DelStatusSql);


          }


        }

        //? Deleting from totalWorkLoad table
        $DelTwlSql = "Delete from total_wl where fac_id = '$sno'";
        mysqli_query($conn, $DelTwlSql);

        // ?Deleting from Individual workload table
        $DelInWlSql = "Delete from workload where facId = '$sno'";
        mysqli_query($conn, $DelInWlSql);

        //? Deleting from sub_allot table
        $FacExistsSql = "Select distinct year from sub_allot join faculty on sub_allot.fac_id= faculty.fac_id where sub_allot.fac_id = '$sno'";
        $FacExistsRes = mysqli_query($conn, $FacExistsSql);
        while ($FacRow = mysqli_fetch_assoc($FacExistsRes)) {
          $year = $FacRow['year'];
          $DelSub_allot_Sql = "Delete from sub_allot where fac_id = '$sno' and year = $year";
          mysqli_query($conn, $DelSub_allot_Sql);

        }

        //? Deleting from fac_status
    
        $sql = " Delete from fac_status where fac_id = '$sno'";
        mysqli_query($conn, $sql);

        //? Deleting from faculty table
        $DeleteSql = "DELETE FROM `faculty` WHERE `fac_id` = '$sno'";
        $DeleteRes = mysqli_query($conn, $DeleteSql);

        if ($DeleteRes) {
          $delete = true;
        } else {

          $showError = "Can't delete";
          header("location: teacher.php?deletelog='.$ShowError.'");
        }
      } elseif ($FacNumRow > 0) {


        //? Deleting from totalWorkLoad table
        $DelTwlSql = "Delete from total_wl where fac_id = '$sno'";
        mysqli_query($conn, $DelTwlSql);

        //? Deleting from Individual workload table
        $DelInWlSql = "Delete from workload where facId = '$sno'";
        mysqli_query($conn, $DelInWlSql);

        //? Deleting from fac_status
        $sql = " Delete from fac_status where fac_id = '$sno'";
        mysqli_query($conn, $sql);

        //? Deleting from tax table
        $deleteTaxSql = "Delete from tax where fac_id = '$sno'";
        $DeleteRes = mysqli_query($conn, $deleteTaxSql);

        //? Deleting from faculty table
        $DeleteSql = "DELETE FROM `faculty` WHERE `fac_id` = '$sno'";
        mysqli_query($conn, $DeleteSql);



        if ($DeleteRes) {
          $delete = true;
        } else {

          $showError = "Can't delete";
          header("location: teacher.php?deletelog='.$ShowError.'");
        }
      }

    }


    ?>




    <div class="alert ">



      <?php
      // include 'partials/_header.php';
      // include 'partials/_nav.php'; 
      


      if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Inserted successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>';


      } else if (isset($_GET['insertlog'])) {
        $insertlog = $_GET['insertlog'];
        echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
    <strong>Insertion Failed!</strong> ' . $insertlog . '.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
      } else if (isset($_GET['updatelog']) == true) {

        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Successfully Updated!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

      }

      if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong> successfully Deleted!.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>';
      } elseif (isset($_GET['deletelog'])) {
        $deletelog = $_GET['deletelog'];
        echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
    <strong>Delete Failed!</strong> ' . $deletelog . '.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

      }


      ?>
    </div>
    <div class="container d-flex justify-content-center mt-5  align-items-center">
      <?php include 'partials/faculty_modal.php' ?>

    </div>







    <!-- Table to display data -->

    <div class="container d-flex justify-content-center align-items-center  pl-5 text-nowrap text-center">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th class="text-center" scope="col">Name</th>
            <th class="text-center" scope="col">Designation</th>
            <th class="text-center" scope="col">Alias</th>
            <th class="text-center" scope="col">Phone</th>
            <th class="text-center" scope="col">Email</th>
            <th class="text-center" scope="col">Experience</th>
            <th class="text-center" scope="col">JoinAt</th>
            <th class="text-center" scope="col">Basic</th>
            <th class="text-center" scope="col">Increment</th>
            <th class="text-center" scope="col">Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT* FROM `faculty`";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {


            echo "   <tr>
                <th scope='row'>" . $row['fac_id'] . "</th>
                <td>" . $row['name'] . "</td>
                <td>" . $row['designation'] . "</td>
                <td>" . $row['alias'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['experience'] . "</td>
                <td>" . $row['joinAt'] . "</td>
                <td>" . $row['basic_salary'] . "</td>
                <td>&#8377; " . $row['increment_amount'] . "</td>
                <td><button class = 'edit btn btn-sm btn-primary' name = 'edit'> <a class = 'text-light'href='partials/fac_update.php?updateid=" . $row['fac_id'] . "'>Update</a></button>  <button class='delete btn btn-sm btn-primary' id=d" . $row['fac_id'] . ">Delete</button>  </td>
            
              </tr>";


          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
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

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>



  <!-- Datatables -->

  <!-- Export as pdf js -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <!-- All Jquery -->
  <!-- ============================================================== -->

  <!-- Bootstrap tether Core JavaScript -->
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="./assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="./dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="./dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="./dist/js/custom.min.js"></script>
  <!--This page JavaScript -->
  <script src="./dist/js/pages/dashboards/dashboard1.js"></script>


  <!-- Initializint Data tables -->
  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <script>

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `teacher.php?delete=${sno}`;

        }
        else {
          console.log("no");
        }
      })
    })

  </script>

</body>

</html>