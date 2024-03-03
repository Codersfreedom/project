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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

  <!-- Custom CSS -->
  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="./dist/css/style.min.css" rel="stylesheet" />
  <!-- favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png" />

  <title>Theory-class</title>
</head>

<body>

  <style>
    .alert {
      width: 400px;
      /* margin-left: 150px; */
      left: 520px;



    }
  </style>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php

    include 'header.php';
    // if (!isset($_SESSION['logedin'])) {
    //   header("location: index.php");
    // }
    include 'aside.php';
    $delete = false;
    $insert = false;



  

require 'partials/dbconnect.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  if (isset($_POST['subname']) && isset($_POST['allotTeacher']) && isset($_POST['sem'])) {

    $allotSubject = $_POST['subname'];
    $allotTeacher = $_POST['allotTeacher'];
    $sem = $_POST['sem'];

    //getting subject code from subject table

    $sql1 = "SELECT * FROM `subject` where `subject_name` = '$allotSubject'";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result);
    $sub_code = $row['subject_code'];
    $sub_name = $row['subject_name'];

    //getting fac_id from faculty table 

    $sql2 = "SELECT * FROM `faculty` where `name` = '$allotTeacher'";
    $result = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result);
    $fac_id = $row['fac_id'];
    $fac_name = $row['alias'];

    $data = "$sub_name($fac_name)";

    // getting year from semester 

    if ($sem == 1 || $sem == 2) {
      $year = 1;
    } elseif ($sem == 3 || $sem == 4) {
      $year = 2;
    } elseif ($sem == 5 || $sem == 6) {
      $year = 3;
    } elseif ($sem == 7 || $sem == 8) {
      $year = 4;
    }

    // insert query on subject_allot table

    $sql = "INSERT INTO `sub_allot`( `fac_id`, `sub_code`,`assign`,`sem`,`year`) VALUES ('$fac_id','$sub_code','$data',$sem,$year)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;

    }

    //  whenever new faculty arrives
    // check if  the faculty id already exists in status table

    $exists = "SELECT * FROM `status` where `fac_id` = '$fac_id' and `year`='$year'";
    $exists_result = mysqli_query($conn, $exists);
    $num = mysqli_num_rows($exists_result);
    if ($num <= 0) {
      Add_faculty($fac_id, $year);
    }

  }


  // Delete from sub_allot table
  if (isset($_POST['facid']) && isset($_POST['subcode'])) {

    $facultyId = $_POST['facid'];
    $subjectCode = $_POST['subcode'];

    // Delete query

    $sql = "Delete from  sub_allot where fac_id = '$facultyId' and sub_code ='$subjectCode'";
    $delRes = mysqli_query($conn, $sql);

    if ($delRes) {
      $delete = true;
    }

  }



}
?>


 <div class="alert">

<?php

if ($delete) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
<strong>successfully deleted the data.</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';

}
if ($insert) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
<strong>successfully inserted the data.</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';

}

?>



</div>

    <div class="container d-flex justify-content-center   mt-5 p-5">

      <?php
      include 'partials/Sub_allot_modal.php';

      ?>
    </div>



    <?php
  





    function Add_faculty($fac_id, $year)
    {


      require 'partials/dbconnect.php';

      $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

      foreach ($days as $day) {



        $sql1 = "INSERT INTO `status`(`day`, `fac_id`, `year`, `slot1`, `slot2`, `slot3`, `slot4`, `slot5`, `slot6`, `slot7`) VALUES ('$day','$fac_id',$year,1,1,1,1,1,1,1)";
        $result = mysqli_query($conn, $sql1);

        // if ($year % 2 == 0) {
        //   $other_year = $year - 1;
        // } else {
        //   $other_year = $year + 1;
        // }
    

        // $sql2 = "INSERT INTO `status`(`day`, `fac_id`, `year`, `slot1`, `slot2`, `slot3`, `slot4`, `slot5`, `slot6`, `slot7`) VALUES ('$day','$fac_id',$other_year,0,0,0,0,0,0,0)";
        // $result = mysqli_query($conn, $sql2);
    

      }
    }
    // Delete Quary
    
    if (isset($_GET['delete'])) {
      $sno = $_GET['delete'];
      $sql = "DELETE FROM `sub_allot` WHERE `sub_code` = '$sno'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $delete = true;

      }

    }

    ?>
   







    <!-- Table to display data -->

    <div class="container d-flex justify-content-center align-items-center p-5 text-center text-nowrap">

      <table class="table" id="myTable">
        <thead>
          <tr >

            <th scope="col">Faculty Id</th>
            <th scope="col">Subject Code</th>
            <th class="text-center" scope="col">Assign</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>

          <?php

          include 'partials/theory_modal.php';



          $sql = "SELECT * FROM `sub_allot`";

          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {



            echo "  <tr>
            <td scope='row'>" . $row['fac_id'] . "</td>
            <td>" . $row['sub_code'] . "</td>
            <td>" . $row['assign'] . "</td>
            <td>" . $row['sem'] . "</td>
            <td><button type='button' class='update btn btn-success'   data-toggle='modal' data-target='#DeleteModal'>
            Delete
          </button>   </td>

            </tr>";
          }

          ?>
        </tbody>
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

  <!-- <script>

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);
        console.log(sno);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `theory.php?delete=${sno}`;

        }
        else {
          console.log("no");
        }
      })
    })

  </script> -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let table = document.getElementById('myTable');
      table.addEventListener('click', function (event) {
        let target = event.target;

        if (target.classList.contains('update')) {

          let tr = target.closest('tr');
          if (tr) {
            let cells = tr.querySelectorAll('td');
            let rowData = [];
            cells.forEach(function (cell) {
              rowData.push(cell.textContent);
            });

            document.getElementById('facid').value = rowData[0];
            document.getElementById('subcode').value = rowData[1];
            document.getElementById('assign').value = rowData[2];
            document.getElementById('semester').value = rowData[3];

            //console.log('Row Data:', rowData);

          }
        }
      });
    });


  </script>






</html>