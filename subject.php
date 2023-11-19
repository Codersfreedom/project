<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="./dist/css/style.min.css" rel="stylesheet" />
  <title>Subjects</title>
</head>

<body>

<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
  <?php require 'partials/dbconnect.php';
  include 'header.php';
  if (!isset($_SESSION['logedin'])) {
    header("location: index.php");
  }
  include 'aside.php';
  // session_start();
  ?>



  <?php
  require 'partials/dbconnect.php';
  $insert = false;
  $showError = 'false';
  $delete = false;


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subcode = $_POST['subcode'];
    $subname = $_POST['subname'];
    $type = $_POST['type'];
    $sem = $_POST['sem'];
    $dept = $_POST['dept'];
    $h_per_week = $_POST['hpw'];

    // Check if faculty id already exists or not
  
    $existsql = "SELECT * FROM `subject` WHERE `subject_code` = '$subcode'";
    $existresult = mysqli_query($conn, $existsql);
    $num = mysqli_num_rows($existresult);
    if ($num > 0) {
      $ShowError = "Subject  is already exists";
      header("location: subject.php?insertlog='.$ShowError.'");
    } else {

      // calculating year
  
      if ($sem == 1 || $sem == 2) {
        $year = 1;
      } elseif ($sem == 3 || $sem == 4) {
        $year = 2;
      } elseif ($sem == 5 || $sem == 6) {
        $year = 3;
      } elseif ($sem == 7 || $sem == 8) {
        $year = 4;
      }

      $sql = "INSERT INTO `subject`(`subject_code`, `subject_name`, `subject_type`, `semester`, `dept`, `year`,`h_per_w`) VALUES ('$subcode','$subname','$type','$sem','$dept', $year,$h_per_week)";
      $result = mysqli_query($conn, $sql);


      if ($result) {
        $insert = true;


      } else {
        $showError = "Can't insert";
        header("location: subject.php?insertlog='.$ShowError.'");

      }
    }
  }

  // Delete function
  

  if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];


    // checking if the subject is assigned in sub_allot table
  
    $ExistsSubSql = "select assign from sub_allot where sub_code = '$sno'";
    $ExistsRes = mysqli_query($conn, $ExistsSubSql);
    $Exists = mysqli_num_rows($ExistsRes);
    if ($Exists>0) {

      // Deleting from sub_allot table
  
      $DelSub_allot_sql = "Delete  from sub_allot where sub_code = '$sno' ";
      mysqli_query($conn, $DelSub_allot_sql);

      // Deleting from subject table
      $sql = "DELETE FROM `subject` WHERE `subject_code` = '$sno'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $delete = true;

      }

    } else {
      $sql = "DELETE FROM `subject` WHERE `subject_code` = '$sno'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $delete = true;

      }
    }
  }


  ?>

  <?php


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
  } else if ($delete) {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong> successfully deleted.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>';

  }


  ?>
  <div class="container d-flex justify-content-center mt-5 p-5">
    <?php include 'partials/subject_modal.php' ?>

  </div>
  <!-- Table to display data -->

  <div class="container p-5">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Subject Code</th>
          <th scope="col">Subject Name</th>
          <th scope="col">Course Type</th>
          <th scope="col">Semester</th>
          <th scope="col">Department</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT* FROM `subject`";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {


          echo "   <tr>
            <th scope='row'>" . $row['subject_code'] . "</th>
            <td>" . $row['subject_name'] . "</td>
            <td>" . $row['subject_type'] . "</td>
            <td>" . $row['semester'] . "</td>
            <td>" . $row['dept'] . "</td>
            <td><button class = 'edit btn btn-sm btn-primary' name = 'edit'> <a class = 'text-light'href='partials/sub_update.php?updateid=" . $row['subject_code'] . "'>Update</a></button>  <button class='delete btn btn-sm btn-primary' id=d" . $row['subject_code'] . ">Delete</button>  </td>
        
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
  <!-- Datatables -->
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
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
  <!-- <script src="./dist/js/pages/dashboards/dashboard1.js"></script> -->
  <!-- Charts js Files -->
  <script src="./assets/libs/flot/excanvas.js"></script>
  <script src="./assets/libs/flot/jquery.flot.js"></script>
  <script src="./assets/libs/flot/jquery.flot.pie.js"></script>
  <script src="./assets/libs/flot/jquery.flot.time.js"></script>
  <script src="./assets/libs/flot/jquery.flot.stack.js"></script>
  <script src="./assets/libs/flot/jquery.flot.crosshair.js"></script>
  <script src="./assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
  <script src="./dist/js/pages/chart/chart-page-init.js"></script>

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
          window.location = `subject.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })

  </script>

</body>

</html>