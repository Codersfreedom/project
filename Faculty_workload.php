<?php
session_start();
if (!isset($_SESSION['logedin'])) {
  header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Workload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!-- Custom CSS -->
  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="./dist/css/style.min.css" rel="stylesheet" />
<!-- favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png" />
</head>

<body>

  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <?php
    // session_start();
    require 'header.php';
    include 'aside.php';
    require 'partials/dbconnect.php';
    ?>

    <?php


    ?>


    <!-- Table to display data -->

    <div class="container p-5 ">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Day</th>
            <th scope="col">Slot1</th>
            <th scope="col">Slot2</th>
            <th scope="col">Slot3</th>
            <th scope="col">Slot4</th>
            <th scope="col">Slot5</th>
            <th scope="col">Slot6</th>
            <th scope="col">Slot7</th>


          </tr>
        </thead>
        <tbody>
          <?php
          $faculty_id = $_SESSION['fac_id'];

          $sql1 = "select alias from faculty where fac_id ='$faculty_id'";
          $aliasRow = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
          $alias = $aliasRow['alias'];

          $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

          // Checking if the routine available for all years
          
          for ($i = 1; $i < 5; $i++) {
            $existSql = "select *from " . $i . 'year_routine';
            $num = mysqli_num_rows(mysqli_query($conn, $existSql));
            if ($num > 0) {

              foreach ($days as $day) {

                echo " <tr>  
                <th scope='row'>" . $day . " </th>";


                for ($j = 1; $j < 8; $j++) {
                  $sql = "select slot$j from " . $i . "year_routine where day='$day' and slot$j like '%$alias%'";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);

                  if (isset($row['slot' . $j . ''])) {



                    echo " <td>" . $row['slot' . $j . ''] ?? null . "  <td>";
                  } else {
                    echo " <td>" . " " . " <td>";
                  }


                }
                echo "</tr>";
              }



            }


          }







          ?>
        </tbody>
      </table>
    </div>
  </div>













  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <!-- Bootstrap -->
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

  <!-- Initializint Data tables -->
  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();
  });
  </script>
</body>

</html>