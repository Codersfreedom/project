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
  <?php

  include 'partials/_header.php';
  if(!isset($_SESSION['logedin'])){
    header("location: index.php");
  }
  include 'partials/_nav.php';
  ?>
</head>

<div class="container d-flex justify-content-center my-4 p-4">
  <form class="form-inline" action="Routine.php" method="post">
    <div class="form-group mb-2">
      <label for="type" class="mx-3">Department</label>
      <select class="form-control" id="course" name="course">
        <option>CSE</option>
      </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <label for="type" class="mx-3">Year</label>
      <select class="form-control" id="year" name="year" value="">
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <label for="type" class="mx-3">Semester</label>
      <select class="form-control" id="sem" name="sem" value="">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Confirm</button>
  </form>

</div>


<?php



//function for checking status and allocating on routine table



function routine($year,$sem)
{

  require 'partials/dbconnect.php';
  $trSql="Truncate TABLE ". $year . "year_routine";
  $result1 = mysqli_query($conn, $trSql);
  $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

  foreach ($days as $day) {
    $daySql= "Insert into ". $year . "year_routine (day) values ('$day')";
    $result1 = mysqli_query($conn, $daySql);

    for ($i = 1; $i < 8; $i++) {
      $sql = "SELECT `fac_id` FROM `status` WHERE `slot$i` = 1 and `day` = '$day' and `year` = $year";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_assoc($result);


      if (isset($row['fac_id'])) {
        $faculty_id = $row['fac_id'];
        $subjectQuery = "SELECT subject.subject_name from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$faculty_id' and `sem` = $sem and subject.subject_type = 'Theory'" ;
        $subjectResult = mysqli_query($conn, $subjectQuery);
        $subjectRow = mysqli_fetch_assoc($subjectResult);

        if (isset($subjectRow['subject_name'])) {
          $subject_name = $subjectRow['subject_name'];
        }
        else{
          $subject_name='';
        }


        $facultyQuery = "SELECT `alias` FROM `faculty` WHERE `fac_id` = '$faculty_id'";
        $facultyResult = mysqli_query($conn, $facultyQuery);
        $facultyRow = mysqli_fetch_assoc($facultyResult);
        if (isset($facultyRow['alias'])) {
          $faculty = $facultyRow['alias'];
        }


        $data = "$subject_name($faculty)";
        // $sql="INSERT INTO ". $year . "year_routine (slot$i) values ('$data')";
        $sql = "UPDATE  " . $year . "year_routine SET `slot$i` =  '$data' WHERE `day`='$day'";

        $result = mysqli_query($conn, $sql);

      }


    }

    $sql = "SELECT * FROM  " . $year . "year_routine WHERE `slot1` = `slot2` = `slot3` = `slot4` and `day` = '$day'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (isset($row['slot1'])) {
      $subject = $row['slot1'];


      if ($row['slot1'] = $row['slot2'] = $row['slot3'] = $row['slot4']) {
        $faculty_query = "SELECT * FROM `sub_allot` WHERE `assign` = '$subject' and `sem` = $sem ";
        $facultyidResult = mysqli_query($conn, $faculty_query);
        $faculty_row = mysqli_fetch_assoc($facultyidResult);
        if (isset($faculty_row['fac_id'])) {
          $facultyId = $faculty_row['fac_id'];
       
        // inspite of not assign use where subject type = lab;
        $subject_query = "SELECT * from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$facultyId' and `sem` = $sem and subject.subject_type = 'Lab'";
        $subject_result = mysqli_query($conn, $subject_query);
        $subject_row = mysqli_fetch_assoc($subject_result); 
        if (isset($subject_row['subject_name'])) {
          
        
        $new_subject =$subject_row['subject_name'];
        $aliasQuery = "SELECT * FROM `faculty` WHERE `fac_id` = '$facultyId'";
        $aliasResult = mysqli_query($conn,$aliasQuery); 
        $alias_row =  mysqli_fetch_assoc($aliasResult );
        $alias = $alias_row['alias'];
        $data = "$new_subject($alias)";

        $update = "UPDATE  " . $year . "year_routine SET `slot1` ='' , `slot2` ='$data',`slot3` ='',`slot4` ='' WHERE `day`='$day'";
        $update_result = mysqli_query($conn, $update);
        }
}
      }



    }

  }

}


?>






<div class="container">
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


// function for display routine from table
function Generate_routine($year)
{

  require 'partials/dbconnect.php';

  $sql = "SELECT * FROM " . $year . "year_routine order by id asc";


  $result = mysqli_query($conn, $sql);



  while ($row = mysqli_fetch_assoc($result)) {

    echo "  <tr>   
      <th scope='row'>" . $row['day'] . "</th>
  <td>" . $row['slot1'] . "</td>
  <td>" . $row['slot2'] . "</td>
  <td>" . $row['slot3'] . "</td>
  <td>" . $row['slot4'] . "</td>
  <td>" . $row['slot5'] . "</td>
  <td>" . $row['slot6'] . "</td>
  <td>" . $row['slot7'] . "</td>

  </tr>";
  }

}

// Getting post request from dropdown menu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {




  $dept = $_POST['course'];
  $year = $_POST['year'];
  $sem = $_POST['sem'];

  routine($year,$sem);
  Generate_routine($year);


}




?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Initialize Data tables -->
<script>

  // $(document).ready(function () {
  //   $('#myTable').DataTable();
  //   "order": [];
  // });


  const year=document.querySelector('#year');
  const sem=document.querySelector('#sem');
  // if(year.value=='3'){
    sem.getElementsByTagName('option')[0].style.display="none";
    sem.getElementsByTagName('option')[1].style.display="none";
    sem.getElementsByTagName('option')[2].setAttribute('selected','true');
   
    sem.getElementsByTagName('option')[6].style.display="none";
    sem.getElementsByTagName('option')[5].style.display="none";
    sem.getElementsByTagName('option')[7].style.display="none";
    sem.getElementsByTagName('option')[4].style.display="none";
  // }
  year.addEventListener('change',()=>{
    if(year.value=='4'){
      console.log(year.value);
    sem.getElementsByTagName('option')[6].style.display="inline";
    sem.getElementsByTagName('option')[6].setAttribute('selected', 'true');
    sem.getElementsByTagName('option')[7].style.display="inline";
    sem.getElementsByTagName('option')[2].style.display="none";
    sem.getElementsByTagName('option')[3].style.display="none";
    sem.getElementsByTagName('option')[4].style.display="none";
    sem.getElementsByTagName('option')[5].style.display="none";
    sem.getElementsByTagName('option')[4].removeAttribute('selected');
    sem.getElementsByTagName('option')[2].removeAttribute('selected');
    }
    else if(year.value=='3'){
      console.log(year.value);
    sem.getElementsByTagName('option')[4].style.display="inline";
    sem.getElementsByTagName('option')[4].setAttribute('selected', 'true');
    sem.getElementsByTagName('option')[5].style.display="inline";
    sem.getElementsByTagName('option')[6].style.display="none";
    sem.getElementsByTagName('option')[7].style.display="none";
    sem.getElementsByTagName('option')[2].style.display="none";
    sem.getElementsByTagName('option')[3].style.display="none";
    sem.getElementsByTagName('option')[6].removeAttribute('selected');
    sem.getElementsByTagName('option')[2].removeAttribute('selected');
    }
    else if(year.value=='2'){
      console.log(year.value);
    sem.getElementsByTagName('option')[2].style.display="inline";
    sem.getElementsByTagName('option')[2].setAttribute('selected', 'true');
    sem.getElementsByTagName('option')[3].style.display="inline";
    sem.getElementsByTagName('option')[4].style.display="none";
    sem.getElementsByTagName('option')[6].style.display="none";
    sem.getElementsByTagName('option')[7].style.display="none";
    sem.getElementsByTagName('option')[5].style.display="none";
    sem.getElementsByTagName('option')[4].removeAttribute('selected');
    sem.getElementsByTagName('option')[6].removeAttribute('selected');
    }
  }) 
</script>
