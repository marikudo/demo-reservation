<fieldset class="title-container">
<legend><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : 'New' ?> Room Type</legend>
	<form action="" method="POST" class="form-horizontal" id="validate-form">
		<div class="form-group" style="height:300px;">
	    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Descriptions :</label>
	    	<div class="col-sm-10 ">
	    		<textarea name="descriptions" id="descriptions"><?=$result['descriptions']?></textarea>
	    		 <span class="validation-status"></span>
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
var roxyFileman = '<?=base_url()?>assets/xhrs/fileman/index.html';
var editor = CKEDITOR.replace('descriptions',
	{

			filebrowserBrowseUrl : roxyFileman,
			filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload',
			toolbar:[
				{ name: 'clipboard', groups: [ 'undo' ], items: [ 'Undo', 'Redo' ] },
				{ name: 'basicstyles', groups: ['basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
				{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
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