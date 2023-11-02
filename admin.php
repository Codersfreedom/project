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
    function Show_status($year, $day)
    {

        require 'partials/dbconnect.php';

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

            if ($row['slot1'] == 1) {
                $slot1 = 'Available';
            } else {
                $slot1 = 'Not Available';
            }

            if ($row['slot2'] == 1) {
                $slot2 = 'Available';
            } else {
                $slot2 = 'Not Available';
            }
            if ($row['slot3'] == 1) {
                $slot3 = 'Available';
            } else {
                $slot3 = 'Not Available';
            }
            if ($row['slot4'] == 1) {
                $slot4 = 'Available';
            } else {
                $slot4 = 'Not Available';
            }
            if ($row['slot5'] == 1) {
                $slot5 = 'Available';
            } else {
                $slot5 = 'Not Available';
            }

            if ($row['slot6'] == 1) {
                $slot6 = 'Available';
            } else {
                $slot6 = 'Not Available';
            }
            if ($row['slot7'] == 1) {
                $slot7 = 'Available';
            } else {
                $slot7 = 'Not Available';
            }



            echo "  <tr>   
        <th scope='row'>" . $row['day'] . "</th>
        <td>" . $row['name'] . "</td>
        <td>" . $slot1 . "</td>
        <td>" . $slot2 . "</td>
        <td>" . $slot3 . "</td>
        <td>" . $slot4 . "</td>
        <td>" . $slot5 . "</td>
        <td>" . $slot6 . "</td>
        <td>" . $slot7 . "</td>
        <td><button class = 'edit btn btn-sm btn-primary' name = 'edit'> <a class = 'text-light'href='partials/Fac_update.php?updateid=" . $row['fac_id'] . "'>Update</a></button> </td>

  </tr>";
        }

    }

    ?>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {




        $day = $_POST['day'];
        $year = $_POST['year'];
        
       
        

        Show_status($year, $day);


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