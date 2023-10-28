<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <title>Routine</title>
</head>



<?php
require 'partials/dbconnect.php';

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];


//for 3rd year routine (wrap within a function)

foreach ($days as $day) {


  for ($i = 1; $i < 8; $i++) {

    $sql = "SELECT `fac_id` FROM `status` WHERE `slot$i` = 1 and `day` = '$day' and `year` = 3";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    
   
      echo $faculty_id = $row['fac_id'];
      $subjectQuery = "SELECT subject.subject_name from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$faculty_id'";
      $subjectResult = mysqli_query($conn,$subjectQuery);
      $subjectRow = mysqli_fetch_assoc($subjectResult);
      
      if(isset($subjectRow['subject_name'])){
        $subject_name = $subjectRow['subject_name'];
      }
      else{
        echo('');
      
      }

    
      $facultyQuery = "SELECT `alias` FROM `faculty` WHERE `fac_id` = '$faculty_id'";
      $facultyResult = mysqli_query($conn,$facultyQuery);
      $facultyRow = mysqli_fetch_assoc($facultyResult);
      if(isset($facultyRow['alias'])){
        $faculty = $facultyRow['alias']; 
      }
      else{
        echo('');
      }
     

      $data = "$subject_name($faculty)";
     

      $sql = "UPDATE `routine` SET `slot$i` =  '$data' WHERE `day`='$day'";




      $result = mysqli_query($conn, $sql);

  


  }

$sql = "SELECT * FROM `routine` WHERE `slot1` = `slot2` = `slot3` = `slot4` and `day` = '$day'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$subject = $row['slot1'];
if($row['slot1']=$row['slot2']=$row['slot3']=$row['slot4']){
  $faculty_query="SELECT * FROM `sub_allot` WHERE `assign` = '$subject'";
  $facultyidResult = mysqli_query($conn,$faculty_query);
  $faculty_row = mysqli_fetch_assoc($facultyidResult);
  $facultyId = $faculty_row['fac_id'];

  $subject_query = "SELECT * FROM `sub_allot` WHERE `fac_id` = '$facultyId' AND NOT `assign` = '$subject'";
  $subject_result = mysqli_query($conn,$subject_query);
  $subject_row = mysqli_fetch_assoc($subject_result);
  if(isset($subject_row['assign'])){
    $new_subject = $subject_row['assign'];  
    $update = "UPDATE `routine` SET `slot1` ='' , `slot2` ='$new_subject',`slot3` ='',`slot4` ='' WHERE `day`='$day'" ;
  $update_result = mysqli_query($conn,$update);
  }
  else{
    break;
  }
 



}

}

?>


<?php


?>




<!-- echo "<h1>Generated Class Schedule</h1>"; -->
<div class="container p-5">
  <h1 class="text-center my-3">Generated Class Schedule</h1>

  <table class="table" id="myTable">
    <thead>
      <tr>

        <th scope="col">Days</th>
        <th scope="col">Period 1</th>
        <th scope="col">Period 2</th>
        <th scope="col">Period 3</th>
        <th scope="col">Period 4</th>
        <th scope="col">Period 5</th>
        <th scope="col">Period 6</th>
        <th scope="col">Period 7</th>

      </tr>
    </thead>
    <tbody>
</div>
<?php



// $sql = "SELECT * FROM `3year_routine` ORDER BY 
// CASE `day` WHEN 'Monday' THEN 0
//   WHEN 'Tuesday ' THEN 1
//   WHEN 'Wednesday  ' THEN 2
//   WHEN 'Thursday  ' THEN 3
//   WHEN 'Friday ' THEN 4
//   WHEN 'Saturday ' THEN 5
// END";

// $result = mysqli_query($conn, $sql);

// $row = mysqli_fetch_assoc($result);

// foreach ($days as $day) {

//   $sql = "SELECT * FROM `3year_routine` WHERE  day= '$day' ";

//   $result = mysqli_query($conn, $sql);

//   $row = mysqli_fetch_assoc($result);

//   for ($i = 1; $i < 8; $i++) {
//     $fac = $row['slot' . $i . ''];

//     $fetchSubject = "SELECT subject.subject_name from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$fac';";
//     $fetchResult = mysqli_query($conn, $fetchSubject);
//     $subjectRow = mysqli_fetch_assoc($fetchResult);
//     if (isset($subjectRow['subject_name'])) {

//       echo $subjectRow['subject_name'];


//     } else {
//       echo (' ');
//     }




//   }
// }



  // echo "  <tr>   
  //       <th scope='row'>" . $row['day'] . "</th>
  //   <td>" . $row['slot1'] . "</td>
  //   <td>" . $row['slot2'] . "</td>
  //   <td>" . $row['slot3'] . "</td>
  //   <td>" . $row['slot4'] . "</td>
  //   <td>" . $row['slot5'] . "</td>
  //   <td>" . $row['slot6'] . "</td>
  //   <td>" . $row['slot7'] . "</td>

  //   </tr>";




?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Initializint Data tables -->
<script>

  $(document).ready(function () {
    $('#myTable').DataTable();
    "order": []
  });



</script>