<fieldset class="title-container">
<legend><i class="ico ico-<?=$user['permission']['_url']?>"></i>Modules</legend>
<?=isset($success) ? showMessage($success) : null;?>
<input type="hidden" id="module" value="<?=$user['permission']['xparentmodule_id']?>" />
<table class="table table-hover table-custom display" style="font: 12px 'Arial';margin-top:10px;width:auto!important" id="table">
    <thead>
        <th class=" acl">Action</th>
        <th>Module Name</th>
        <th>Parent</th>
        <th class="acl">Activated</th>
        <th class="acl">Create</th>
        <th class="acl">Read</th>
        <th class="acl">Update</th>
        <th class="acl">Delete</th>
        <th class="acl">Export</th>
        <th class="acl">Print</th>
        <th class="acl">Upload</th>
        </thead>
    <tbody>
    </tbody>
  </table>

      
</fieldset>

</fieldset>
<script type="text/javascript">
var data = [];
$(document).ready(function(){
    /* Datatable decleration
    -----------------------------*/
   var oTable =  $('#table').dataTable({
    "sDom":"Tf<'clear'>rtip<'clear'>",
    "bProcessing": true,  
    "bServerSide": true,
    "sAjaxSource": "api/data/?gConf=<?=$hashConfig?>",
    
    "aoColumns":[

                {"bSearchable":false,"mData":"button","sWidth":"80px"},
                {"bSearchable":true,"mData":"parentmodule","sWidth":"150px",},
                {"bSearchable":true,"mData":"parent_id","sWidth":"150px",},
                {"bSearchable":false,"mData":"status","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xcreate","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xread","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xupdate","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xdelete","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xexport","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xprint","sWidth":"50px","sClass":'align-center'},
                {"bSearchable":true,"mData":"_xupload","sWidth":"50px","sClass":'align-center'},
                ],
    "aoColumnDefs":[
                  {'bSortable':false,'aTargets':[0]},
                  {'bSortable':true,'aTargets':[1]},
                  {'bSortable':true,'aTargets':[2]},
                  {'bSortable':true,'aTargets':[3]},
                  {'bSortable':true,'aTargets':[4]},
                  {'bSortable':true,'aTargets':[5]},
                  {'bSortable':true,'aTargets':[6]},
                  {'bSortable':true,'aTargets':[7]},
                  {'bSortable':true,'aTargets':[7]},
                  ],
        "oTableTools": {
              "sRowSelect": "multi",
                 "aButtons": [

                              <?php
                                if ($user['permission']['_create']==1) {
                                  ?>
                                         {
                                          "sExtends": "addBtn",
                                          "sButtonText":"<i class='fa fa-plus white'></i> New record",
                                          "sUrl":"<?=base_url()?>xhrs/<?=$user['permission']['_url']?>/new-record"
                                        },
                                      <?php
                                    }
                                    ?>
                              {
                                "sExtends": "refreshBtn",
                              },
                              <?php
                                    if ($user['permission']['_update']==1) {
                                  ?>
                                       {
                                          "sExtends": "bActivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                        {
                                          "sExtends": "bDeactivate",
                                          "dxConfig" : "<?=$hashConfig?>"
                                        },
                                      <?php
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

 });
</script>

						
						
				
	



