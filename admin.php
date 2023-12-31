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
    <title>Admin Page</title>

    <!-- Bootstrap css -->
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
</head>


<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php
        include 'header.php';
        // if (!isset($_SESSION['logedin'])) {
        //     header("location: index.php");
        // }
        include 'aside.php';

        ?>


        <h2 class="text-center py-3">Check availability</h2>
        <div class="container  my-5">

            <div class="form-container d-flex flex-column ">
                <form action="admin.php" class="d-flex flex-row align-self-center" method="post">
                    <div class="form-group pr-3">
                        <label for="subname">Day</label>

                        <select class="form-control" id="day" name="dropday">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option selected>All Day</option>

                        </select>
                    </div>

                    <div class="form-group pr-3">
                        <label for="faculty">Faculty</label>

                        <select class="form-control" id="faculty" name="faculty">

                            <?php

                            $sql = "SELECT DISTINCT faculty.fac_id,`name`  from `faculty` inner join  `fac_status` on faculty.fac_id = fac_status.fac_id;";
                            $result = mysqli_query($conn, $sql);


                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "
       
                        <option value =" . $row['fac_id'] . ">
                        " . $row['name'] . "
                        </option>
                        ";
                            }
                            ?>
                            <option selected>All</option>
                        </select>
                    </div>



                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary my-4 ">Confirm</button>
                    </div>

                </form>

            </div>
        </div>
        <div class="container col-10" style="margin-left:150px">
            <h1 class="text-center my-3">Faculty Status</h1>

            <table class="table" id="myTable">
                <thead>
                    <tr>

                        <th scope="col">Days</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">FacultyId</th>
                        <th scope="col">Period 1</th>
                        <th scope="col">Period 2</th>
                        <th scope="col">Period 3</th>
                        <th scope="col">Period 4</th>
                        <th scope="col">Period 5</th>
                        <th scope="col">Period 6</th>
                        <th scope="col">Period 7</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
        </div>
        <?php
        require 'partials/dbconnect.php';
        include 'partials/Fac_status_modal.php';

        function Show_status($day, $faculty)
        {
            require 'partials/dbconnect.php';

            if ($day == 'All Day' && $faculty == 'All') {
                $sql = "SELECT faculty.name, fac_status.* from `faculty` INNER JOIN fac_status on faculty.fac_id = fac_status.fac_id order by `id` asc";
            } else if ($day == 'All Day' && $faculty != 'All') {
                $sql = "SELECT faculty.name, fac_status.* from faculty INNER JOIN fac_status on faculty.fac_id = fac_status.fac_id where fac_status.fac_id = '$faculty' order by id asc;";
            } else if ($faculty == 'All' && $day != 'All Day') {
                $sql = "SELECT faculty.name, fac_status.* from `faculty` INNER JOIN fac_status on faculty.fac_id = fac_status.fac_id where fac_status.day='$day' order by `id` asc";
            } elseif ($faculty != 'All' && $day != 'All Day') {
                $sql = "SELECT faculty.name, fac_status.* from `faculty` INNER JOIN fac_status on faculty.fac_id = fac_status.fac_id where fac_status.day='$day' and fac_status.fac_id='$faculty' order by `id` asc";
            }

            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_assoc($result)) {


                echo " <tr>
            <td>" . $row['day'] . "</td> 
           
            
            <td>" . $row['name'] . "</td>
            <td>" . $row['fac_id'] . "</td>
            <td>";
                echo $row['slot1'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot2'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot3'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot4'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot5'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot6'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            <td>";
                echo $row['slot7'] == 1 ? '<span class="font-weight-bold badge badge-success">Available</span>' : '<span class="font-weight-bold badge badge-danger">Not Available</span>';
                echo "</td>
            


        <td> <button type='button' class='update btn btn-success'   data-toggle='modal' data-target='#exampleModalCenter'>
        Update
      </button> </td>
        </tr>
        </form>
        </div>";
            }
        }

        ?>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {



            if (isset($_POST['dropday'])) {
                $dropdown_day = $_POST['dropday'];
                $faculty = $_POST['faculty'];
                Show_status($dropdown_day, $faculty);
            } else {
                $dropdown_day = 'All Day';
                $faculty = "All";
            }
            if (isset($_POST['facid'])) {
                // $slot1 = $_POST['slot1'];
                // $slot2 = $_POST['slot2'];
                // $slot3 = $_POST['slot3'];
                // $slot4 = $_POST['slot4'];
                // $slot5 = $_POST['slot5'];
                // $slot6 = $_POST['slot6'];
                // $slot7 = $_POST['slot7'];
                $status = $_POST['status'];
                $day = $_POST['day'];
                $fac_id = $_POST['facid'];

                for ($i = 1; $i < 8; $i++) {
                 
                    if (isset($_POST['slot'.$i])) {

                        //echo $_POST['slot'.$i];
                        
                        Update_Status($day,$fac_id,$_POST['slot'.$i],$status);

                    }


                }


                
                // echo 'Status: '. $status;
                // echo 'fac id: '. $fac_id;
                // echo 'day: '. $day;
                // Update_Status($day, $fac_id, $slot,$status);
                //update query fuction
                // Update_Status($slot1, $slot2, $slot3, $slot4, $slot5, $slot6, $slot7, $day, $fac_id);
                // Show_status($dropdown_day, $faculty);
            }
        }

        function Update_Status($day, $fac_id, $slot, $status)
        {
            require 'partials/dbconnect.php';


            $sql1 = "UPDATE `status` SET $slot=$status WHERE `day`='$day' and `fac_id`='$fac_id'";
            $result = mysqli_query($conn, $sql1);

            // if ($year % 2 == 0) {
            //     $other_year = $year - 1;
            // } else {
            //     $other_year = $year + 1;
            // }
        
            // if ($slot1 == 1) {
            //     $new_slot1 = 0;
            // } else {
            //     $new_slot1 = 1;
            // }
        
            // if ($slot2 == 1) {
            //     $new_slot2 = 0;
            // } else {
            //     $new_slot2 = 1;
            // }
        
            // if ($slot3 == 1) {
            //     $new_slot3 = 0;
            // } else {
            //     $new_slot3 = 1;
            // }
        
            // if ($slot4 == 1) {
            //     $new_slot4 = 0;
            // } else {
            //     $new_slot4 = 1;
            // }
        
            // if ($slot5 == 1) {
            //     $new_slot5 = 0;
            // } else {
            //     $new_slot5 = 1;
            // }
            // if ($slot6 == 1) {
            //     $new_slot6 = 0;
            // } else {
            //     $new_slot6 = 1;
            // }
        
            // if ($slot7 == 1) {
            //     $new_slot7 = 0;
            // } else {
            //     $new_slot7 = 1;
            // }
        

            $sql2 = "UPDATE `fac_status` SET $slot=$status WHERE `day`='$day' and `fac_id`='$fac_id'";
            $result = mysqli_query($conn, $sql2);
        }
        ?>
    </div>
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
<!-- Initialize Data tables -->
<script>
    // $(document).ready(function () {
    //     $('#myTable').DataTable(
    //         {
    //             "aaSorting": [],

    //         }

    //     );


    // });
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

                    document.getElementById('days').value = rowData[0];
                    document.getElementById('facid').value = rowData[2];
                    console.log('Row Data:', rowData);

                }
            }
        });
    });
</script>

<script>
    // $(document).ready(function () {
    //   $('#myTable').DataTable();
    // });
    // 
</script>


<script>
    // update = document.getElementsByClassName('btn');
    // Array.from(deletes).forEach((element) => {
    //   element.addEventListener("click", (e) => {
    //     console.log("update");
    //     sno = e.target.id.substr(1);
    //     console.log(sno);
    //     if (confirm("Are you sure you want to delete this note!")) {
    //       console.log("yes");
    //       window.location = `teacher.php?delete=${sno}`;
    //       // TODO: Create a form and use post request to submit a form
    //     }
    //     else {
    //       console.log("no");
    //     }
    //   })
    // })
</script>

</html>