<fieldset class="title-container">
<legend><i class="custom-icon-role"></i> Users Role</legend>
<style>
#create-new-table thead tr th.acl{width:100px!important}
#create-new-table tbody tr td{text-align:center;background:#fff}
input.error{border:1px solid red!important}
</style>
	<form action="" method="POST" class="form-horizontal" id="role-form">
	<input type="hidden" style="width:525px" name="role_id" id="role_id" style="float:left" value="<?=$role['xroles_id']?>" />
		<div class="form-group">
	    	<label class="col-sm-3 control-label ckey"> Role Name :</label>
	    	<div class="col-sm-5">
	      	<span class="view-mode"><?=$role['role']?></view>
	      	</div>
		</div>

		<div class="form-group">
	    	<label class="col-sm-3 control-label ckey"> Modules</label>
	    	<div class="col-sm-10 ">
	    	</div>
	    </div>
	      	<table class="table table-hover table-custom display" style="font: 12px 'Arial';margin-top:10px" id="module">
				<thead>
		        <tr>
		          <th></th>
		          <th>Create</th>
		          <th>Read</th>
		          <th>Update</th>
		          <th>Delete</th>
		          <th>Export</th>
		          <th>Print</th>
		          <th>Upload</th>
		        </tr>
		      </thead>
		      <tbody>
		  	   <?php



			   $ctr = 1;
				foreach($result as $key => $get){

					$_createx = ($get->_xcreate != 1) ? 'fa-times red' :  'fa-check';
					$_readx = ($get->_xread != 1) ? 'fa-times red' :  'fa-check';
					$_updatex = ($get->_xupdate != 1) ? 'fa-times red' :  'fa-check';
					$_deletex = ($get->_xdelete != 1) ? 'fa-times red' :  'fa-check';
					$_exportx = ($get->_xexport != 1) ? 'fa-times red' :  'fa-check';
					$_printx = ($get->_xprint != 1) ? 'fa-times red' :  'fa-check';
					$_uploadx = ($get->_xupload != 1) ? 'fa-times red' :  'fa-check';
					
					?>
		        <tr>
		          <td><?=$get->parentmodule?></td>
		          <td><i class="fa <?php echo $_createx ?>"></i></td>
		          <td><i class="fa <?php echo $_readx ?>"></i></td>
		          <td><i class="fa <?php echo $_uploadx ?>"></i></td>
		          <td><i class="fa <?php echo $_deletex ?>"></i></td>
		          <td><i class="fa <?php echo $_exportx ?>"></i></td>
		          <td><i class="fa <?php echo $_printx ?>"></i></td>
		          <td><i class="fa <?php echo $_uploadx ?>"></i></td>
		       
			   </tr>
					<?php
				}
			   
			   ?>
		      </tbody>
		    </table>
    

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey">Status : </label>
			    <div class="col-sm-5">
			    	<span class="view-mode"><?=($role['status']==1) ? 'Activated' : 'Deactivated' ?></span>
			      
			      </div>
			  </div>
			 <div class="form-actions">

				<input type="submit" class="btn btn-success" name="btn-submit" value="Back" />
			</div>
		
		
	</form>	
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	var validator = $("#role-form").validate({
		rules: {
					
			role: {
				required: true,
				  remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=urlencode($role['role'])?>&gConf=<?=$hashConfig?>"
    
			},
		
		},messages:{ 
      role:{
        remote: $.format("<strong>{0}</strong> is already exists.")
      }
    },
    
    errorPlacement: function(error, element) {
      if ( element.is(":radio") )
        error.appendTo( element.parent().next().next() );
      else if ( element.is(":checkbox") )
        error.appendTo ( element.next() );
      else
        error.appendTo( element.parent().find('span.validation-status'));
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