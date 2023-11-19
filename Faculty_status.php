<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Status</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet" />

</head>

<body>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php
        // session_start();
        include 'header.php';
        if (!isset($_SESSION['logedin'])) {
            header("location: index.php");
        }
        include 'aside.php';
        require 'partials/dbconnect.php';
        ?>

        <?php


        ?>


        <!-- Table to display data -->

        <div class="container p-5">

            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Day.</th>
                        <th scope="col">Faculty Id</th>
                        <th scope="col">Year</th>
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

                    $sql = "select * from status where fac_id = '$faculty_id'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {


                        echo "   <tr>
            <th scope='row'>" . $row['day'] . "</th>
            <td>" . $row['fac_id'] . "</td>
            <td>" . $row['year'] . "</td>
            <td>" . $row['slot1'] . "</td>
            <td>" . $row['slot2'] . "</td>
            <td>" . $row['slot3'] . "</td>
            <td>" . $row['slot4'] . "</td>
            <td>" . $row['slot5'] . "</td>
            <td>" . $row['slot6'] . "</td>
            <td>" . $row['slot7'] . "</td>
            
        
          </tr>";


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