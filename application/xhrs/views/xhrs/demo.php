<fieldset class="title-container">
<legend><i class="fa fa-user"></i> Account Information <small>This page shows your personal information.</small></legend>
<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>
<form class="form-horizontal" role="form" action="<?=base_url('xhrs/demo')?>" method="post" enctype="multipart/form-data" id="validate-form">
 
<div class="form-group">
    <label class="col-sm-3 control-label ckey"><span class="required">*</span> First Name</label>
    <div class="col-sm-5">
       <input type="file" class="form-control toUpperCase alpha" id="picture" name="picture">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label ckey"><span class="required">*</span> First Name</label>
    <div class="col-sm-5">
       <input type="text" class="form-control toUpperCase alpha" id="first_name" name="first_name" value="<?=$user['first_name']?>">
    	<span class="validation-status"></span>
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

  <div class="form-group">
    <label for="inputPassword" class="col-sm-3 control-label ckey"><span class="required">*</span> Content</label>
    <div class="col-sm-10">
       <textarea name="content" id="content"></textarea>
    </div>
  </div>

 
    <div class="form-actions" style="padding-left:20px">
    <div id="prg"></div>
    <progress value="0" min="0" max="100"></progress>

	<button type="submit" class="btn btn-primary blue">Save changes</button>
	</div>
</form>

</fieldset>

<script type="text/javascript">

$(document).ready(function(){


	//prepare text editor
var editor = CKEDITOR.replace('content',
	{

			filebrowserBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor',
			filebrowserImageBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb/pdw_file_browser/index.php?editor=ckeditor&filter=image',
			filebrowserFlashBrowseUrl : '<?=base_url()?>assets/xhrs/ckeditor_4.4.3_2cdcc5dbd4cb//pdw_file_browser/index.php?editor=ckeditor&filter=flash',
			// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
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
    CKEDITOR.config.contentsCss = '<?=base_url()?>assets/xhrs/bootstrap-3.1.1/css/bootstrap.css' ; 

    //validate form
    var validator = $("#validate-form").validate({
				    rules: {
				      last_name:{
				        required:true
				      },first_name: {
				        required: true,
				      },middle_name: {
				        required: true,
				      }
				    
				    },messages:{
				    	last_name:{
				    		required: "please"
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
					      $('button[type="submit"]').attr('disabled', 'true');
					      $(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });

					      	//get html data of editor
					      	var value = CKEDITOR.instances['content'].getData();
					      					alert($(form));
					      	var formx = new FormData($(form)[0]);
					      	formx.append('content',value);
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
				                    alert(1)
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




