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

// if(isset($_GET['updateid'])){
 $id = $_GET['updateid'];
$sql = "SELECT * FROM `faculty` WHERE `fac_id` = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$facid = $row['fac_id'];
$name = $row['name'];
$designation = $row['designation'];
$alias = $row['alias'];
$email = $row['email'];
$phone = $row['phone'];



// }

  if($_SERVER['REQUEST_METHOD']=='POST'){
    // update the record
    $Facid = $_POST['facid'];
    $Name = $_POST['name'];
    $Designation = $_POST['designation'];
    $Alias = $_POST['alias'];
    $Email = $_POST['email'];
    $Phone = $_POST['ph'];

  
    
   // sql update

    $sql = "UPDATE `faculty` SET `fac_id` = '$Facid' ,`name` = '$Name', `designation` = '$Designation' , `alias` = '$Alias', `email` = '$Email', `phone` ='$Phone'  WHERE `faculty`.`fac_id` = $Facid";
    $result = mysqli_query($conn,$sql);
    if($result){
        $update = true;
 
      header('location:/project/teacher.php?updatelog='.$update.'');
    }
    else{
      echo "We could not updated the data";
    }
  }




?>
   
<!-- Button trigger modal -->

<div class="container my-4 p-4">
<form action="fac_update.php" method="post">
  <div class="form-group">
    <label for="facid">Faculty id</label>
    <input type="number" class="form-control" id="facid" name="facid" value="<?php echo $facid; ?>">

  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
  </div>

  <div class="form-group">
    <label for="alias">Alias</label>
    <input type="text" class="form-control" id="alias" name="alias" value="<?php echo $alias; ?>">
  </div>

<div class="form-group">
<label for="select">Designation</label>
  <select class="form-control" id ="select" name="designation"  >
  <option value="none" selected disabled hidden><?php echo $designation; ?></option>
  <option>Professor</option>
  <option>Asst. Professor</option>
</select>
</div>


  <div class="form-group">
    <label for="ph">Phone No.</label>
    <input type="number" class="form-control" id="ph" name="ph" value="<?php echo $phone; ?>">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
  </div>
  <button type="submit" name="update" class="btn btn-primary">Submit</button>

     
</form>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


