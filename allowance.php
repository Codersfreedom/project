<?php
require 'partials/dbconnect.php';
$updatelog = false;

if($_SERVER['REQUEST_METHOD']=='POST'){

    $da = $_POST['da'];
    $pf = $_POST['pf'];
    $pt = $_POST['pt'];
    $hra = $_POST['hra'];
    $ma = $_POST['ma'];
    $hrax = $_POST['hrax'];
    $hray =$_POST['hray'];
    $hraz = $_POST['hraz'];
}

    
    $sql = "Update allowance set Dearness_allowance =$da, Professional_tax = $pt, Provident_fund=$pf, House_rent_allowance_X=$hrax, House_rent_allowance_Y =$hray ,House_rent_allowance_Z=$hraz,  Medical_allowance=$ma";
    $result = mysqli_query($conn,$sql);

    if($result){
        $updatelog = true;
        header("location:Admin_panel.php?updateLog=".$updatelog);
    }

?>