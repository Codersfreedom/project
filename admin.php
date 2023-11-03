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



    <!-- Modal ends here -->


    <h2 class="text-center py-3">Check availability</h2>
    <div class="container   my-5">

        <div class="form-container d-flex flex-column ">
            <form action="admin.php" class="d-flex flex-row align-self-center" method="post">
                <div class="form-group pr-3">
                    <label for="subname">Day</label>
                    <select class="form-control" id="day" name="day">
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option selected>All Day</option>

                    </select>
                </div>

                <div class="form-group pr-3">
                    <label for="subname">Year</label>
                    <select class="form-control" id="year" name="year">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option selected>All Year</option>

                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary my-4 ">Confirm</button>
                </div>

            </form>


        </div>
    </div>
    <div class="container">
        <h1 class="text-center my-3">Faculty Status</h1>

        <table class="table" id="myTable">
            <thead>
                <tr>

                    <th scope="col">Days</th>
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

    function Show_status($year, $day)
    {   require 'partials/dbconnect.php';

        if ($year == 'All Year' && $day == 'All Day') {
            $sql = "SELECT faculty.name, status.* from `faculty` left JOIN status on faculty.fac_id = status.fac_id";

        } elseif ($year == 'All Year' && $day != 'All Day') {
            $sql = "SELECT faculty.name, status.* from `faculty` left JOIN status on faculty.fac_id = status.fac_id WHERE `day`='$day'";
        } elseif ($year != 'All Year' && $day == 'All Day') {
            $sql = "SELECT faculty.name, status.* from `faculty` left JOIN status on faculty.fac_id = status.fac_id WHERE `year`=$year";
        } elseif ($year != 'All Year' && $day != 'All Day') {
            $sql = "SELECT faculty.name, status.* from `faculty` left JOIN status on faculty.fac_id = status.fac_id WHERE `year`=$year and `day`='$day'";
        }

        $result = mysqli_query($conn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {

            // if ($row['slot1'] == 1) {
            //     $slot1 = 'Available';
            // } else {
            //     $slot1 = 'Not Available';
            // }

            // if ($row['slot2'] == 1) {
            //     $slot2 = 'Available';
            // } else {
            //     $slot2 = 'Not Available';
            // }
            // if ($row['slot3'] == 1) {
            //     $slot3 = 'Available';
            // } else {
            //     $slot3 = 'Not Available';
            // }
            // if ($row['slot4'] == 1) {
            //     $slot4 = 'Available';
            // } else {
            //     $slot4 = 'Not Available';
            // }
            // if ($row['slot5'] == 1) {
            //     $slot5 = 'Available';
            // } else {
            //     $slot5 = 'Not Available';
            // }

            // if ($row['slot6'] == 1) {
            //     $slot6 = 'Available';
            // } else {
            //     $slot6 = 'Not Available';
            // }
            // if ($row['slot7'] == 1) {
            //     $slot7 = 'Available';
            // } else {
            //     $slot7 = 'Not Available';
            // }
            echo "<div class='container'><form method='post' action='";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"'>  <tr>
            <input type='hidden'  name='fac_id' value='".$row['fac_id']."'>
            <th scope='row'><select class=\"form-select\" name='day'>
            <option value='Monday'";echo $row['day']==='Monday'?' selected':''; echo" >Monday</option>
            <option value='Tuesday'";echo $row['day']==='Tuesday '?' selected':''; echo" >Tuesday</option>
            <option value='Wednesday'";echo $row['day']==='Wednesday '?' selected':''; echo" >Wednesday</option>
            <option value='Thursday'";echo $row['day']==='Thursday '?' selected':''; echo" >Thursday</option>
            <option value='Friday'";echo $row['day']==='Friday '?' selected':''; echo" >Friday</option>
                      
            </select></th>
        <td>" . $row['name'] . "</td>
        
        <td><select class=\"form-select\" name='slot1'>
        <option value='1' ";echo $row['slot1']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot1']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot2'>
        <option value='1' ";echo $row['slot2']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot2']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot3'>
        <option value='1' ";echo $row['slot3']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot3']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot4'>
        <option value='1' ";echo $row['slot4']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot4']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot5'>
        <option value='1' ";echo $row['slot5']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot5']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot6'>
        <option value='1' ";echo $row['slot6']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot6']==0? 'selected':'';echo ">Not Available</option>
        </select></td>

        <td><select class=\"form-select\" name='slot7'>
        <option value='1' ";echo $row['slot7']==1? 'selected':'';echo ">Available</option>
        <option value='0' ";echo $row['slot7']==0? 'selected':'';echo ">Not Available</option>
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



        if(isset($_POST['day']) && isset($_POST['year']))
        {$day = $_POST['day'];
        $year = $_POST['year'];
        Show_status($year, $day);
        }
        if(isset($_POST['slot1'])){
            $slot1=$_POST['slot1'];
            $slot2=$_POST['slot2'];
            $slot2=$_POST['slot2'];
            $slot3=$_POST['slot3'];
            $slot4=$_POST['slot4'];
            $slot5=$_POST['slot5'];
            $slot6=$_POST['slot6'];
            $slot7=$_POST['slot7'];
            $day=$_POST['day'];
            $fac_id=$_POST['fac_id'];
            //update query fuction
            echo $slot7;
        }
    }
    ?>


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
<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Initializint Data tables -->
<script>

    $(document).ready(function () {
        $('#myTable').DataTable();
        order[];
    });
</script>

</html>