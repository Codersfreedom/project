<?php
require 'partials/dbconnect.php';

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];


//for 3rd year routine (wrap within a function)

foreach ($days as $day) {


  for ($i = 1; $i < 8; $i++) {

    $sql = "SELECT * FROM `status` WHERE slot$i = 1 and day= '$day' and year = 3";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if (isset($row['fac_id'])) {
      $faculty_id = $row['fac_id'];
      $sql = "UPDATE `3year_routine` SET `slot$i` =  '$faculty_id' WHERE `day`='$day'";
      $result = mysqli_query($conn, $sql);

    } else {
      break;
    }


  }



}





?>

<!-- echo "<h1>Generated Class Schedule</h1>"; -->
<div class="container p-5">
  <h1>Generated Class Schedule</h1>

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

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
foreach ($days as $day ) {
 for ($i=1; $i < 8; $i++) { 
  $sql = "SELECT * FROM `3year_routine` WHERE  day= '$day'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $fac = $row['slot'.$i.''];
  echo $fac;
 $fetchSubject = "SELECT subject.subject_name from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$fac';";
  $fetchResult = mysqli_query($conn,$fetchSubject);
  $subjectRow = mysqli_fetch_assoc($fetchResult);  
  if(isset($subjectRow['subject_name'])){
   //echo $subjectRow['subject_name']; 
  }else{
    break;
  }
  
  


  
 }
}

// while($row = mysqli_fetch_assoc($result)) {
// for ($i=1; $i < 8; $i++) { 
// $fac = $row['slot'.$i.''];
//  $fetchSubject = "SELECT subject.subject_name from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$fac';";
//   $fetchResult = mysqli_query($conn,$fetchSubject);
//   $subjectRow = mysqli_fetch_assoc($fetchResult);  
// }
 
 


  // echo "  <tr>
  //       <th scope='row'>" . $row['day'] . "</th>
  //   <td>" . $subjectRow["subject_name"] . "</td>
  //   <td>"  . $subjectRow["subject_name"] ."</td>
  //   <td>"  . $subjectRow["subject_name"] . "</td>
  //   <td>"  . $subjectRow["subject_name"] . "</td>
  //   <td>"  . $subjectRow["subject_name"] . "</td>
  //   <td>"  . $subjectRow["subject_name"] . "</td>
  //   <td>"  . $subjectRow["subject_name"] . "</td>
   
  //   </tr>";


  // }


?>