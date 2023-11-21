<!-- Button trigger modal -->


<!-- Modal -->

<style>


  .selectBox {
    position: relative;
  }

  .selectBox select {
    width: 100%;
    font-weight: bold;
  }

  .overSelect {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
  }

  #checkboxes {
    display: none;
    border: 1px #dadada solid;
    padding: 5px;
  }

  #checkboxes label {
    display: block;
  }

  #checkboxes label:hover {
    background-color: #1e90ff;
  }
</style>


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
        <form method="post">
          <div class="form-group">
            <label for="days">Day</label>
            <input type="text" class="form-control" readonly id="days" name="day" placeholder="Enter the Faculty id">
          </div>
          <div class="form-group">
            <label for="facid">Faculty id</label>
            <input type="text" class="form-control" id="facid" name="facid" readonly placeholder="Enter the Faculty id">
          </div>



          <div class="form-group">
            <div class="selectBox" onclick="showCheckboxes()">
              <label for="select">Slot</label>
              <select>
                <option>Select an option</option>
              </select>
              <div class="overSelect"></div>
            </div>
            <div id="checkboxes">
              
              <label for="one">
                <input type="checkbox" value="slot1"  id="one" name="slot1" />Period 1</label>
              <label for="two">
                <input type="checkbox" value="slot2" id="two" name="slot2" />Period 2</label>
              <label for="three">
                <input type="checkbox" value="slot3" id="three" name="slot3" />Period 3</label>
              <label for="four">
                <input type="checkbox" value="slot4" id="four" name="slot4" />Period 4</label>
              <label for="five">
                <input type="checkbox" value="slot5" id="five" name="slot5" />Period 5</label>
              <label for="six">
                <input type="checkbox" value="slot6" id="six" name="slot6" />Period 6</label>
              <label for="seven">
                <input type="checkbox" value="slot7" id="seven" name="slot7" />Period 7</label>
            </div>



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


<script>

  var expanded = false;

  function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
      checkboxes.style.display = "block";
      expanded = true;
    } else {
      checkboxes.style.display = "none";
      expanded = false;
    }
  }
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>