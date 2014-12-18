<fieldset class="title-container">
<legend><i class="fa fa-user"></i> <?=ucwords($user['permission']['module'])?></legend>
<input type="hidden" id="department_id" value="<?=$user['permission']['department_id']?>"/>
<input type="hidden" id="data" />
<?=isset($success) ? showMessage($success) : null;?>
<div id="xrole">
<table class="table table-hover table-custom display" style="font: 12px 'Arial';" id="table">
    <thead>
      <tr>
        <th class="align-center">Action</th>
        <th class="align-center">User Role</th>
        <th class="align-center">Status</th>
      </tr>
        </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</fieldset>

<style type="text/css">
.row{margin-left: 0px;margin-right: 0px}
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

                {"bSearchable":false,"mData":"button","sWidth":"50px"},
                {"bSearchable":true,"mData":"role"},
                {"bSearchable":false,"mData":"status","sWidth":"100px","sClass":'align-center'},
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':true,'aTargets':[1]},
                  {'bSortable':true,'aTargets':[2]},
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
                                       {
                                          "sExtends": "bActivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                        {
                                          "sExtends": "bDeactivate",
                                          "dxConfig" : "<?=$hashConfig?>",
                                           'fnClick': function(nButton,oConfig){
                                              var aSelected = [];
                                              $('.DTTT_selected').each(function(){
                                                  aSelected.push(this.id);
                                              });
                                              
                                              $.post("role/dactive/?gConf="+oConfig.dxConfig,{'act':true,'row':aSelected,'status':1},function(result){
                                                  
                                                  $('.btnSelect').addClass('disabled');
                                                  var data = result.split(':');
                                                      oTable.fnDraw();
                                                  if (data[0] > 0 && data[1]=="") {
                                                       $('#result-container').modal({
                                                            show: true,
                                                            keyboard: false
                                                        });
                                                       var success = "<p>Role was successfully de-activated.</p>";
                                                        $('#modalbody').html(success).css({'color':'#3c763d'});

                                                  }else if(data[0] > 0 && data[1]!=""){
                                                       $('#result-container').modal({
                                                            show: true,
                                                            keyboard: false
                                                        });
                                                       var success = "<p>Role was successfully de-activated.</p>";
                                                       var Warning = "<p style='color:#d43f3a'>Unable to de-activate. <br /><small style='color:#777'>"+data[1]+"</small></p>";
                                                         $('#modalbody').html(success +""+Warning );


                                                  }else if(data[0] == 0 && data[1] != ""){
                                                       $('#result-container').modal({
                                                            show: true,
                                                            keyboard: false
                                                        });
                                                        $('#modaltitile').html("Warning").css({'color':'orange'});
                                                        $('#modalbody').html("<p>Unable to de-activate. <br /><small style='color:#777'>"+data[1]+"</small></p>").css({'color':'#d43f3a'});

                                                  };
                                              });
                                            aSelected = [];
                                            }
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
            "bScrollCollapse": false,
            "iDisplayLength": 50,

    })
    /* end of datatable
    ----------------------------------*/
  $('#mDelete').click(function(){
        $.post("role/delete/?gConf=<?=$hashConfig?>",{'act':true,'row':aSelected,'status':0},function(data){
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



<!-- <div id="mDelete-container" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
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
 -->