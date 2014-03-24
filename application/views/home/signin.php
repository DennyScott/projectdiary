<div>
<div class="container">
    <div class="row">
      
      <div class="entry col-md-4 col-md-offset-4 push-content">
        
        <!--empty-->
        
          <div class="email-option">
            <h3>Sign In</h3>
          </div>
        
        
          <form class="entry-form" id="signIn" action="<?php echo URL; ?>home/logIn">
            <div class="form-group">
              <input autofocus="" name="username" type="text" class="form-control" value="" placeholder="Username">
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control" value="" placeholder="Password">
            </div>
            <!-- <p><a href="/forgot-password">Forgot your password?</a></p> -->
            <button type="submit" name="login_user" class="submit btn btn-default">Sign In</button>
          </form>
        
        <p class="entry-signup-cta">Don't have an account? <a href="<?php echo URL; ?>home/signup">Sign Up</a></p>
      </div>
    </div>
  </div>
</div>