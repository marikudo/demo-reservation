
            <h3 class="page-header" style="border:none">Administrator Login</h3>
                <?php
                  if (isset($error)){
                      ?>
                      <div class="alert alert-danger alert-sm"><?=$error?></div>
                      <?php
                  }
                ?>
                <form role="form" class="login" method="post">
                    <div class="form-group float-label-control">
                        <label for="">Username</label>
                        <input type="email" name="username" class="form-control modified-txtbox" placeholder="Username">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control modified-txtbox" placeholder="Password">
                    </div>
                   
                    
                   <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                           <button type="submit" name="btn_success" class="btn btn-success">Login</button>
                        </div>
                        <div class="col-md-6 forgot-pass-content">
                            <a href="<?=app_base_url()?>home/forgot" class="forgot-pass" style="color: #aaaaaa;">Forgot Password</a>
                        </div>
                    </div>
                </div>
                </form>
       