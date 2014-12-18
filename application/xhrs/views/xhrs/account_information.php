<fieldset class="title-container">
<legend><i class="fa fa-user"></i> Account Information <small>This page shows your personal information.</small></legend>
<?=isset($success) ? showMessage($success) : null;?>
<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>
<div class="res-container">
<form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/information')?>" method="post" enctype="multipart/form-data" id="validate-form">
  
   <div class="form-group">
    <label class="col-sm-3 control-label ckey">Role :</label>
    <div class="col-sm-8 vals">
     	<span><?=$user['role']?></span>
      
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label ckey"><span class="required">*</span> First Name</label>
    <div class="col-sm-5">
       <input type="text" class="form-control toUpperCase alpha" id="first_name" name="first_name" value="<?=$user['first_name']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-3 control-label ckey"><span class="required">*</span> Middle Name</label>
    <div class="col-sm-4">
       <input type="text" class="form-control toUpperCase alpha" id="middle_name" name="middle_name" value="<?=$user['middle_name']?>">
      
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword" class="col-sm-3 control-label ckey"><span class="required">*</span> Last Name</label>
    <div class="col-sm-5">
       <input type="text" class="form-control toUpperCase alpha" id="last_name" name="last_name" value="<?=$user['last_name']?>">
    </div>
  </div>

 
    <div class="form-actions" style="padding-left:20px">
	<button type="submit" class="btn btn-primary blue" name="btn_success">Save changes</button>
	</div>
</form>
</div>
</fieldset>
<script type="text/javascript">
  $(document).ready(function(){

    var validator = $("#validate-form").validate({
    rules: {
      last_name:{
        required:true
      },first_name: {
        required: true,
      },middle_name: {
        required: true,
      }
    
    },
    
    errorPlacement: function(error, element) {
      if ( element.is(":radio") )
        error.appendTo( element.parent().next().next() );
      else if ( element.is(":checkbox") )
        error.appendTo ( element.next() );
      else
        error.appendTo( element.parent().find('span.validation-status') );
    },
    success: "valid",
    submitHandler: function(form){
      $('button[type=submit]').attr('disabled', 'true');
      $(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
      form.submit(form);
    }
  });

  });
</script>

						
						
				
	



