<fieldset class="title-container">
<legend><i class="custom-icon-role"></i> Users Role</legend>
<style>
#create-new-table thead tr th.acl{width:100px!important}
#create-new-table tbody tr td{text-align:center;background:#fff}
input.error{border:1px solid red!important}
</style>
	<form action="" method="POST" class="form-horizontal" id="role-form">
		<input type="hidden" style="width:525px" name="role_id" id="role_id" style="float:left" value="<?=$role['xroles_id']?>" />
		<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','info')?>

		<div class="form-group">
	    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Role Name</label>
	    	<div class="col-sm-5">
	      	 <input type="text" style="float:left" name="role" id="role" value="<?=$role['role']?>" class="form-control"/>
	      		<span class="validation-status"></span>
	      	</div>
		</div>

		<div class="form-group">
	    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Modules</label>
	    	<div class="col-sm-10 ">
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

					$_create = ($get->_xcreate != 1) ? 'disabled' : null;
					$_read = ($get->_xread != 1) ? 'disabled' : null;
					$_update = ($get->_xupdate != 1) ? 'disabled' : null;
					$_delete = ($get->_xdelete != 1) ? 'disabled' : null;
					$_export = ($get->_xexport != 1) ? 'disabled' : null;
					$_print = ($get->_xprint != 1) ? 'disabled' : null;
					$_upload = ($get->_upload != 1) ? 'disabled' : null;
					$_create_ = ($modules[$get->xparentmodule_id]['_xcreate'] == 1) ? 'checked' : null;
					$_read_ = ($modules[$get->xparentmodule_id]['_xread'] == 1) ? 'checked' : null;
					$_update_ = ($modules[$get->xparentmodule_id]['_xupdate'] == 1) ? 'checked' : null;
					$_delete_ = ($modules[$get->xparentmodule_id]['_xdelete'] == 1) ? 'checked' : null;
					$_export_ = ($modules[$get->xparentmodule_id]['_xexport'] == 1) ? 'checked' : null;
					$_print_ = ($modules[$get->xparentmodule_id]['_xprint'] == 1) ? 'checked' : null;
					$_upload_ = ($modules[$get->xparentmodule_id]['_upload'] == 1) ? 'checked' : null;
				
						if ($get->xparentmodule_id==2) {
							$_read_ = 'checked';
							$_read = 'disabled';
							?>
								<input type="hidden" name="<?="_".$get->xparentmodule_id?>[_xread]" value="1" />
							<?php
						}
					?>
		        <tr>
		          <td><?=$get->parentmodule?></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xcreate]" value="<?=$get->_xcreate?>" <?=$_create?> <?=$_create_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xread]" value="<?=$get->_xread?>" <?=$_read?> <?=$_read_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xupdate]" value="<?=$get->_xupdate?>"<?=$_update?> <?=$_update_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xdelete]" value="<?=$get->_xdelete?>"<?=$_delete?> <?=$_delete_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xexport]" value="<?=$get->_xexport?>"<?=$_export?> <?=$_export_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xprint]" value="<?=$get->_xprint?>"<?=$_print?> <?=$_print_?> /></td>
		          <td><input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_upload]" value="<?=$get->_upload?>"<?=$_upload?> <?=$_upload_?> /></td>
		       
			   </tr>
					<?php
				}
			   
			   ?>
		      </tbody>
		    </table>

	    	</div>
	    </div>
	      	
    

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey">Status</label>
			    <div class="col-sm-5">
			      	<label class="radio inline pull-left scaffolding-lbl">
					  <input type="radio" name="status" id="status_1" value="1" <?=($role['status']==1) ? 'checked' : null;?> > 
					  Active 
					</label>
					<label class="radio inline pull-left scaffolding-lbl" style="margin-left:20px">
					  <input type="radio" name="status" id="status_0" value="0"  <?=($role['status']==0) ? 'checked' : null;?>>
					 Deactive
					</label> 
			      </div>
			  </div>
			 <div class="form-actions">
				<?=submit($action);?>
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