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
    <title>Payroll</title>
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
        width: 85px;
        height: 35px;
        border-radius: 3px;
        padding: 5px;
        text-align: center;
    }

    #year {
        width: 120px;

    }

    input[type="datetime-local"] {
        height: 35px;
        border-radius: 3px;
        padding: 5px;
        border: 1px solid #dadada;
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

    /* #date{
        width: 150px;
    } */
</style>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbar-bg="skin5" data-sidebar-type="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php
        include 'header.php';
        require 'partials/dbconnect.php';
        include 'aside.php';
        ?>

        <div class="container d-flex my-5 pt-4 align-items-center justify-content-center">
            <div class="year-box">
                <form action="Payroll.php" method="post">
                    <label for="year">Year</label>
                    <select name="year" id="year">
                        <?php
                        $sql = "select Distinct financial_year from payroll";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=" . $row['financial_year'] . ">" . $row['financial_year'] . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class='btn btn-primary '>Confirm</button>
                </form>
            </div>

        </div>
        <div class="container p-5 mt-5  text-nowrap text-center ">
            <?php
            //? Current Month
            //TODO: Change the month to current month
            $currMonth = 1;
            //? Current Year
            $currYear = 2025;
            //? getting fac_id from faculty table
            $faculty = array();
            $facSql = "SELECT fac_id FROM faculty";
            $facRes = mysqli_query($conn, $facSql);
            while ($facRow = mysqli_fetch_assoc($facRes)) {
                array_push($faculty, $facRow['fac_id']);
            }

            // print_r($faculty);
            
            //? Getting Basic salary from database
            $facSalSql = "SELECT fac_id, basic_salary FROM faculty";
            $facSalResult = mysqli_query($conn, $facSalSql);

            //* Faculty and basic salary associative array
            $facSal = array();
            while ($facSalRow = mysqli_fetch_assoc($facSalResult)) {
                $facSal[$facSalRow['fac_id']] = $facSalRow['basic_salary'];
            }

            //? Getting Attendance from database
            $calMonth = $currMonth - 1;
            if ($currMonth == 1) {
                $calMonth = 12;
            }

            $facAtt = array();

            $crYear = $currYear;
            if ($currMonth == 1) {
                $crYear = $crYear - 1;
            }
            foreach ($faculty as $fac) {
                $facAttSql = "SELECT count(attendance) as att FROM attendance where fac_id='$fac' and month=$calMonth and year=$crYear and attendance=1";
                $facAttResult = mysqli_query($conn, $facAttSql);
                //* Faculty and attendance associative array
                while ($facAttRow = mysqli_fetch_assoc($facAttResult)) {
                    $facAtt[$fac] = $facAttRow['att'];
                }
            }

            // print_r($facAtt);
            

            function payroll($conn, $facSal, $currMonth, $facAtt)
            {

                //* Current month taking
                // echo $currMonth;
                global $currYear;
                foreach ($facSal as $fac => $fs) {

                    if ($currMonth == 1) {
                        $calMonth = 12;
                        $calYear = $currYear - 1; //! need to change
                        $salPerDay = $fs / 31;

                        $Attendance = isset($facAtt[$fac]) ? $facAtt[$fac] : 0;
                        // echo $Attendance;
                        // echo "<br/>";
                        SalaryCalculation($conn, $fac, $fs, $salPerDay, $Attendance, $calMonth, $calYear);
                        //echo "<br>";
                    } else {
                        $calMonth = $currMonth - 1;
                        $calYear = date('Y');
                        // $calYear=2023;
                        //?
                        if ($calMonth == 2) {
                            if (year_check($calYear)) {
                                $salPerDay = $fs / 29;
                                //echo "<br>". $salPerDay . "</br>";
                                $Attendance = isset($facAtt[$fac]) ? $facAtt[$fac] : 0;
                                SalaryCalculation($conn, $fac, $fs, $salPerDay, $Attendance, $calMonth, $calYear);
                                //echo "<br>";
                            } else {
                                $salPerDay = $fs / 28;
                                //echo "<br>". $salPerDay . "</br>";
                                $Attendance = isset($facAtt[$fac]) ? $facAtt[$fac] : 0;
                                SalaryCalculation($conn, $fac, $fs, $salPerDay, $Attendance, $calMonth, $calYear);
                                //echo "<br>";
                            }
                        } elseif ($calMonth == 4 || $calMonth == 6 || $calMonth == 9 || $calMonth == 11) {
                            $salPerDay = $fs / 30;
                            //echo "<br>". $salPerDay . "</br>";
                            $Attendance = isset($facAtt[$fac]) ? $facAtt[$fac] : 0;
                            SalaryCalculation($conn, $fac, $fs, $salPerDay, $Attendance, $calMonth, $calYear);
                            //echo "<br>";
                        } else {
                            $salPerDay = $fs / 31;
                            // echo "<br>". $salPerDay . "</br>";
                            $Attendance = isset($facAtt[$fac]) ? $facAtt[$fac] : 0;
                            SalaryCalculation($conn, $fac, $fs, $salPerDay, $Attendance, $calMonth, $calYear);
                            //echo "<br>";
                        }

                    }
                }

            }

            //? Leap Year Check
            function year_check($my_year)
            {
                if ($my_year % 400 == 0)
                    return true;
                else if ($my_year % 100 == 0)
                    return false;
                else if ($my_year % 4 == 0)
                    return true;
                else
                    return false;
            }

            //? Tax Calculation Function 
            /**
             * @param $conn
             * @param $facSal is basic salary of faculty
             * @param $fac_id is faculty id
             */
            function taxCalculation($facSal, $fac_id, $conn)
            {
                $gross = $facSal + ($facSal * 46) / 100;
                $pf = ($gross * 12) / 100;
                $pt = 200;
                $taxable = ($gross - ($pf + $pt)) * 12;
                $tax = 0;
                if ($taxable > 300000 && $taxable <= 600000) {
                    $tax = ($taxable - 300000) * 5 / 100;
                } elseif ($taxable > 600000 && $taxable <= 900000) {
                    $tax = 15000 + ($taxable - 600000) * 10 / 100;
                } elseif ($taxable > 900000 && $taxable <= 1200000) {
                    $tax = 45000 + ($taxable - 900000) * 15 / 100;
                } elseif ($taxable > 1200000 && $taxable <= 1500000) {
                    $tax = 90000 + ($taxable - 1200000) * 20 / 100;
                } elseif ($taxable > 1500000) {
                    $tax = 150000 + ($taxable - 1500000) * 30 / 100;
                }


                return $tax / 12;
                // echo $totalTax;
            
            }




            $financialYear = "";
            if ($currMonth > 3) {
                $financialYear = $currYear . "-" . $currYear + 1;
            } else {
                $financialYear = $currYear - 1 . "-" . $currYear;
            }
            //? Salary Calculation Function
            function SalaryCalculation($conn, $fac_id, $facSal, $salPerDay, $att, $calMonth, $calYear)
            {

                $monthlySal = $salPerDay * $att;
                $da = 46;
                if ($att == 0) {
                    //echo "0";
                    return 0;
                }
                $grossSal = $monthlySal + ($facSal * $da) / 100;
                $pf = ($grossSal * 12) / 100;
                $pt = 200;
                $newSal = ceil($grossSal - ($pf + $pt));
                $tax = taxCalculation($facSal, $fac_id, $conn);
                $newSal = $newSal - $tax;
                global $financialYear;
                $payrollSql = "INSERT INTO payroll (fac_id,payAmount,payMonth,tax,financial_year,status) VALUES ('$fac_id',$newSal,$calMonth,$tax,'$financialYear',0)";
                $payrollResult = mysqli_query($conn, $payrollSql);

                //echo ($newSal);
            }

            $calMonth = $currMonth - 1;
            if ($currMonth == 1) {
                $calMonth = 12;
            }
            $payrollExistSql = "select *from payroll where payMonth = $calMonth";
            $payrollExistResult = mysqli_query($conn, $payrollExistSql);
            if (mysqli_num_rows($payrollExistResult) < 1) {
                payroll($conn, $facSal, $currMonth, $facAtt);
            }
            // payroll($conn, $facSal, $currMonth, $facAtt);
            
            $year = $currYear;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['year'])) {
                    $year = $_POST['year'];

                }

            }

            ?>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Sno.</th>
                        <th scope="col"> Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Pay Month</th>
                        <th scope="col">Pay Date</th>
                        <th scope="col">Pay Amount</th>
                        <th scope="col">Year</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currYear = date('Y');
                    $financialYear = $currYear - 1 . "-" . $currYear;

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['year'])) {
                            $financialYear = $_POST['year'];
                        }
                    }

                    
                    $sql = "SELECT faculty.name as faculty , payroll.* from faculty inner join payroll on faculty.fac_id = payroll.fac_id where payroll.financial_year ='$financialYear' order by payroll.slNo asc ";
                    $result = mysqli_query($conn, $sql);
                    $sr = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $month = date_create_from_format("m", $row['payMonth']);
                        $date = date_parse($row['pay_date']);
                        $monthNo = $date['month'] < 10 ? "0" . $date['month'] : $date['month'];
                        $day = $date['day'] < 10 ? "0" . $date['day'] : $date['day'];
                        $Date = $date['year'] . "-" . $monthNo . "-" . $day;
                        $hour = $date['hour'] < 10 ? "0" . $date['hour'] : $date['hour'];
                        $minute = $date['minute'] < 10 ? "0" . $date['minute'] : $date['minute'];
                        $time = $hour . ":" . $minute;
                        echo "   <tr>
                        
                        <form action='Payroll.php' method='post'>
                        <input type='hidden' name='payAmount' value='" . $row['payAmount'] . "'>
                        <input type='hidden' name='month' value='" . $row['payMonth'] . "'>
            <td>" . $sr . "</td>
            <td>  " . $row['fac_id'] . " <input type='hidden' name='faculty'value='" . $row['fac_id'] . "'> </td>
            <td>" . $row['faculty'] . " </td>
            <td>" . date_format($month, "F") . " </td>
            <td> <input type='datetime-local' name='date' value = '";
                        echo $row['status'] == 1 ? $Date . "T" . $time : "";
                        echo "' id='date'> </td>
            <td> &#8377; " . $row['payAmount'] . "</td>
            <td>" . $row['financial_year'] . " </td>
            <td><select id='status' name='status'>
            <option value ='0' >Pending</option>
            <option value ='1'";
                        echo $row['status'] == 1 ? 'selected' : '';
                        echo " >Paid</option>
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

    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['faculty']) && isset($_POST['date']) && isset($_POST['status'])) {

            $facId = $_POST['faculty'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            $newSal = $_POST['payAmount'];
            $month = $_POST['month'];
            $sql = "UPDATE `payroll` SET `pay_date`='$date',`status`='$status' WHERE `fac_id` ='$facId'";
            $res = mysqli_query($conn, $sql);

        }





    }

    ?>
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
                    orientation: "landscape",
                    downlode: 'open'
                },
                'print'
            ]
        });
    });



</script>


</html>