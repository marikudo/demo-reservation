<fieldset class="title-container">
<legend><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Tax and Charges
<small>Manage your Taxes and Charges.</small>
</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form" enctype="multipart/form-data">
		<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Name :</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="name" name="name" class="col-md-4 form-control alphanumeric-n" style="float:left;width: 483px;" value="<?=$result['name']?>">

		      	</div>
			</div>

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey"><span class="required">*</span> Value :</label>
			    <div class="col-sm-7">
			      	<div class="pull-left" style="margin-right:10px;">
				    		 <input type="radio" name="is_selected" id="is_selected_1" style="margin-top: 9px;" class="pull-left" value="1" <?=($result['is_selected']==1) ? 'checked' : null;?> >
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;">Specific Amount  :</label>
				    		 <input type="text" id="specified" name="specified" class="form-control pull-left" style="width:80px" value="<?=$result['specified']?>">
		    		</div>
		    		<div class="pull-left" style="margin-right:10px;">
				    		 <input type="radio" name="is_selected" id="is_selected_0" style="margin-top: 9px;" class="pull-left" value="0" <?=($result['is_selected']==0) ? 'checked' : null;?> >
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;">By Percent  :</label>
				    		 <input type="text" id="percent" name="percent" class="form-control pull-left" style="width:80px" value="<?=$result['percent']?>">
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;" >%</label>
				    		 <br class="clear clr" />
				    		 <span class="validation-status"></span>
		    		</div>
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
			specified:{
				required :function(element){
	               if ($('#is_selected_1').is(':checked')) {
	                  return true;
	                }else{
	                  $('#specified').removeClass('error');
	                  return false;
	                }

				}
			},percent:{
				min:function(element){
	               if ($('#is_selected_0').is(':checked')) {
	                  return 1;
	                }else{
	                  $('#percent').removeClass('error');
	                  return false;
	                }
	            },
				max:100,
				required :function(element){
	               if ($('#is_selected_0').is(':checked')) {
	                  return true;
	                }else{
	                  $('#percent').removeClass('error');
	                  return false;
	                }

				}
			},name:{
				required:true,
				remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=htmlentities($result['name'])?>&gConf=<?=$hashConfig?>"
			
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
				                	dataType:'json',
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
				                	if (res.result =='true') {
				                		window.location = '<?=base_url()?>xhrs/charges-and-taxes';
				                	};
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