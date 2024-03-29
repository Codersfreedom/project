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
    <title>increment Status</title>
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

        height: 35px;
        border-radius: 3px;
        padding: 5px;
        text-align: center;
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

        <div class="container p-5 mt-5 text-nowrap text-center ">

            <table class="table" id="myTable">
                <thead>
                    <tr >
                        <th class="text-center" scope="col">Sno.</th>
                        <th class="text-center" scope="col">Id</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">increment amount</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "select fac_id, name, increment_amount,status from faculty ";
                    $result = mysqli_query($conn, $sql);
                    $sr = 1;
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "   <tr>
                        
                        <form action='increment_status.php' method='post'>
                        
            <td>" . $sr . "</td>
            <td>  " . $row['fac_id'] . " <input type='hidden' name='faculty'value='" . $row['fac_id'] . "'> </td>
            <td>" . $row['name'] . " </td>
           
            <td> &#8377; " . $row['increment_amount'] . " <input type='hidden' name='increment'value='" . $row['increment_amount'] . "'</td>
            <td><select id='status' name='status'>
            <option value ='0' >Not Approved</option>
            <option value ='1'";
                        echo $row['status'] == 1 ? 'selected' : '';
                        echo " >Approved</option>
            </select> </td>
             
        <td> <button type='submit' class = 'edit btn btn-sm btn-primary' name = 'edit'>Update</button>  </td>
         </form>
        </tr>";
                        $sr++;
                    }
                    ?>


                </tbody>
            </table>

        </div>
        <!-- update logic handle here -->

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['faculty']) && isset($_POST['increment']) && isset($_POST['status'])) {

                $facId = $_POST['faculty'];
                $amount = $_POST['increment'];
                $status = $_POST['status'];
                $sql = "UPDATE `faculty` SET `increment_amount`=0,`status`=$status WHERE `fac_id` ='$facId'";
                mysqli_query($conn, $sql);
            }




        }

        ?>

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
            "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]],
            "aaSorting": [],
            dom: 'Bfrtip',

            buttons: [
                'excel',

                {
                    extend: 'pdfHtml5',
                    orientation: "potrait",
                    downlode: 'open'
                },
                'print'
            ]
        });
    });



</script>


</html>