
<div class="all-wrapper no-menu-wrapper light-bg">
  <div class="login-logo-w">
    <a href="index.html" class="logo">
      <i class="icon-rocket"></i>
    </a>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <div class="widget widget-blue">
        <div class="widget-title">
          <h3 class="text-center"><i class="icon-lock"></i> Login PPOB</h3>
        </div>
        <div class="widget-content">
          <form method="post" class="form-signin" role="form">
          
            <div class="lined-separator"><?php echo messages(); ?></div>
          
            <div class="form-group relative-w">
              <input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" value="<?php echo (isset($username)) ? $username : ''; ?>" >
              <i class="icon-user input-abs-icon"></i>
            </div>
            <div class="form-group relative-w">
              <input type="password" class="form-control" placeholder="Password" name="password" id="password">
              <i class="icon-lock input-abs-icon"></i>
            </div>
			<!--
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?> />
                  <?php echo lang('remember_me'); ?>
                </label>
              </div>
            </div>
			
            <input class="btn btn-primary btn-rounded btn-iconed" type="submit" name="login-button" value="<?php echo lang('login'); ?> " id="login-button">

            
            
            <div class="no-account-yet">
              Don't have an account yet? <a href="<?php echo base_url();?>index.php/auth/register">Register Now</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>