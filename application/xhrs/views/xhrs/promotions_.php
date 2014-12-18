<fieldset class="title-container">
<legend><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Room Type</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form">
		<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>

		<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Promo Name :</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="promotions_name" name="promotions_name" class="col-md-4 form-control alphanumeric-n" style="float:left;width: 483px;" value="<?=$result['promotions_name']?>">

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
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Room Type :</label>
		    	<div class="col-sm-7 dd-sm">
		    		<label class="radio inline scaffolding-lbl" style="padding: 0;min-height: 17px;">Select Room Type :</label>
			    		<?php
			    			$ctr = 0;


		                 	foreach ($room_type as $key => $value) {
		                 		$a = array();
		                 		if (isset($result['selected_room_type'])) {
		                 			$a = explode(',',$result['selected_room_type']);
		                 		}
		                 		$selected = '';
		                 		if (in_array($value->room_type_id, $a)) {
		                 			$selected = 'checked="true"';

		                 		}

		                 		?>
		                 		<input type="checkbox" name="room_type_id[]" <?=$selected?> id="room_type_id_<?=$value->room_type_id?>" class="pull-left " onClick="room_type_id_check(this,<?=$value->room_type_id?>)"> <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin:3px;"><?=$value->room_type?></label>
		                 		<?php
		                 			if ($ctr==4) {
		                 				echo "<br class='clear clr' />";
		                 				$ctr=0;
		                 			}
		                 		$ctr++;
		                 	}

			    		?>
			    		 <br class="clear clr" />
				    		 <span class="validation-status"></span>
				    		 <input type="hidden" name="selected_room_type" id="selected_room_type" value="<?=$result['selected_room_type']?>">
				</div>
			</div>

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey"><span class="required">*</span> Discount :</label>
			    <div class="col-sm-7">
			      	<div class="pull-left" style="margin-right:10px;">
				    		 <input type="radio" name="discount" id="discount_1" style="margin-top: 9px;" class="pull-left" value="1" <?=($result['discount']==1) ? 'checked' : null;?> >
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;">Specific Amount  :</label>
				    		 <input type="text" id="discount_specific_amount" name="discount_specific_amount" class="form-control pull-left" style="width:80px" value="<?=$result['discount_specific_amount']?>">
		    		</div>
		    		<div class="pull-left" style="margin-right:10px;">
				    		 <input type="radio" name="discount" id="discount_0" style="margin-top: 9px;" class="pull-left" value="0" <?=($result['discount']==0) ? 'checked' : null;?> >
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;">By Percent  :</label>
				    		 <input type="text" id="discount_percent" name="discount_percent" class="form-control pull-left" style="width:80px" value="<?=$result['discount_percent']?>">
				    		 <label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin: 5px;margin-top: 7px;" >%</label>
				    		 <br class="clear clr" />
				    		 <span class="validation-status"></span>
		    		</div>
			      </div>
			  </div>



			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Stay Date :</label>
		    	<div class="col-sm-10 dd-sm">

		    			<div class="pull-left" style="margin-right:10px;">
		    				<label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;">Start Date :</label>
				    		<div class="input-append clearfix">
					            <input id="promo_date_start" name="promo_date_start" class="form-control pull-left" type="text" readonly style="width:150px;margin-right:3px" value="<?=$result['promo_date_start']?>">
							 </div>
		    			</div>
		    			<div class="pull-left" style="margin-right:10px;">
		    				<label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;">End Date :</label>

		    				<div class="input-append clearfix">
					            <input id="promo_date_end" name="promo_date_end" class="form-control pull-left" type="text" readonly style="width:150px;margin-right:3px" value="<?=$result['promo_date_end']?>">
							 </div>
		    			</div>

		    			<div class="pull-left minimum_stay" ><label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;">Minimum Stay :</label>
				    		<br />
		    				<select name="minimum_stay" id="minimum_stay" class="selectpicker show-tick" style="float:left;width:20px;">

								<?php
									$minimum_capacity = 10;
									for ($i=1; $i <= $minimum_capacity; $i++) {
											$selected = ($result['minimum_stay']==$i) ? "selected" : null;
											?>
											 <option value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<?php
									}

								?>
						  	</select>
		    			</div>
		      	</div>
			</div>


			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Booking Date :</label>
		    	<div class="col-sm-10 dd-sm">
		    		<div class="alert alert-info alert-small" style="margin: 0px;margin-bottom: 10px;">
		    					<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
		    					Please select date for the availability of this promo. Fields below can be selected if the Stay fields is already filled out.
		    		</div>

		    		<div class="pull-left" style="margin-right:10px;"><label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;">Start Date :</label>

				    		<div class="input-append clearfix">
					            <input id="booking_date_start" name="booking_date_start" class="form-control pull-left" type="text" readonly style="width:150px;margin-right:3px" value="<?=$result['booking_date_start']?>">
							 </div>
		    			</div>
		    			<div class="pull-left" style="margin-right:10px;">
		    				<label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;">End Date :</label>

		    				<div class="input-append clearfix">
					            <input id="booking_date_end" name="booking_date_end" class="form-control pull-left" type="text" readonly style="width:150px;margin-right:3px" value="<?=$result['booking_date_end']?>">
							 </div>
		    			</div>
		    			<br class="clr clear" />

		    			<div class="pull-left" style="margin-top:10px;">
		    				<label class="radio inline scaffolding-lbl" style="padding: 0;min-height: 17px;">Select Days :</label>
				    		<?php
		                         $aDays = array("Mondays","Tuesdays","Wednesdays","Thursdays","Fridays","Saturdays","Sundays");
		                         	foreach ($aDays as $key => $value) {
		                         		$a = array();
				                 		if (isset($result['selected_days_check'])) {
				                 			$a = explode(',',$result['selected_days_check']);
				                 		}
				                 		$selected = '';
				                 		if (in_array($value, $a)) {
				                 			$selected = 'checked="true"';

				                 		}


		                         		?>
		                         		<input type="checkbox" name="selected_days[]" <?=$selected ?> id="_<?=strtolower($value)?>" class="pull-left" onClick="selected_days_checked(this,'<?=$value?>')" />
		                         		<label class="radio inline pull-left scaffolding-lbl" style="padding: 0;min-height: 17px;margin:3px;"><?=$value?></label>
		                         		<?php
		                         	}

				    			?>
				    			<br class="clr clear" />
				    			<span class="validation-status"></span>
				    			<input type="hidden" id="selected_days" name="selected_days_check" value="<?=$result['selected_days_check']?>">
		    			</div>
		    			<br class="clr clear" />


		      	</div>
			</div>


		<div class="form-group" style="height:300px;">
	    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Descriptions :</label>
	    	<div class="col-sm-10 ">
	    		<textarea name="descriptions" id="descriptions"><?=$result['descriptions']?></textarea>
	    		 <span class="validation-status"></span>
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

				<input type="submit" class="btn btn-success" name="btn-submit" value="Create New" /> or <a href="javascript:history.back()">Cancel</a>
				<!---or <a href="#" class="to-hide" data-hide="email-container">Cancel</a>//-->
			</div>
	</form>
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	$('.number').numeric({allow:"."});
	$('.alphanumeric-n').alpha({allow:". %1234567890"});
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
			promotions_name: {
				required: true,
				remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=urlencode($result['promotions_name'])?>&gConf=<?=$hashConfig?>"
			},discount_percent:{
				min:function(element){
	               if ($('#discount_0').is(':checked')) {
	                  return 1;
	                }else{
	                  $('#discount_percent').removeClass('error');
	                  return false;
	                }
	            },
				max:100,
				required :function(element){
	               if ($('#discount_0').is(':checked')) {
	                  return true;
	                }else{
	                  $('#discount_percent').removeClass('error');
	                  return false;
	                }

				}
			},promo_date_start:{
				required:true
			},promo_date_end:{
				required:true
			},booking_date_start:{
				required:true
			},booking_date_end:{
				required:true
			},discount_specific_amount:{
				required :function(element){
	               if ($('#discount_1').is(':checked')) {
	                  return true;
	                }else{
	                  $('#discount_specific_amount').removeClass('error');
	                  return false;
	                }

				}
			},'selected_days[]':{
				required:true,
                minlength : 1
			},'room_type_id[]':{
				required:true
			}

		},messages:{
			discount_percent : {
				required : ""
			},discount_specific_amount : {
				required : ""
			}
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
				                 window.location = '<?=base_url()?>xhrs/promotions';
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

var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

	  $("#promo_date_start").datepicker({
	  		  buttonImage: '<?=base_url()?>assets/xhrs/images/calendar-icon-white.png',
            buttonImageOnly: true,
            showOn: 'both',
		  	 showOtherMonths: true,
	         selectOtherMonths: true,
    		dateFormat: 'd MM, yy',
     		minDate: 0,
     		autoclose: true,
     		todayHighlight: true,
	         onClose:function(date){
                if (date!="") {

                 var dateMinx = $(this).datepicker('getDate', '+1d');
                     dateMinx.setDate(dateMinx.getDate() + 1);

                 var dateMaxxx =  $('#promo_date_start').datepicker('getDate');
                 var dateMaxx = dateMaxxx;
                      if (dateMaxxx==null) {
                          dateMaxx = dateMinx;
                      }
                    if (dateMinx > dateMaxx || dateMaxxx==null) {
                      var monthx = dateMinx.getMonth();
                      var x = dateMinx.getDate()+" "+months[monthx]+", "+dateMinx.getFullYear();

                      $('#promo_date_end').val(x);

                    };

                };


            },

  	});

	    $("#promo_date_end").datepicker({
	  		  buttonImage: '<?=base_url()?>assets/xhrs/images/calendar-icon-white.png',
            buttonImageOnly: true,
            showOn: 'both',
		  	 showOtherMonths: true,
	         selectOtherMonths: true,
    		dateFormat: 'd MM, yy',
     		minDate: 0,
     		autoclose: true,
     		todayHighlight: true,
		    beforeShow: function(date){
	            var min = new Date();
	            var dayRange = 1000;
	            var dateMin = min;
	            var dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
	               var dateMin = $('#promo_date_start').datepicker('getDate', '+1d');
	                    dateMin.setDate(dateMin.getDate() + 1);
	                      dateMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate() -1);

	              return {

	                  minDate: dateMin,
	                  maxDate: dateMax
	              }
	            }

  	});


	  $("#booking_date_start").datepicker({
	  		  buttonImage: '<?=base_url()?>assets/xhrs/images/calendar-icon-white.png',
            buttonImageOnly: true,
            showOn: 'both',
		  	 showOtherMonths: true,
	         selectOtherMonths: true,
    		dateFormat: 'd MM, yy',
     		minDate: 0,
     		autoclose: true,
     		todayHighlight: true,
     		beforeShow: function(date){
	            var dateMin =  $('#promo_date_end').datepicker('getDate');
	           		if (dateMin==null) {
	           			return false;
	           		}else{
	           			var dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() );
			                dateMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate());
			              return {
			                  maxDate: dateMax
			              }
	           		}

	            },
	         onClose:function(date){
                if (date!="") {

                 var dateMinx = $(this).datepicker('getDate');
                     dateMinx.setDate(dateMinx.getDate());

                 var dateMaxxx =  $('#booking_date_start').datepicker('getDate');
                 var dateMaxx = dateMaxxx;
                      if (dateMaxxx==null) {
                          dateMaxx = dateMinx;
                      }
                    //if (dateMinx > dateMaxx || dateMaxxx==null) {
                      var monthx = dateMinx.getMonth();
                      var x = dateMinx.getDate()+" "+months[monthx]+", "+dateMinx.getFullYear();

                      $('#booking_date_end').val(x);

                   /// };

                };


            },

  	});

	    $("#booking_date_end").datepicker({
	  		  buttonImage: '<?=base_url()?>assets/xhrs/images/calendar-icon-white.png',
            buttonImageOnly: true,
            showOn: 'both',
		  	 showOtherMonths: true,
	         selectOtherMonths: true,
    		dateFormat: 'd MM, yy',
     		minDate: 0,
     		autoclose: true,
     		todayHighlight: true,
		    beforeShow: function(date){
	               var dateMin =  $('#promo_date_end').datepicker('getDate');;
		    	if (dateMin==null) {
	           			return false;
	           		}else{
	            var min = new Date();
	            var dayRange = 1000;
	           // var dateMin = min;

	            var dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() );
	                dateMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate());

	           // var dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
	               var dateMin = $('#booking_date_start').datepicker('getDate');
	                    dateMin.setDate(dateMin.getDate());
	                     // dateMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate() -1);

	              return {

	                  minDate: dateMin,
	                  maxDate: dateMax
	              }
	            }
	        }

  	});

});
var selected_room_id = [<?=$result['selected_room_type']?>];
function room_type_id_check(element,id){
	//alert(id);
	var isCheck = $(element).is(":checked");
		if (isCheck==true) {
			selected_room_id.push(id);
		}else{
			var i = selected_room_id.indexOf(id);
	          if(i != -1) {
	            selected_room_id.splice(i, 1);
	          }
		}
	var unique = selected_room_id.filter( onlyUnique );
  $('#selected_room_type').val(unique);
}
<?php
	if ($action=='edit') {
		$a = '';
		if (isset($result['selected_days_check'])) {
 			$ab = explode(',',$result['selected_days_check']);
 			$a = implode('","', $ab);
 			$a =  (count($ab) > 0) ? '"'.$a.'"' : "";
 		}
			?>
			var selected_days = [<?=$a?>];
			<?php
	}else{
		?>
var selected_days = [];
		<?php
	}
?>
function selected_days_checked(elementx,id){
	//alert(id);
	var isCheck = $(elementx).is(":checked");
		if (isCheck==true) {
			selected_days.push(id);
		}else{
			var i = selected_days.indexOf(id);
	          if(i != -1) {
	            selected_days.splice(i, 1);
	          }
		}
	var unique = selected_days.filter( onlyUnique );
  $('#selected_days').val(unique);
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}
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