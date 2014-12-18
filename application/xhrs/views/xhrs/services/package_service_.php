<fieldset class="title-container">
<legend><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Services
<small>Manage your services. This will add to package setup.</small>
</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form" enctype="multipart/form-data">
		<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>

		<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Service Name :</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="service_name" name="service_name" class="col-md-4 form-control alphanumeric-n" style="float:left;width: 483px;" value="<?=$result['service_name']?>">

		      	</div>
			</div>

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey">Status :</label>
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
				<?=submit($action);?>
			</div>
       
	</form>
</fieldset>
<script type="text/javascript" src="<?=base_url()?>assets/xhrs/jcrop/jquery.Jcrop.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/xhrs/jcrop/jquery.Jcrop.css" />
<script type="text/javascript">
$(document).ready(function(){
	$('.number').numeric({allow:"."});
	$('.alphanumeric-n').alpha({allow:". %1234567890"});
	$('.alphanumeric').alphanumeric({allow:"., -"});
	$('.alphanumeric-d').alphanumeric({allow:"-"});

//$('#validate-form').validate().settings.ignore = ':not(select:hidden, input:visible, textarea:visible)';
	var validator = $("#validate-form").validate({
		 ignore: [],
		rules: {
			base_capacity:{
				required:true
			}

		},messages:{
			
    	},

    errorPlacement: function(error, element) {
      if(element.attr("name")=='extra_pax')
      	error.insertAfter('.extra_pax .bootstrap-select');
     else if(element.attr("name")=='descriptions')
     	//error.insertAfter('#descriptions');
     error.appendTo( element.parent().find('span.validation-status'));
     else if ( element.is(":radio") )
        error.appendTo( element.parent().next().next() );
      else if ( element.is(":checkbox") )
       // error.appendTo ( element.next() );
    error.appendTo( element.parent().find('span.validation-status'));
      else
        error.appendTo( element.parent().find('span.validation-status'));
    },
    success: "valid",
    submitHandler: function(form){
      $('input[type=submit]').attr('disabled', 'true');
      $(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
      	//var value = CKEDITOR.instances['descriptions'].getData();

					      	var formx = new FormData($(form)[0]);
					      	//formx.append('descriptions',value);
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
				                 window.location = '<?=base_url()?>xhrs/services';
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

.dd-sm .dropdown-menu{
	font-size: 12px;
}
.dd-sm .dropdown-menu > li > a {
padding: 5px 15px;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
 cursor: pointer!important;
 background-color: transparent!important;
opacity: 1;
}
.input-append img.ui-datepicker-trigger{
	float: left;
	padding: 7px;
	cursor: pointer;
	background: #021d92
}
.minimum_stay .bootstrap-select{
	width: 85px;
}
.minimum_stay .bootstrap-select .dropdown-menu > li > a {
padding: 3px 15px;
}
</style>