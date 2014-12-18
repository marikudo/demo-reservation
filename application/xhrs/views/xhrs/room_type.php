<fieldset class="title-container">
<legend><i class="fa fa-user"></i> <?=ucwords($user['permission']['module'])?></legend>
<input type="hidden" id="room_type_id" value="<?=$user['permission']['room_type_id']?>"/>
<input type="hidden" id="data" />
<?=isset($success) ? showMessage($success) : null;?>
<div id="xrole">
<table class="table table-custom display" style="font: 12px 'Arial';" id="table">
    <thead>
      <tr>

        <th class="align-center">Action</th>
        <th class="align-left">Room Type</th>
        <th class="align-center">Rate</th>
        <th class="align-center">Extra Pax Rate</th>
        <th class="align-center">Extra Bed Rate</th>
        <th class="align-center">Room Quantity</th>
        <th class="align-center">Standard&nbsp;Capacity</th>
        <th class="align-center">Extra Bed</th>
        <th class="align-center">Extra Pax</th>
<!--         <th class="align-center">Max</th> -->
        <th class="align-center">Children</th>
        <th class="align-center">Status</th>
<!--         <th class="align-center">Publised</th> -->
        <th class="align-center">Last Update</th>
      </tr>
        </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</fieldset>

<style type="text/css">
.row{margin-left: 0px;margin-right: 0px}
.clear.space{
  height: 10px;
}
</style>
<script type="text/javascript">
var data = [];
var aSelected = [];
$(document).ready(function(){
    /* Datatable decleration
    -----------------------------*/
    var action = "<?=base_url()?>";
   var oTable =  $('#table').dataTable({
    "sDom":"Tf<'clear'><'clear space'>rtip<'clear'>",
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "api/data/?gConf=<?=$hashConfig?>",

    "aoColumns":[

                {"bSearchable":false,"mData":"button","sWidth":"80px"},
                {"bSearchable":true,"mData":"room_type","sWidth":"180px"},
                {"bSearchable":false,"mData":"rate","sWidth":"100px","sClass":'align-right'},
                {"bSearchable":false,"mData":"extra_pax_rate","sWidth":"100px","sClass":'align-right'},
                {"bSearchable":false,"mData":"extra_bed_rate","sWidth":"100px","sClass":'align-right'},
                {"bSearchable":false,"mData":"room_quantity","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"base_capacity","sWidth":"60px","sClass":'align-center'},
                {"bSearchable":false,"mData":"extra_bed","sWidth":"60px","sClass":'align-center'},
                {"bSearchable":false,"mData":"extra_pax","sWidth":"60px","sClass":'align-center'},
/*                {"bSearchable":false,"mData":"maxi_capacity","sWidth":"100px","sClass":'align-center'},*/
                {"bSearchable":false,"mData":"maxi_child","sWidth":"60px","sClass":'align-center'},
                {"bSearchable":false,"mData":"status","sWidth":"70px","sClass":'align-center'},
/*                {"bSearchable":false,"mData":"is_plublished","sWidth":"70px","sClass":'align-center'},*/
                {"bSearchable":false,"mData":"updated_at","sWidth":"170px","sClass":'align-center'},
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':true,'aTargets':[1]},
                  {'bSortable':true,'aTargets':[2]},
                  {'bSortable':false,'aTargets':[3]},
                  {'bSortable':false,'aTargets':[4]},
                  {'bSortable':false,'aTargets':[5]},
                  {'bSortable':false,'aTargets':[6]},
                  {'bSortable':false,'aTargets':[7]},
                  {'bSortable':false,'aTargets':[8]},
                  {'bSortable':false,'aTargets':[9]},
                  {'bSortable':false,'aTargets':[10]},
                  {'bSortable':false,'aTargets':[11]},
                // /*  {'bSortable':false,'aTargets':[12]},*/
                  ],
        "oTableTools": {
              "sRowSelect": "multi",
                 "aButtons": [

                              <?php
                                //start of add permission
                                if ($user['permission']['_create']==1) {
                                  ?>
                                         {
                                          "sExtends": "addBtn",
                                          "sButtonText":"<i class='fa fa-plus white'></i> New record",
                                          "sUrl":"<?=base_url()?>xhrs/<?=$user['permission']['_url']?>/new-record"
                                        },
                                      <?php
                                  /*end of add*/
                                    }

                                       ?>
                              {
                                "sExtends": "refreshBtn",

                              },
                              <?php
                                /*has permission to update*/
                                if ($user['permission']['_update']==1) {
                              ?>
                                        /*{
                                          "sExtends": "bPublishedIt",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },            {
                                          "sExtends": "bUnPublishedIt",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },*/
                                       {
                                          "sExtends": "bActivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                        {
                                          "sExtends": "bDeactivate",
                                          "dxConfig" : "<?=$hashConfig?>",
                                        },
                                  <?php
                                  /*end of update*/
                                    }
                                  ?>
                                <?php
                                //has permission to update
                                if ($user['permission']['_delete']==1) {
                              ?>
                                  {
                                   "sExtends": "deleteBtn",
                                    "dxConfig" : "<?=$hashConfig?>",
                                    'fnClick': function(nButton,oConfig){
                                        $('.DTTT_selected').each(function(){
                                            aSelected.push(this.id);
                                        });
                                        $('#mDelete-container').modal('show');
                                    }
                                  }
                            <?php
                              /*end of delelte*/
                                }
                              ?>
                             ]
            },

            "sScrollY": "375px",
            "sScrollX": "375px",
            "bScrollCollapse": false,
            "iDisplayLength": 50,

    })
    /* end of datatable
    ----------------------------------*/
  $('#mDelete').click(function(){
        $.post("<?=$user['permission']['_url']?>/delete/?gConf=<?=$hashConfig?>",{'act':true,'row':aSelected,'status':0},function(data){
          var res = data.split(':');

          if (res[0] > 0) {
            aSelected = [];
              $('#notd').html(res[1]);
              $('#result-container').modal({
                show: true,
                keyboard: false
            });
               var oTable =  $('#table').dataTable();
                  oTable.fnDraw();
                 $('.btnSelect').addClass('disabled');
          };
        });

  });

 });


</script>
<div id="result-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:390px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modaltitile" style="color:#3c763d">Successful</h4>
      </div>
      <div class="modal-body" id="modalbody">
        <p style="color:#3c763d">Role was successfully deleted.</p>
      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:15px;">OK</button>

      </div>
    </div>
</div>



<div id="mDelete-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog" style="width:350px;margin-top: 15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color:#333">Delete Role</h4>
      </div>
      <div class="modal-body">
        <p style=""><span class="glyphicon glyphicon-question-sign" style="color:#3276b1"></span> Are you sure do you want to delete?</p>

      </div>
      <div class="modal-footer" style="text-align:center;margin-top:0px">
        <button type="button" data-dismiss="modal" class="btn btn-default btn-sm pull-right" style="margin-left:15px;">No</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-sm pull-right" id="mDelete">Yes</button>

      </div>
    </div>
</div>
