<fieldset class="title-container">
<legend><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Room Type</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form">
		<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>

		<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Room Name</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="room_type" name="room_type" class="col-md-4 form-control alphanumeric-n" style="float:left;width: 483px;" value="<?=$result['room_type']?>">

		      	</div>
			</div>

	<!-- 		 <div class="form-group">
          <label class="col-sm-3 control-label ckey"><span class="required">*</span> Upload Picture</label>
          <div class="col-sm-7">
           <?php
              $avatar = ($result['avatar']=="") ? base_url()."media/images/no_avatar.jpg" : base_url()."uploads/avatar/".$result['avatar'];
              $avatarx = ($result['avatar']=="") ? "no_avatar.jpg" : $result['avatar'];
            ?>
            <img src="<?=$avatar?>" id="img_preview" class="img-thumbnail" style="width:100px;margin-right:10px" />
            <a href="#uploadModal" id="uploadBTN" data-toggle="modal" class="btn btn-default"><i class="fa fa-upload"></i> Upload Picture</a>
            <br class="clear" /><br />
            <input type="hidden" id="avatar" name="avatar" value="<?=$avatarx?>" />

          </div>
        </div> -->

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Room Rate</label>
		    	<div class="col-sm-9 clearfix">
	      			<div class="col-sm-1" style="margin:0;padding:0;width:100px;">
	      			<input type="text" id="rate" name="rate"  class="col-md-4 form-control number" style="float:left;width:95px" value="<?=$result['rate']?>">
	      			</div>
<!-- 	      			<div class="col-sm-5 form-group" style="width:260px;">
	      				<label class="col-sm-6 control-label ckey" style="width:90px"><span class="required">*</span> Child(ren)</label>
	      				<div class="col-sm-7">
	      			<input type="text" id="child_rate" name="child_rate"  class="col-md-4 form-control number" style="float:left;width:155px" value="<?=$result['child_rate']?>">
	      			</div>
	      			</div> -->

	      			<div class="col-sm-5 form-group" style="margin-bottom: 0px;width: 195px;margin: 0;padding:0">
	      				<label class="col-sm-6 control-label ckey" style="width:78px;padding:0;margin:0"><span class="required">*</span> Extra Pax Rate</label>
	      				<div class="col-sm-7">
		      			<input type="text" id="extra_pax_rate" name="extra_pax_rate"  class="col-md-4 form-control number" style="float:left;width:95px" value="<?=$result['extra_pax_rate']?>">
		      			</div>
	      			</div>

	      			<div class="col-sm-5 form-group" style="margin-bottom:0px;width: 246px;margin:0;padding:0">
	      				<label class="col-sm-6 control-label ckey" style="width:78px;margin:0;padding:0"><span class="required">*</span> Extra Bed Rate</label>
	      				<div class="col-sm-7">
		      			<input type="text" id="extra_bed_rate" name="extra_bed_rate"  class="col-md-4 form-control number" style="float:left;width:95px" value="<?=$result['extra_bed_rate']?>">
		      			</div>
	      			</div>

		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Room Quantity</label>
		    	<div class="col-sm-1 dd-sm">
		    			<!-- <select name="maxi_capacity" id="maxi_capacity" class="selectpicker show-tick" style="float:left;">
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['maxi_capacity']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select> -->
	      			<input type="text" id="room_quantity" name="room_quantity"  class="col-md-4 form-control number" maxlength="4" style="float:left" value="<?=$result['room_quantity']?>">
		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Standard Capacity</label>
		    	<div class="col-sm-1 dd-sm">
		    				<select name="base_capacity" id="base_capacity" class="selectpicker show-tick" style="float:left;">
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['base_capacity']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
				</div>
			</div>

<!-- 			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Maximum Capacity</label>
		    	<div class="col-sm-1 dd-sm">
		    			<select name="maxi_capacity" id="maxi_capacity" class="selectpicker show-tick" style="float:left;">
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['maxi_capacity']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
		      	</div>
			</div> -->



			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Maximum Child</label>
		    	<div class="col-sm-1 dd-sm">

		    			<select name="maxi_child" id="maxi_child" class="selectpicker show-tick" style="float:left;">
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['maxi_child']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
	      			<!-- <input type="text" id="maxi_child" name="maxi_child"  class="col-md-4 form-control number" maxlength="2" style="float:left" value="<?=$result['maxi_child']?>"> -->
		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey">Extra Pax</label>
		    	<div class="col-sm-7 dd-sm extra_pax">

		    			<select name="extra_pax" id="extra_pax" class="selectpicker show-tick" style="float:left;">
		    				 <option value="">0</option>
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['extra_pax']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
	      			<!-- <input type="text" id="maxi_child" name="maxi_child"  class="col-md-4 form-control number" maxlength="2" style="float:left" value="<?=$result['maxi_child']?>"> -->
		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey">Extra Bed</label>
		    	<div class="col-sm-1 dd-sm">
		    				<select name="extra_bed" id="extra_bed" class="selectpicker show-tick" style="float:left;">
								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['extra_bed']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
				</div>
			</div>

		<div class="form-group" style="height:300px;">
	    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Descriptions</label>
	    	<div class="col-sm-10 ">
	    		<textarea name="descriptions" id="descriptions"><?=$result['descriptions']?></textarea>

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
			<div class="form-group">
			    <label class="col-sm-3 control-label ckey">Published</label>
			    <div class="col-sm-5">
			      	<label class="radio inline pull-left scaffolding-lbl">
					  <input type="radio" name="is_plublished" id="is_plublished_1" value="1" <?=($result['is_plublished']==1) ? 'checked' : null;?> >
					  Yes
					</label>
					<label class="radio inline pull-left scaffolding-lbl" style="margin-left:20px">
					  <input type="radio" name="is_plublished" id="is_plublished_0" value="0"  <?=($result['is_plublished']==0) ? 'checked' : null;?>>
					 Demo
					</label>
			      </div>
			  </div>
			 <div class="form-actions">

				<input type="submit" class="btn btn-success" name="btn-submit" value="Create New" /> or <a href="javascript:history.back()">Cancel</a>
				<!---or <a href="#" class="to-hide" data-hide="email-container">Cancel</a>//-->
			</div>

			<input type='hidden' name="y" id="y" value=""/>
    <input type='hidden' name="x" id="x" value=""/>
    <input type='hidden' name="h" id="h" value=""/>
    <input type='hidden' name="w" id="w" value=""/>
    <input type='hidden' name="i" id="i" value="new"/>
	</form>
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	$('.number').numeric({allow:"."});
	$('.alphanumeric-n').alpha({allow:". "});
	$('.alphanumeric').alphanumeric({allow:"., -"});
	$('.alphanumeric-d').alphanumeric({allow:"-"});
var content = $('#descriptions');
	if (content.length > 0) {

var editor = CKEDITOR.replace('descriptions',
	{

			filebrowserBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor',
			filebrowserImageBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor&filter=image',
			filebrowserFlashBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb//pdw_file_browser/index.php?editor=ckeditor&filter=flash',
			toolbar:[
				{ name: 'clipboard', groups: [ 'undo' ], items: [ 'Undo', 'Redo' ] },
				{ name: 'basicstyles', groups: ['basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
			/*	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak' ] },*/
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] }

			]
	});
    CKEDITOR.add
    CKEDITOR.config.contentsCss = '<?=base_url()?>assets/xhrs/bootstrap-3.1.1/css/bootstrap.css' ;
}

jQuery.validator.addMethod(
    "money",
    function(value, element) {
        var isValidMoney = /^\d{0,6}(\.\d{0,2})?$/.test(value);
        return this.optional(element) || isValidMoney;
    },
    "Insert "
);

//$('#validate-form').validate().settings.ignore = ':not(select:hidden, input:visible, textarea:visible)';
	var validator = $("#validate-form").validate({
		 ignore: [],
		rules: {
			base_capacity:{
				required:true
			},
			rate:{
				required:true,
				money: true,
			},extra_pax_rate:{
				required:true,
				money: true,
			},child_rate:{
				required:true,
				money: true,
			},
			extra_pax:{
				required:false
			},
			descriptions:{
				required: function(textarea) {
		          CKEDITOR.instances[textarea.id].updateElement(); // update textarea
		          var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
		          return editorcontent.length === 0;
		        }
			},
			room_type: {
				required: true,
				remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=urlencode($result['room_type'])?>&gConf=<?=$hashConfig?>"
			},

		},messages:{

    	},

    errorPlacement: function(error, element) {
      if(element.attr("name")=='extra_pax')
      	error.insertAfter('.extra_pax .bootstrap-select');
     else if(element.attr("name")=='descriptions')
     	error.insertAfter('#descriptions');
     else if ( element.is(":radio") )
        error.appendTo( element.parent().next().next() );
      else if ( element.is(":checkbox") )
        error.appendTo ( element.next() );
      else
        error.appendTo( element.parent().find('span.validation-status'));
    },
    success: "valid",
    submitHandler: function(form){
      $('input[type=submit]').attr('disabled', 'true');
      $(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
      	var value = CKEDITOR.instances['descriptions'].getData();

					      	var formx = new FormData($(form)[0]);
					      	formx.append('descriptions',value);
					      	// Make the ajax call
				            $.ajax({
				                url: $(form).attr('action'),
				                type: 'POST',
				                xhr: function() {
				                	 myXhr = $.ajaxSettings.xhr();
					                if(myXhr.upload){ // check if upload property exists
					                    //myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
					                }
					                return myXhr;
				                },
				                //add beforesend handler to validate or something
				                beforeSend: function(){

				                },
				                success: function (res) {
				                  // window.location = '<?=base_url()?>xhrs/room-type-management';
				                },
				                //add error handler for when a error occurs if you want!
				                //error: errorfunction,
				                data: formx,
				                // this is the important stuf you need to overide the usual post behavior
				                cache: false,
				                contentType: false,
				                processData: false
				            });


    }
	});
});
</script>
<style type="text/css">
.btn-group.bootstrap-select{
	width: 60px;
}

.dd-sm .dropdown-menu{
	font-size: 12px;
}
.dd-sm .dropdown-menu > li > a {
padding: 1px 10px;
}

</style>