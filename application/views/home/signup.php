<div>
<div class="container">
    <div class="row">
      
      <div class="entry col-md-4 col-md-offset-4 push-content">
        
        <!--empty-->
        
          <div class="email-option">
            <h3>Sign Up</h3>
          </div>
        
        
          <form class="entry-form" id="signUp" method="post" action="<?php echo URL; ?>home/addUser">
            <div class="form-group">
              <input autofocus="" name="username" type="text" class="form-control" value="" placeholder="Username">
            </div>

            <div class="form-group">
              <input name="password" type="password" class="form-control" value="" placeholder="Password">
            </div>
            <button type="submit" name="submit_add_user" class="submit btn btn-default">Sign Up</button>
          </form>
        
        <p class="entry-signup-cta">Already have an account? <a href="<?php echo URL; ?>home/signin">Sign In</a></p>
      </div>
    </div>
  </div>
</div>