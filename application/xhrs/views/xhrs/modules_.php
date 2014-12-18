<fieldset class="title-container">
<legend><i class="ico ico-<?=$user['permission']['_url']?>"></i>Modules</legend>
  <form action="" method="POST" class="form-horizontal" id="validate-form">
    <?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','warning')?>

    <div class="form-group">
        <label class="col-sm-3 control-label ckey"><span class="required">*</span> Label</label>
        <div class="col-sm-5">
            <?=htmlSelect($label,'xparentlabel_id','xparentlabel_id','label','selectpicker show-tick',$result['xparentlabel_id'],false)?>
          <span class="validation-status"></span>
          </div>
    </div>      
    <?php
  $parent_id = $result['parent_id'];
            if ($parent_id > 0 || $action=='new-record') {
    ?>
    <div class="form-group">
        <label class="col-sm-3 control-label ckey">Module</label>
        <div class="col-sm-5">
            <?php
              //$xparentmodule_id = $result['xparentmodule_id'];
           
           echo htmlSelect($xmodules,'parent_id','xparentmodule_id','parentmodule','selectpicker show-tick',$parent_id,true);
          
           ?>
          <span class="validation-status"></span>
          </div>
    </div>
    <?php
      }
    ?>
    <div class="form-group">
        <label class="col-sm-3 control-label ckey"><span class="required">*</span> Module or (Sub)</label>
        <div class="col-sm-6">
          <?php
            $parentmodule = $result['parentmodule'];
            if ($result['xparentmodule_id'] > 0) {
           
            }
          ?>
          <input type="text" class="form-control" name="parentmodule" style="width:250px;float:left" id="parentmodule" value="<?=$parentmodule?>" />
          <span class="validation-status"></span>
        </div>
    </div>

     <div class="form-group">
        <label class="col-sm-3 control-label ckey"><span class="required">*</span> Url</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" style="width:250px;float:left"   name="_xurl" id="_xurl" value="<?=(isset($result['_xurl']) ? $result['_xurl'] : null)?>" /><span class="validation-status"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label ckey"> Permission</label>
        <div class="col-sm-3">
          <table id="create-new-table"  class="table" style="font: 12px 'Arial';border:none!important;margin-bottom:0">
            <thead>
              <tr>
               
                <th class="acl">Activated</th>
                <th class="acl">Create</th>
                <th class="acl">Read</th>
                <th class="acl">Update</th>
                <th class="acl">Delete</th>
                <th class="acl">Export</th>
                <th class="acl" style="width:35px!important">Print</th>
                <th class="acl" style="width:35px!important">Upload</th>
              </tr>
            </thead>
            <tbody> 
            <tr>
              <td style="text-align:center"><center><?=createCheckBox('status',$result['status'])?></center></td>
              <td style="text-align:center"> <?=createCheckBox('_xcreate',$result['_xcreate'])?></td>
              <td style="text-align:center"> <?=createCheckBox('_xread',$result['_xread'])?></td>
              <td style="text-align:center"> <?=createCheckBox('_xupdate',$result['_xupdate'])?></td>
              <td style="text-align:center"> <?=createCheckBox('_xdelete',$result['_xdelete'])?></td>
              <td style="text-align:center"> <?=createCheckBox('_xexport',$result['_xexport'])?></td>
              <td style="width:35px!important;text-align:center"> <?=createCheckBox('_xprint',$result['_xprint'])?></td>
              <td style="width:35px!important;text-align:center"> <?=createCheckBox('_xupload',$result['_xupload'])?></td></tr>
            </tbody>
          </table>


        </div>
    </div>

          <div class="form-group">
          <label class="col-sm-3 control-label ckey"></label>
                <div class="col-sm-3">

              <button type="submit" class="btn btn-sm btn-success" name="btn-submit"><?=(strtolower($action)== 'add') ? 'Create New' : 'Save Changes'?></button> or <a href="javascript:history.back()">Cancel</a> 
             
          </div>
        </div>
  </form> 
</fieldset>

</fieldset>
<script type="text/javascript">
  $(document).ready(function(){
   $("#validate-form").trigger('reset');
    var validator = $("#validate-form").validate({
    rules: {
      xparentmodule_id:{
        required:true
      },parentmodule: {
        required: true
      },_xurl:{
        required:true
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
        $.ajax({
            type: "POST",
            url: "",
            data: $('form#validate-form').serialize(),
                success: function(result){
                    window.location = '<?=base_url()?>xhrs/modules';
                 },
                 error: function(){
                alert("Error.");
                }
       });
    }
  });

    $('#xparentlabel_id').change(function(){
       var label_id = $(this).val();
          if (label_id!="") {
              $.post("<?=base_url()?>xhrs/modules/getxmodules",{label_id:label_id},function(data){
                  $('#parent_id').html(data).selectpicker('refresh');
              });
          }else{

          }
    });

  });
</script>
<style type="text/css">
.validation-status{float: left;
margin-left: 10px;}
</style>

						
						
				
	



