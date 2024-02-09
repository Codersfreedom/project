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
    <title>Payrole</title>
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
    select{
        width: 70px;
        height: 30px;
        border-radius: 3px;
        padding: 5px;
    }
   #year{
    margin-left: 10px;
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
    </div>
    <div class="container d-flex my-5 pt-4 align-items-center justify-content-center">
        <div class="year-box">
            <label for="year">Year</label>
        <select name="year" id="year">
            <option value="2020">2021</option>
            
        </select> 
        </div>
       
    </div>
    <div class="container p-5 mt-5 ">
        <?php
            //? Getting Basic salary from database
            $facSalSql="SELECT fac_id, basic_salary FROM faculty";
            $facSalResult=mysqli_query($conn,$facSalSql);
            
            //* Faculty and basic salary associative array
            $facSal= array();
            while($facSalRow=mysqli_fetch_assoc($facSalResult)){
                $facSal[$facSalRow['fac_id']] = $facSalRow['basic_salary'];
            }
            function payroll($conn, $facSal){

            

            //* Current month taking
            $currMonth=3;
            
            foreach($facSal as $fs){
                
                if($currMonth==1){
                    $calMonth=12;
                    $calYear=date('Y')-1;
                    $salPerDay=$fs/31;
                    echo $salPerDay."<br>";
                }
                else{
                    $calMonth=$currMonth-1;
                    $calYear=date('Y');
                    // $calYear=2023;
                    //?
                    if($calMonth==2){
                        if(year_check($calYear)){
                            $salPerDay=$fs/29;
                            echo $salPerDay."<br>";
                        }else{
                            $salPerDay=$fs/28;
                            echo $salPerDay."<br>";
                        }
                    }
                    elseif($calMonth==4 || $calMonth==6 || $calMonth==9 || $calMonth==11){
                        $salPerDay=$fs/30;
                        echo $salPerDay."<br>";
                    }
                    else{
                        $salPerDay=$fs/31;
                        echo $salPerDay."<br>";
                    }
                    
                }
            }




        }
        
        //? Leap Year Check
        function year_check($my_year){
            if ($my_year % 400 == 0)
               return true;
            else if ($my_year % 100 == 0)
               return false;
            else if ($my_year % 4 == 0)
              return true;
            else
               return false;
         }

        //? Salary Calculation Function
        function SalaryCalculation($facSal){
            print_r($facSal);
        }

        SalaryCalculation($facSal);
        payroll($conn,$facSal);





        ?>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pay Month</th>
                    <th scope="col">Pay Ammount </th>
                    <th scope="col">Year</th>
                    <th scope="col">Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'select *from faculty';
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "   <tr>
            <td>" . $row['name'] . "</td>
            <td>  </td>
            <td> </td>
            <td>  </td>
            <td> </td>
            <td> </td>
        
          </tr>";
                }
                ?>


            </tbody>
        </table>
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