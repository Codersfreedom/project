<body>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
    Add Teacher
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Enter The Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="teacher.php" method="post">
            <div class="form-group">
              <label for="facid">Faculty id</label>
              <input type="text" class="form-control" id="facid" name="facid" placeholder="Enter the Faculty id">

            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter the full name">
            </div>

            <div class="form-group">
              <label for="alias">Alias</label>
              <input type="text" class="form-control" id="alias" name="alias" placeholder="Enter the Alias name">
            </div>

            <div class="form-group">
              <label for="designation">Designation</label>
              <select class="form-control" id="designation" name="designation">
                <option>Professor</option>
                <option>Asst. Professor</option>
              </select>
            </div>
            <div class="form-group">
              <label for="experience">Experience</label>
              <select class="form-control" id="experience" name="experience">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>

            <div class="form-group d-flex flex-column">
              <label for="basic">Basic Salary</label>
              <input class="p-2" placeholder="Enter basic salary" type="number" name="basic" id="basic"
                style="border: .5px solid #dadada;">
            </div>
            <div class="form-group">
              <label for="workload">Workload</label>
              <input type="number" class="form-control" id="workload" name="workload" placeholder="Enter Workload">
            </div>

            <div class="form-group">
              <label for="ph">Phone No.</label>
              <input type="number" class="form-control" id="ph" name="ph" placeholder="Enter the phone number">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email address">
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter the address">
            </div>

            <div class="form-group">
              <label for="area">Area</label>
              <select class="form-control" id="area" name="area" required >
                <option value="m" >Metropoliton</option>
                <option value="u" >Urban</option>
                <option value="r" >Rural</option>
               
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>