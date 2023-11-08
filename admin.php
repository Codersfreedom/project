<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>


<body>
    <?php
    include 'partials/_header.php';
    if (!isset($_SESSION['logedin'])) {
        header("location: index.php");
    }
    include 'partials/_nav.php';

    ?>





    <h2 class="text-center py-3">Check availability</h2>
    <div class="container   my-5">

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


                <div class="pt-2">
                    <button type="submit" class="btn btn-primary my-4 ">Confirm</button>
                </div>

            </form>


        </div>
    </div>
    <div class="container" style="margin-left:100px">
        <h1 class="text-center my-3">Faculty Status</h1>

        <table class="table" id="myTable">
            <thead>
                <tr>

                    <th scope="col">Days</th>
                    <th scope="col">Year</th>
                    <th scope="col">Faculty</th>
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

    function Show_status($day)
    {
        require 'partials/dbconnect.php';

        if ($day == 'All Day') {
            $sql = "SELECT faculty.name, status.* from `faculty` INNER JOIN status on faculty.fac_id = status.fac_id order by `year` and `day` asc";
        } else {
            $sql = "SELECT faculty.name, status.* from `faculty` INNER JOIN status on faculty.fac_id = status.fac_id WHERE  `day`='$day' order by `year` and `day` ASC";
        }

        $result = mysqli_query($conn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {


            echo "<div class='container'><form method='post' action='";
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
            echo "'>  <tr>
            <input type='hidden'  name='fac_id' value='" . $row['fac_id'] . "'>
            <input type='hidden'  name='year' value='" . $row['year'] . "'>
            <input type='hidden'  name='day' value='" . $row['day'] . "'>
            
            <td>" . $row['day'] . "</td> 
           
            <td>" . $row['year'] . "</td>
        <td>" . $row['name'] . "</td>
        
        <td><select class=\"form-select\" name='slot1'>
        <option value='1' ";
            echo $row['slot1'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot1'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot2'>
        <option value='1' ";
            echo $row['slot2'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot2'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot3'>
        <option value='1' ";
            echo $row['slot3'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot3'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot4'>
        <option value='1' ";
            echo $row['slot4'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot4'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot5'>
        <option value='1' ";
            echo $row['slot5'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot5'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot6'>
        <option value='1' ";
            echo $row['slot6'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot6'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot7'>
        <option value='1' ";
            echo $row['slot7'] == 1 ? 'selected' : '';
            echo ">Available</option>
        <option value='0' ";
            echo $row['slot7'] == 0 ? 'selected' : '';
            echo ">Not Available</option>
        </select></td>

        <td><button type=\"submit\" class=\"btn btn-primary\">Update</button></td>
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

            Show_status($dropdown_day);
        } else {
            $dropdown_day = 'All Day';

        }
        if (isset($_POST['slot1'])) {
            $slot1 = $_POST['slot1'];
            $slot2 = $_POST['slot2'];
            $slot2 = $_POST['slot2'];
            $slot3 = $_POST['slot3'];
            $slot4 = $_POST['slot4'];
            $slot5 = $_POST['slot5'];
            $slot6 = $_POST['slot6'];
            $slot7 = $_POST['slot7'];
            $day = $_POST['day'];
            $fac_id = $_POST['fac_id'];
            $year = $_POST['year'];

            echo $slot1;
            echo$year;
            echo $day;
    
            //update query fuction
            Update_Status($slot1, $slot2, $slot3, $slot4, $slot5, $slot6, $slot7, $day, $year, $fac_id);
            Show_status($dropdown_day);


        }
    }

    function Update_Status($slot1, $slot2, $slot3, $slot4, $slot5, $slot6, $slot7, $day, $year, $fac_id)
    {
        require 'partials/dbconnect.php';


        $sql1 = "UPDATE `status` SET `slot1`=$slot1,`slot2`=$slot2,`slot3`=$slot3,`slot4`=$slot4,`slot5`=$slot5,`slot6`=$slot6,`slot7`=$slot7 WHERE `day`='$day' and `fac_id`='$fac_id' and `year`=$year";
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


        // $sql2 = "UPDATE `status` SET `slot1`=$new_slot1,`slot2`=$new_slot2,`slot3`=$new_slot3,`slot4`=$new_slot4,`slot5`=$new_slot5,`slot6`=$new_slot6,`slot7`=$new_slot7 WHERE `day`='$day' and `fac_id`='$fac_id' and `year`=$other_year";
        // $result = mysqli_query($conn, $sql2);
    }
    ?>


</body>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script> -->

<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Initialize Data tables -->
<script>

    $(document).ready(function () {
        $('#myTable').DataTable(
            // {
            //    "aaSorting":[]
            // }
        );
        
       
    });

</script>

</html>