<?php
require 'dbconnect.php';
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
  Allot Subject
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subject Allotment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="theory.php" method="post">





          <div class="form-group">
            <label for="subname">Subject name</label>
            <select class="form-control" id="subname" name="subname">
              <option value='none' hidden>Choose Subject</option>
              <?php

              $sql = "SELECT `subject_name` from `subject`";
              $result = mysqli_query($conn, $sql);


              while ($row = mysqli_fetch_assoc($result)) {

                echo "
       
       <option class='sname'>
       " . $row['subject_name'] . "
       </option>
       ";

              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="allotTeacher">Allocate teacher</label>
            <select class="form-control" id="allotTeacher" name="allotTeacher">
            <option value="none" hidden>Choose Teacher</option>


              <?php

              $sql = "SELECT `name` from `faculty`";
              $result = mysqli_query($conn, $sql);


              while ($row = mysqli_fetch_assoc($result)) {

                echo "
       
       <option >
       " . $row['name'] . "
       </option>
       ";

              }
              ?>

            </select>
          </div>

          <div class="form-group">
            <label for="subname">Semester</label>
            <select class="form-control" id="sem" name="sem">
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

          <div class="form-group" id='pday' style="display:none;">
            <label for="prefDay">Preference Day</label>
            <select class="form-control" id="prefDay" name="prefDay">
              <option value="false">No Preference</option>
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <option value="Friday">Friday</option>
              <option value="Saturday">Saturday</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id='sub-btn'>Submit</button>
      </div>
      </form>

    </div>
  </div>
</div>
<script>
  const sub=document.querySelector("#subname");
  const prefDays = document.querySelector('#pday')
  sub.addEventListener('change',()=>{
    if(sub.value.includes('Lab')){
      prefDays.style.display="block";
      console.log(sub.value);
    }
    else{
      prefDays.style.display="none";
    }
  })
  const btn=document.querySelector('#sub-btn');
  const fac=document.querySelector('#allotTeacher')
  const myinterval=setInterval(()=>{
    if(sub.value=='none' || fac.value=='none'){
      btn.disabled=true;
    }
    else{
      btn.disabled=false;
      clearInterval(myinterval);
    }
  },1000)
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>