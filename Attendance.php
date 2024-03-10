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
    <title>Attendance</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet" />
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png" />
</head>

<style>
    select {
        width: 70px;
        height: 35px;
        border-radius: 3px;
        padding: 5px;
    }

    #year {
        margin-left: 10px;
    }

    form {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }
</style>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php
        include 'header.php';
        require 'partials/dbconnect.php';
        include 'aside.php';
        ?>

        <div class="container d-flex my-5 pt-4 align-items-center justify-content-center">
            <div class="year-box">
                <form action="Attendance.php" method="post">
                    <label for="year">Year</label>
                    <select name="year" id="year">
                        <?php
                        $sql = "select Distinct year from attendance";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=" . $row['year'] . ">" . $row['year'] . "</option>";
                        }
                        ?>

                    </select>
                    <button type="submit" class='btn btn-primary '>Confirm</button>
                </form>
            </div>

        </div>
        <div class="container p-5 mt-5 col-12 text-nowrap text-center">
            <?php

            $year = date('Y');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['year'])) {
                    $year = $_POST['year'];

                }

            }
            ?>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Sno.</th>
                        <th class="text-center" scope="col">Month</th>
                        <th class="text-center" scope="col">Year</th>
                        <th class="text-center" scope="col">Id</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">In-Time</th>
                        <th class="text-center" scope="col">Out-Time</th>
                        <th class="text-center" scope="col">Attendance</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    // for ($i=1; $i <=25; $i++) { 
                    //     # code...
                    //     $lazy = "INSERT INTO `attendance` (`sno`, `month`, `year`, `fac_id`, `inTime`, `outTime`, `attendance`) VALUES (NULL, '6', '2024', 'C1', '2024-06-0$i 09:20:52.121000', '2024-06-0$i 05:20:52.475000', '1')";
                    //     mysqli_query($conn,$lazy);
                    // }
                    
                    $months = array(
                        1 => "January",
                        2 => "February",
                        3 => "March",
                        4 => "April",
                        5 => "May",
                        6 => "June",
                        7 => "July",
                        8 => "August",
                        9 => "September",
                        10 => "October",
                        11 => "November",
                        12 => "December"
                    );



                    $sno = 1;
                    $faculty = [];
                    $facSql = "Select distinct fac_id from attendance";
                    $result = mysqli_query($conn, $facSql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($faculty, $row['fac_id']);
                    }

                    foreach ($faculty as $facKey => $fac) {


                        for ($i = 1; $i <= 12; $i++) {

                            $checkMonth = "select fac_id from attendance where month = $i and attendance =1";
                            $checkMonthRes = mysqli_query($conn, $checkMonth);
                            $monthCount = mysqli_num_rows($checkMonthRes);
                            if ($monthCount < 1) {
                                break;
                            }

                            $sql = "select faculty.name, attendance.*, count(attendance) as count from faculty inner join attendance on faculty.fac_id = attendance.fac_id where attendance.month = $i and attendance.attendance =1 and attendance.fac_id ='$fac' ";
                            $newRes = mysqli_query($conn, $sql);


                            while ($row = mysqli_fetch_assoc($newRes)) {
                                if (isset($row['month'])) {

                                    $month = $row['month'];
                                }

                                echo "   <tr>
                        <td>" . $sno . "</td>
                        <td>" . $months[$month] . "  </td>
                        <td>" . $row['year'] . " </td>
                        <td>" . $row['fac_id'] . " </td>
                        <td>" . $row['name'] . " </td>
                        <td> " . $row['inTime'] . " </td>
                        <td>" . $row['outTime'] . " </td>
                        <td>" . $row['count'] . " </td>
                    

                      </tr>";
                                $sno++;
                            }
                        }
                    }
                    ?>




                </tbody>
            </table>
        </div>
    </div>
</body>

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
        $('#myTable').DataTable({

            "aaSorting": [],
            dom: 'Blfrtip',

            buttons: [
                'excel',

                {
                    extend: 'pdfHtml5',
                    orientation: "landscape",
                    downlode: 'open'
                },
                'print'
            ]
        });
    });



</script>


</html>