<fieldset class="title-container">
<legend class="module-title"><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Room Type</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form">
		 <?php //showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>
			
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Room Name</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="first_name" name="first_name" class="col-md-4 form-control alphanumeric-n" style="float:left" value="<?=$result['first_name']?>">
						 
		      	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Rate</label>
		    	<div class="col-sm-2">
	      			<input type="text" id="middle_name" name="middle_name"  class="col-md-4 form-control number" style="float:left" value="<?=$result['middle_name']?>">
		      	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Minimum Capacity</label>
		    	<div class="col-sm-1">
	      			<input type="text" id="middle_name" name="middle_name"  class="col-md-4 form-control number" style="float:left" value="<?=$result['middle_name']?>">
		      	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Maximum Capacity</label>
		    	<div class="col-sm-1">
	      			<input type="text" id="middle_name" name="middle_name"  class="col-md-4 form-control number" style="float:left" value="<?=$result['middle_name']?>">
		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Maximum Child</label>
		    	<div class="col-sm-1">
	      			<input type="text" id="middle_name" name="middle_name"  class="col-md-4 form-control number" style="float:left" value="<?=$result['middle_name']?>">
		      	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Description</label>
		    	 <div class="col-sm-9">
			       <textarea name="content" id="content"></textarea>
			    </div>
			</div>

			
			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey">Status</label>
			    <div class="col-sm-5">
			      	<label class="radio inline pull-left scaffolding-lbl">
					  <input type="radio" name="status" id="status_1" value="1" <?=($result['status']==1) ? 'checked' : null;?> > 
					  Active 
					</label>
					<label class="radio inline pull-left scaffolding-lbl" style="margin-left:20px">
					  <input type="radio" name="status" id="status_0" value="0"  <?=($result['status']==0) ? 'checked' : null;?>>
					 Deactive
					</label> 
			      </div>
			  </div>

			   <div class="form-actions">

				<input type="submit" class="btn btn-success" name="btn-submit" value="Create New" /> or <a href="javascript:history.back()">Cancel</a> 
				<!---or <a href="#" class="to-hide" data-hide="email-container">Cancel</a>//-->
			</div>
				
		
	</form>	
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	$('.number').numeric();
	$('.alphanumeric-n').alpha({allow:". "});
	$('.alphanumeric').alphanumeric({allow:"., -"});
	$('.alphanumeric-d').alphanumeric({allow:"-"});

/*var editor = CKEDITOR.replace('content',
	{

			filebrowserBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor',
			filebrowserImageBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor&filter=image',
			filebrowserFlashBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb//pdw_file_browser/index.php?editor=ckeditor&filter=flash',
			toolbar:[
				{ name: 'clipboard', groups: [ 'undo' ], items: [ 'Undo', 'Redo' ] },
				{ name: 'basicstyles', groups: ['basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
				{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] }
		
			]
	});
    CKEDITOR.add
    CKEDITOR.config.contentsCss = '<?=base_url()?>assets/xhrs/bootstrap-3.1.1/css/bootstrap.css' ; */


	var validator = $("#validate-form").validate({
		rules: {
			first_name:{
				required:true
			},middle_name:{
				required:true
			},last_name:{
				required:true,
			},password:{
				required:true,
				minlength: 6
			},mobile_number:{
				required:true,
				maxlength: 9,
				minlength: 9
			},role_id:{
				required:true
			},email:{
				required:true,
				email:true,
				 remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=htmlentities($result['email'])?>&gConf=<?=$hashConfig?>"
			}
		
		},messages:{
			 email:{
		        remote: $.format("<strong>{0}</strong> is already exists.")
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

	$('#reset-password').click(function(){
		//$("#validate-form").submit();
	});

});

</script>

<style type="text/css">
	select#reference_id{width: 180px!important}
	input.error,select.error{border: 1px solid red!important}
	.btn-group.bootstrap-select{margin-left: 0px!important;}
</style>