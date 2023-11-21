
  <!-- Button trigger modal -->
 

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
          <form  method="post">
            <div class="form-group">
              <label for="days">Day</label>
              <input type="text" class="form-control" readonly id="days"  name="day" placeholder="Enter the Faculty id">
            </div>
            <div class="form-group">
              <label for="facid">Faculty id</label>
              <input type="text" class="form-control" id="facid" name="facid" readonly  placeholder="Enter the Faculty id">
            </div>

            <div class="form-group">
              <label for="select">Slot</label>
              <select class="form-control" id="select" name="slot">
                <option>slot1</option>
                <option>slot2</option>
                <option>slot3</option>
                <option>slot4</option>
                <option>slot5</option>
                <option>slot6</option>
                <option>slot7</option>
              </select>
            </div>   
            <div class="form-group">
              <label for="select">Status</label>
              <select class="form-control" id="select" name="status">
                <option value='1'>Available</option>
                <option value='0'>Not Available</option>
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
