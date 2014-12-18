<fieldset class="title-container">
<legend><i class="fa fa-gear"></i> Account settings <small>This page shows your account information.</small></legend>
<?=isset($success) ? showMessage($success) : null;?>
<?=isset($error) ? showMessage($error,'danger') : null;?>
<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>


<fieldset class="sm-title">
  <legend>Email Address</legend>
  <div class="res-container">
  <form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/settings')?>" method="post" enctype="multipart/form-data">
    
     <div class="form-group">
      <label class="col-sm-3 control-label ckey">Email :</label>
      <div class="col-sm-5 vals">
       	<span><?=$user['email']?></span>
        <a href="#dit" class="pull-right" id="editEmail">Edit</a>
      </div>
    </div>
  <div id="emailForm">
    <div class="form-group">
      <label class="col-sm-3 control-label ckey">Enter new email</label>
      <div class="col-sm-5">
         <input type="email" class="form-control " id="email" name="email" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-sm-3 control-label ckey">Password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" id="password" name="password" value="">
      </div>
    </div>
   
      <div class="form-actions" style="padding-left:20px">
    <button type="submit" class="btn btn-primary blue" name="change_email">Save changes</button>
    </div>
  </form>
  </div>
  </div>  
</fieldset>

<fieldset class="sm-title">
  <legend>Change your password</legend>
  <?=showMessage('<strong>Note:</strong> Change your password to prevent from password hacking attack. Chose something you can remember, but not too short or too simple.','info')?>
  <div class="res-container">
  <form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/settings')?>" method="post" enctype="multipart/form-data">
    
     <div class="form-group">
      <label class="col-sm-3 control-label ckey">Old Password :</label>
      <div class="col-sm-5 vals">
        <input type="password" class="form-control " id="password" name="password" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label ckey">Enter new password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control " id="newpassword" name="newpassword" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-sm-3 control-label ckey">Confirm password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" id="cnewpassword" name="cnewpassword" value="">
      </div>
    </div>
   
      <div class="form-actions" style="padding-left:20px">
    <button type="submit" class="btn btn-primary blue" name="change_password">Change Password</button>
    </div>
  </form>
  </div>
</fieldset>


</fieldset>
<script type="text/javascript">
$(function(){
    $('#emailForm').hide();
    $('a#editEmail').click(function(){
       // $('#emailForm').slideToggle();

        if($('#emailForm').css('display')=='none'){
          $(this).text('Hide');
          $('#emailForm').slideDown();
        }else{
          $('#emailForm').slideUp();
          $(this).text('Edit');
        }
       // alert($('#emailForm').css('display'));
    })
});
</script>
						
						
				
	



