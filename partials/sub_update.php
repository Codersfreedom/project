<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  
  </head>
  <body>

  <?php
include 'dbconnect.php';

$update = false;
$ShowError = 'false';

if(isset($_GET['updateid'])){
 $id = $_GET['updateid'];
$sql = "SELECT * FROM `subject` WHERE `subject_code` = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $subcode = $row['subject_code'];
    $subname = $row['subject_name'];
    $type = $row['subject_type'];
    $sem = $row['semester'];
    $dept = $row['dept'];
    $hpw = $row['h_per_w'];



}

  if($_SERVER['REQUEST_METHOD']=='POST'){

    // get the values from update form
    $Subcode = $_POST['subcode'];
    $Subname = $_POST['subname'];
    $Type = $_POST['course'];
    $Sem = $_POST['sem'];
    $Dept = $_POST['dept'];
    $hours= $_POST['hpw'];

  
    
   // sql update

    $sql = "UPDATE `subject` SET `subject_code` = '$Subcode' ,`subject_name` = '$Subname', `subject_type` = '$Type', `semester` = '$Sem' , `h_per_w` = $hours   WHERE `subject`.`subject_code` = '$Subcode'";
    $result = mysqli_query($conn,$sql);
    if($result){
        $update = true;
 
      header('location:/project/subject.php?updatelog='.$update.'');
    }
    else{
      echo "We could not updated the data";
    }
  }




?>
   
<!-- Update form -->

<div class="container my-4 p-4">
<form action="sub_update.php" method="post">
<div class="form-group">
    <label for="subcode">Subject Code</label>
    <input type="text" class="form-control" id="subcode" name="subcode" value="<?php echo $subcode; ?>">

  </div>
  <div class="form-group">
    <label for="subname">Subject Name</label>
    <input type="text" class="form-control" id="subname" name="subname" value="<?php echo $subname; ?>">
  </div>

  <div class="form-group">
<label for="type">Course Type</label>
  <select class="form-control" id ="type" name="course" >
  <option  selected   ><?php echo $type; ?></option>
  <option>Theory</option>
  <option>Lab</option>
</select>
</div>


  <div class="form-group">
<label for="sem">Semester</label>
  <select class="form-control" id ="sem" name="sem" >
  <option  selected  ><?php echo $sem; ?></option>
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

<div class="form-group">
    <label for="hpw">Hours Per Week</label>
    <input type="number" class="form-control" id="hpw" name="hpw" value="<?php echo $hpw; ?>" placeholder="Enter total hours per week">
  </div>

<div class="form-group">
<label for="dept">Department</label>
  <select class="form-control" id ="dept" name="dept" >
  <option  selected ><?php echo $dept; ?></option>
  <option>CSE</option>
  <option>ECE</option>
  <option>ME</option>
  <option>CYBER SEQURITY</option>
</select>
</div>

<button type="submit" class="btn btn-primary">Submit</button> 
</form>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


