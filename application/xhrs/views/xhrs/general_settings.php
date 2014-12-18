<fieldset class="title-container">
<legend><i class="fa fa-gear"></i> General Booking Settings</legend>
<!--   <fieldset class="sm-title">
  <legend><i class="fa fa-paypal fa-fw"></i>Payment Gateway</legend>
  <div class="row">
  <form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/settings')?>" method="post" enctype="multipart/form-data">

     <div class="form-group">
      <label class="col-sm-3 control-label ckey">Paypal email address :</label>
      <div class="col-sm-7 vals clearfix">
        <span class="pull-left" style="margin-right:10px"><?=$payment['payment_gateway_email']?></span>
        <a href="#dit" class="pull-left edit" id="editEmail"><i class="fa fa-edit"></i> Edit</a>
      </div>
    </div>
  <div id="payment_container">
    <div class="form-group">
      <label class="col-sm-3 control-label ckey"><span class="required">*</span> New Paypal email address </label>
      <div class="col-sm-4">
         <input type="email" class="form-control " id="payment_gateway_email" name="payment_gateway_email" value=""><small>Enter the email address that you use for your paypal account.</small>
      </div>
    </div>
      <div class="form-actions" style="padding-left:20px">
    <button type="submit" class="btn btn-success blue btn-sm" name="change_email">Save changes</button>
    </div>
  </div>
  </form>
  </div>
</fieldset> -->

<fieldset class="sm-title">
  <legend><i class="fa fa-cogs fa-fw"></i>Payment Settings </legend>
  <div class="row">
  <form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/settings')?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="col-sm-3 control-label ckey"></label>
      <div class="col-sm-6">
        <small><span class="badge badge-warning">Note:</span> Dowmpayment will apply to all bookings such as Room, promo and packages.</small>
      </div>
    </div>

     <div class="form-group">
      <label class="col-sm-3 control-label ckey">Downpayment :</label>
      <div class="col-sm-5">
        <span style="margin-left: 5px;padding-top: 4px;display: block;float: left;"><?=$downpayment['percentage']?>%</span>
        <br class="clearfix"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label ckey">Payment Gateway :</label>
      <div class="col-sm-5">
        <span style="margin-left: 5px;padding-top: 4px;display: block;float: left;"><?=$payment['gateway']?></span>
        <br class="clearfix"/>
      </div>
    </div>

        <div class="form-group">
      <label class="col-sm-3 control-label ckey">Gateway Email:</label>
      <div class="col-sm-5">
        <span style="margin-left: 5px;padding-top: 4px;display: block;float: left;"><?=$payment['payment_gateway_email']?></span>
        <br class="clearfix"/>
      </div>
    </div>
     <!--  <div class="form-actions" style="padding-left:20px">
    <button type="submit" class="btn btn-success blue btn-sm" name="change_email">Save changes</button>
    </div> -->
  </form>
  </div>
</fieldset>

<fieldset class="sm-title">
  <legend><i class="fa fa-clock-o fa-fw"></i>Date and Timezone Settings </legend>
  <div class="row">
  <form class="form-horizontal" role="form" action="<?=base_url('xhrs/account/settings')?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="col-sm-3 control-label ckey">Timezone :</label>
      <div class="col-sm-6" style="padding-top: 6px;">
        <p>Asia/Manila</p>
      </div>
    </div>

     <div class="form-group">
      <label class="col-sm-3 control-label ckey">Date Format :</label>
      <div class="col-sm-5 vals">
      <p> MM-dd-yyyy</p>
       <!--  <select class="selectpicker" name="date_format" id="date_format">
            <option value="MM-dd-yyyy">MM-dd-yyyy</option>
            <option value="dd-MM-yyyy">dd-MM-yyyy</option>
        </select> -->
      </div>
    </div>
     <!--  <div class="form-actions" style="padding-left:20px">
    <button type="submit" class="btn btn-success blue btn-sm" name="change_email">Save changes</button>

    </div>-->
  </form>
  </div>
</fieldset>

</fieldset>
<script type="text/javascript">
  $(document).ready(function(){
    $('#payment_container').hide();
    $('#editEmail').click(function(){
      if($('#payment_container').css('display')=='none'){
          $(this).html('Hide');
          $('#payment_container').slideDown();
        }else{
          $('#payment_container').slideUp();
          $(this).html('<i class="fa fa-edit"></i> Edit');
        }
    })

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

     $('.selectpicker').selectpicker({
    size: 10
  });

  });
</script>
<style type="text/css">

.fa-fw {width: 2em;}

.ctab .nav > li > a {
padding: 5px 15px;color: #333
}
.ctab .nav > li > a:hover {
color: #114684
}

.ctab .nav > li.active > a {
background: #eee
}

.edit{
  font-size: 12px;color: orange;margin-top: 3px;
}
</style>








