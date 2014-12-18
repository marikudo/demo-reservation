<fieldset class="title-container">
<legend><i class="fa fa-user"></i> <?=ucwords($user['permission']['module'])?></legend>
<input type="hidden" id="id" value="<?=$user['permission']['id']?>"/>
<input type="hidden" id="data" />

<div id="xrole">
 <div class="custom-filter">
  <div class="pull-left" style="width:320px">
    <label class="pull-left" style="margin-top: 3px;">Select Room : </label>
    <div id="rm" class="pull-left" style="padding-left:3px;">
        <select name="room_type_id" id="room_type_id" class="selectpicker show-tick" style="float:left">
                <?php
                $first=  0;
                  foreach($rooms as $k => $v){
                     $first = $v->room_type_id;
                  $selected = ($result['room_type_id']==$v->room_type_id) ? "selected" : null;
                  ?>
                   <option value="<?=$v->room_type_id?>" <?=$selected?>><?=$v->room_type?></option>
                  <?php

                  }

                ?>
          </select>

    </div>
  </div>
</div>

<?php

  //print_pre($daily_data);
?>
  <div class="pull-left" id="monthContainer">
     <label class="pull-left" style="margin-top: 3px;">Month : </label>
      <?php
         echo monthDropdown("month",date("m",strtotime(date("Y-m-d"))),'class="selectpicker show-tick"');
        ?>
     </div>
  <div class="pull-left" id="yearContainer" style="margin-left:5px;">
     <label class="pull-left" style="margin-top: 3px;">Year : </label>
      <?php
      $from = date("Y",strtotime("-1year",strtotime(date("Y-m-d"))));
      $to = date("Y",strtotime("+2years",strtotime(date("Y-m-d"))));
      $selected = date("Y",strtotime(date("Y-m-d")));
         echo customDropDown("year",$selected,$from,$to,'class="selectpicker show-tick"');
        ?>
     </div>
<br class="clear clr cleafix" />
<div style="border-top:1px solid #ddd;height: 7px;"></div>
<table class="table table-hover table-custom display" style="font: 12px 'Arial';" id="table">
    <thead>
      <tr>

        <th class="align-left thclass"><span>Date</span></th>
        <th class="align-center thclass"><span>Sold Room</span></th>
        <th class="align-center thclass"><span>Quantity</span></th>
        <th class="align-center thclass"><input type="text" class="selector tf80 tfcenter number clearValue" onKeyUp="passedVal(this,'baseRate')" value=""><br /><span>Base Rate</span></th>
        <th class="align-center thclass"><input type="text" class="selector tf80 tfcenter number clearValue" onKeyUp="passedVal(this,'ebRate')" value=""><br /><span>Extra Bed Rate</span></th>
        <th class="align-center thclass"><input type="text" class="selector tf80 tfcenter number clearValue" onKeyUp="passedVal(this,'epRate')" value=""><br /><span>Extra Pax Rate</span></th>
        <th class="align-center thclass"><input type="checkbox" id="closeOut" class="selector tfcenter clearValue" value=""> <br /><span>Close Out</span></th>
      </tr>
        </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</fieldset>

<style type="text/css">
.row{margin-left: 0px;margin-right: 0px}
.tf80{
  width: 80px;
}
.tfcenter{
  text-align: center;
}
.thclass span{
padding: 5px 0 0;
display: block;
}

#monthContainer .btn-group.bootstrap-select{
  width: 150px;margin-left: 5px;
}
#yearContainer .btn-group.bootstrap-select{
  width: 70px;margin-left: 5px;
}
.btns{
  float: left;
}
</style>
<script type="text/javascript" src="<?=base_url('assets/xhrs/js/xhrs.misc.js')?>"></script>
<script type="text/javascript">
var data = [];
var aSelected = [];
$(document).ready(function(){

$('.number').numeric();
$('.bulkUpdate-nav-action').click(function(event){
      var action = this.id;
        if (action=='next') {
          start = $('#nextweek').val();
         // generateAvailability(start,1,false);
        }else{
          //start = $('#forprev').val();
          start = $('#prevweek').val();
          //generateAvailability(start,0,false);
        }
      event.preventDefault();

    });
  $("#date_start").datepicker({
    format: 'MM dd, yyyy',
     startDate: 0,
      autoclose: true,
      todayHighlight: false,
      onSelect:function(date){
          alert(date);
      }

  });

    /* Datatable decleration
     "sDom":"Tf<'clear'><'clear space'>rtip<'clear'>",
    -----------------------------*/
    var action = "<?=base_url()?>";
   var oTable =  $('#table').dataTable({
    "sDom":"T<'clear'>rt<'clear'>i",
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "availability_api/data/?gConf=<?=$hashConfig?>",

    "aoColumns":[

                {"bSearchable":false,"mData":"calendar_date","sWidth":"80px"},
                {"bSearchable":false,"mData":"reserve","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"qty","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"rates","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"extra_bed","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"extra_pax_rate","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"block","sWidth":"100px","sClass":'align-center'}
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':false,'aTargets':[1]},
                  {'bSortable':false,'aTargets':[2]},
                  {'bSortable':false,'aTargets':[3],mRender: function (data, type, row)
                 {

                    return '<input type="text" class="selector baseRate tf80 tfcenter number forUpdate" name="base_rate[]" onkeypress="return isNumberKey(event)" value="'+ data +'">'
                 }},
                  {'bSortable':false,'aTargets':[4],mRender: function (data, type, full)
                 {
                    return '<input type="text" class="selector ebRate tf80 tfcenter number forUpdate" onkeypress="return isNumberKey(event)" value="'+ data +'">'
                 }},
                  {'bSortable':false,'aTargets':[5],mRender: function (data, type, full)
                 {
                    return '<input type="text" class="selector epRate tf80 tfcenter number forUpdate" onkeypress="return isNumberKey(event)" value="'+ data +'">'
                 }},
                  {'bSortable':false,'aTargets':[6],mRender: function (data, type, full)
                 {

                    if (data < 1) {
                        return '<input type="checkbox" name="dbx_checkbox[]" class="selector tfcenter dbx_checkbox forUpdateCB" value="'+ data +'">'
                    }else{
                        return '<input type="checkbox" name="dbx_checkbox[]" class="selector tfcenter dbx_checkbox forUpdateCB" checked value="'+ data +'">'
                    }
                 }}
                  ],
        "oTableTools": {
              "sRowSelect": "",
                 "aButtons": [{
                                "sExtends": "refreshBtn",
                              },  <?php
                                    if ($user['permission']['_update']==1) {
                                  ?>
                                       {
                                          "sExtends": "text",
                                          "dxConfig" : "<?=$hashConfig?>",
                                          "sButtonText": "<i class='fa fa-pencil w16'></i> Update",
                                          'sButtonClass':'btn-success','fnClick' : function(nButton,oConfig){
                                              var baseRate = document.getElementsByClassName('baseRate');
                                              var ebRate = document.getElementsByClassName('ebRate');
                                              var epRate = document.getElementsByClassName('epRate');
                                              var elementsx = document.getElementsByClassName('forUpdateCB');
                                              var room_type_id = $('#room_type_id').val();
                                              var month = $('#month').val();
                                              var year = $('#year').val();
                                              var c = new Array();
                                              var chngs = [];  
                                                for (var i=0; i<baseRate.length; i++) {
                                                    var bserate = baseRate[i].defaultValue;
                                                    var brate = ebRate[i].defaultValue;
                                                    var prate = epRate[i].defaultValue;
                                                    var isCheck = elementsx[i].defaultValue;
                                                    var isChange = 0;
                                                    if(baseRate[i].value != baseRate[i].defaultValue){             
                                                           bserate = baseRate[i].value;
                                                           isChange = 1;
                                                    }

                                                    if(ebRate[i].value != ebRate[i].defaultValue){             
                                                            brate = ebRate[i].value;
                                                            isChange = 1;
                                                    }

                                                    if(epRate[i].value != epRate[i].defaultValue){             
                                                            prate = epRate[i].value;
                                                            isChange = 1;
                                                    }

                                                    if(elementsx[i].checked  != elementsx[i].defaultChecked){
                                                        isCheck = (elementsx[i].checked==false) ? 0 : 1;
                                                            isChange = 1;
                                                    }
                                                    if (isChange==1) {
                                                      chngs[i+1] = [bserate,brate,prate,isCheck];
                                                    }

                                                }

                                               
                                                $.post("<?=base_url()?>xhrs/daily-rates-and-availability/modify",{rate:chngs,room_type_id:room_type_id,month:month,year:year},function(data){
                                                  
                                                    if (data > 0) {
                                                       stest();
                                                       $('.clearValue').val("");
                                                      oTable.fnDraw(); 
                                                    };
                                                });
                                               // alert(chngs);
                                                
                                             /* var elementsx = document.getElementsByClassName('forUpdateCB');
                                                for (var i=0; i<elementsx.length; i++) {
                                                    if(elementsx[i].checked  != elementsx[i].defaultChecked){
                                                        c++;
                                                    }
                                                }

                                                if (c > 0) {
                                                }else{

                                                }*/
                                          }
                                        },
                                      <?php
                                    }
                                  ?>]
            },

            "sScrollY": "325px",
            "bScrollCollapse": false,
            "iDisplayLength": 50,
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                  aoData.push(
                    { "name": "room_type_id", "value": $('#room_type_id').val() },
                    { "name": "month", "value": $('#month').val() },
                    { "name": "year", "value": $('#year').val() } );
                  $.ajax({
                      "dataType": 'json',
                      "type": "GET",
                      "url":  "availability_api/data/?gConf=<?=$hashConfig?>",
                      "data": aoData,
                      "success": fnCallback
                  });
            }

    })
    /* end of datatable
    ----------------------------------*/
$('#room_type_id').change(function() { 
  oTable.fnDraw(); 
  $('.clearValue').val("");
});
$('#month').change(function() { oTable.fnDraw(); $('.clearValue').val("");});
$('#year').change(function() { oTable.fnDraw(); $('.clearValue').val("");});

  $('#closeOut').click(function(){
    var isCheck = $(this).is(":checked");
    isCheck = (isCheck==true) ? 1 : 0;
     checkAll(isCheck,'','dbx_checkbox');
  });


 });


function stest(){
  $('#confirm-container').modal('show');
}
</script>

