
 
   
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
  Add Subject
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enter The Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="subject.php" method="post">
  <div class="form-group">
    <label for="facid">Subject Code</label>
    <input type="text" class="form-control" id="facid" name="subcode" placeholder="Enter the Subject code">

  </div>
  <div class="form-group">
    <label for="name">Subject Name</label>
    <input type="text" class="form-control" id="name" name="subname" placeholder="Enter the subject name">
  </div>

  <div class="form-group">
<label for="select">Course Type</label>
  <select class="form-control" id ="select" name="type" >
  <option>Theory</option>
  <option>Lab</option>
  <option>Sessional</option>
</select>
</div>


  <div class="form-group">
<label for="select">Semester</label>
  <select class="form-control" id ="select" name="sem" >
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
    <input type="number" class="form-control" id="hpw" name="hpw" placeholder="Enter total hours per week">
  </div>

<div class="form-group">
<label for="select">Department</label>
  <select class="form-control" id ="select" name="dept" >
  <option>CSE</option>
  <option>ECE</option>
  <option>ME</option>
  <option>CYBER SEQURITY</option>
</select>
</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>

    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


