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
$sql = "SELECT * FROM `room` WHERE `room_no` = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $roomno = $row['room_no'];
    $allot = $row['alloted_to'];
   



}

  if($_SERVER['REQUEST_METHOD']=='POST'){
    // update the record
    $Roomno = $_POST['roomno'];
    $Allot = $_POST['allot'];
  

  
    
   // sql update

    $sql = "UPDATE `room` SET `room_no` = '$Roomno',  `alloted_to` = '$Allot' WHERE `room_no` = '$Roomno'";
    $result = mysqli_query($conn,$sql);
    if($result){
        $update = true;
 
      header('location:/project/room.php?updatelog='.$update.'');
    }
    else{
      echo "We could not updated the data";
    }
  }




?>
   
<!-- Update form -->

<div class="container my-4 p-4">
<form action="room_update.php" method="post">
<div class="form-group">
    <label for="roomno">Room No</label>
    <input type="text" class="form-control" id="roomno" name="roomno" value="<?php echo $roomno; ?>">

  </div>
  
  <div class="form-group">
<label for="year">Year</label>
  <select class="form-control" id ="year" name="allot" >

<?php 

for ($i=1; $i < 5; $i++) { 
    echo '<option>'.$i.'</option>';
}

?>
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


