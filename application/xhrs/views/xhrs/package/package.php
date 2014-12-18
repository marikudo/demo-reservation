<fieldset class="title-container">
<legend><i class="fa fa-user"></i> <?=ucwords($user['permission']['module'])?></legend>
<input type="hidden" id="packages_id" value="<?=$user['permission']['packages_id']?>"/>
<input type="hidden" id="data" />
<?=isset($success) ? showMessage($success) : null;?>
<div id="xrole">
<table class="table table-custom display" style="font: 12px 'Arial';" id="table">
    <thead>
      <tr>

        <th class="align-center">Action</th>
        <th class="align-left">Package Name</th>
        <th class="align-left">Room Type</th>
        <th class="align-center">Status</th>
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
                {"bSearchable":true,"mData":"package_name","sWidth":"400px"},
                {"bSearchable":false,"mData":"room_type","sWidth":"230px"},
             
                {"bSearchable":false,"mData":"status","sWidth":"100px","sClass":'align-center'},
                {"bSearchable":false,"mData":"updated_at","sWidth":"170px","sClass":'align-center'},
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':true,'aTargets':[1]},
                  {'bSortable':false,'aTargets':[2]},
                  {'bSortable':false,'aTargets':[3]},
                  {'bSortable':false,'aTargets':[4]},
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
                                        /*   'fnClick': function(nButton,oConfig){
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
                                            }*/
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
