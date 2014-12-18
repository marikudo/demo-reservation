
            <h3 class="page-header" style="border:none">Forgot Password</h3>
                <?php
                  if (isset($error)){
                      ?>
                      <div class="alert alert-danger alert-sm"><?=$error?></div>
                      <?php
                  }
                  if (isset($success)){
                      ?>
                      <div class="alert alert-success alert-sm"><?=$success?></div>
                      <?php
                  }
                ?>
                <form role="form" class="login" method="post">
                    <div class="form-group float-label-control">
                        <label for="">Email Address</label>
                        <input type="email" name="username" class="form-control modified-txtbox" placeholder="Email Address">
                    </div>
      
                    
                   <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                           <button type="submit" name="btn_success" class="btn btn-success">Submit</button>
                        </div>
                        <div class="col-md-6 forgot-pass-content">
                            <a href="<?=app_base_url()?>home/auth" class="forgot-pass" style="color: #aaaaaa;">Login</a>
                        </div>
                    </div>
                </div>
                </form>
       