<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Check Before Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="theory.php">
                    <div class="form-group">
                        <label for="facid">Faculty Id</label>
                        <input type="text" class="form-control" readonly id="facid" name="facid">
                    </div>


                    <div class="form-group">
                        <label for="subcode">Subject Code</label>
                        <input type="text" class="form-control" id="subcode" readonly name="subcode">
                    </div>

                    <div class="form-group">
                        <label for="assign">Assign</label>
                        <input type="text" class="form-control" id="assign" readonly name="assign">
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="number" class="form-control" id="semester" readonly name="semester">
                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>