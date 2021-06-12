<!-- Modal -->
<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="signModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/forum/partials/_handelSignup.php" method = "POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="usernmae">User Name</label>
                    <input type="text" class="form-control" name= "username" id="username" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>