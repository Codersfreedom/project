<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <title>Rooms</title>
  </head>
  <body>
<?php
include 'partials/_header.php';
if(!isset($_SESSION['logedin'])){
  header("location: index.php");
}
require 'partials/dbconnect.php';

$insert = false;
$showError='false';

if(!isset($_SESSION['logedin'])){
  header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$roomid = $_POST['room'];
$dept = $_POST['dept'];
$year = $_POST['year'];

$alloted = $dept.' '. $year;

// Check if room is already allocated or not

$existsql = "SELECT * FROM `room` WHERE `room_no` = '$roomid'";
$existresult = mysqli_query($conn, $existsql);
$num = mysqli_num_rows($existresult);
if ($num > 0) {
    $ShowError= "Room  is already allocated.";
    header("location: room.php?insertlog='.$ShowError.'");
}

else{
$sql = "INSERT INTO `room`(`room_no`, `alloted_to`,`year`) VALUES ('$roomid','$alloted','$year')";
$result = mysqli_query($conn, $sql);


if ($result) {
  $insert = true;

  
} else {
  $showError = "Can't insert";
  header("location: room.php?insertlog='.$ShowError.'");

}
}
}

  // Delete function

  
  if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `room` WHERE `room_no` = '$sno'";
    $result = mysqli_query($conn, $sql);
  }
  


?>

<?php include 'partials/_nav.php'; 
if($insert){

  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Inserted successfully.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif(isset($_GET['insertlog'])){

  $log = $_GET['insertlog'];
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Error!.</strong> '.$log.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif(isset($_GET['updatelog']) == 'true'){



echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Successfully Updated.</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';

}




?>



<div class="container text-center my-4 p-4">
    <?php include 'partials/room_modal.php' ?>

    </div>
    <!-- Table to display data -->

<div class="container p-5">

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Room No</th>
      <th scope="col">Alloted To</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
   
   $sql = "SELECT * FROM `room`";
   $result= mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($result)) {


      echo "   <tr>
            <th scope='row'>" . $row['room_no'] . "</th>
            <td> B.tech " . $row['alloted_to'] .' '.'year'. "</td>
       
            <td><button class = 'edit btn btn-sm btn-primary' name = 'edit'> <a class = 'text-light'href='partials/room_update.php?updateid=" . $row['room_no'] . "'>Update</a></button>  <button class='delete btn btn-sm btn-primary' id=d" . $row['room_no'] . ">Delete</button>  </td>
        
          </tr>";


    }
    ?>
  </tbody>
</table>
</div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Datatables -->
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  
<!-- Initializint Data tables -->
<script>

  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>


<script>

deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `room.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })

  </script>

  </body>
</html>