<fieldset class="title-container">
<legend><i class="custom-icon-role"></i> Users Role</legend>
<input type="hidden" id="module" value="<?=$user['permission']['xparentmodule_id']?>"/>
<input type="hidden" id="data" />
<?//=action_button($data['permission']);?>
<?=isset($success) ? showMessage($success) : null;?>
<div id="xrole">

<table class="table table-hover table-custom display" style="font: 12px 'Arial';" id="table">
		<thead>
			<tr>
			  <th style="width: 190px;">Role Name</th>
			  <th>Modules</th>
			  <th class="acl">Status</th>
			  <th class="width110 forprint">Action</th>
			</tr>
        </thead>
		<tbody>
			
		<?php
		//print_r($user['permission']['_url']);
		$ctr = 1;
		foreach($userRole as $k){
			//$delete 	= ($k->xroles_id !=2) ? "<a href='#stack1' class='delete actions' data-toggle='modal' data-index='".($ctr)."' id='role_id_".genKey($k->xroles_id)."'><i class='icon-remove-circle'></i> Delete</a>": '- -';
			$admin 	= ($k->xroles_id !=2) ? "<a href='#stack1' class='delete actions' data-toggle='modal' data-index='".($ctr)."' id='role_id_".genKey($k->xroles_id)."'><i class='icon-remove-circle'></i> Make as Admin</a>": '- -';
			
			//$edit 		= "<a href='".base_url()."xhrs/role/edit/".genKey($k->xroles_id)."' class='actions'><i class='icon-pencil'></i> Edit</a>" ;
			$checkbox 		= ($k->xroles_id!=2) ? "<input type='checkbox' class='check css-checkbox' name='_".($ctr)."' id='_".($k->xroles_id)."' value='".genKey($k->xroles_id)."'><label for='_".($ctr)."' class='css-label'></label>" : "<div style='height:14px;width:14px;border:1px solid #ddd'></div>";
			
			$delete   = "<a href='#stack1' class='delete actions' data-toggle='modal' data-index='".($ctr)."' id='xroles_id_".genKey($k->xroles_id)."'><i class='fa fa-times red'></i> Delete</a>";
      		$edit     = "<a href='".base_url('xhrs/'.$user['permission']['_url']).'/modify/'.genKey($k->xroles_id)."' class='actions'><i class='fa fa-pencil' style='color:orange'></i> Edit</a>";
     

			$actions 	=  '';

			 $dropdown ='<ul class="nav navbar-nav navbar-right action-dropdown" style="width: 42px;margin: 0 auto;">';
      $dropdown .='       <li class="dropdown">';
      $dropdown .='         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear gray"></i></a>';
      $dropdown .='        <ul class="dropdown-menu" role="menu" aria-labelledby="user-dropdown" style="border-radius: 0px;margin-top: -43px;">';
			if($user['permission']['_update']==1){
      $dropdown .='        <li>'.$edit.'</li>';
			}
			if ( ($k->xroles_id > 2)) {
      	$dropdown .='        <li>'.$delete.'</li>';
				# code...
			}
                          
      $dropdown .='         </ul>';
      $dropdown .='       </li>';
      $dropdown .='     </ul>';
     // if ($user['permission']['_update']==1 || $user['permission']['_delete']==1 ) {
      $actions .=$dropdown;
      //}
			
			$activated 	= ($k->status==1) ? "Active" : "De-Active";
			$s 	= ($k->status==1) ? "label label-success" : "label label-warning";
		//	$activated 	= ($k->status==1) ? "icon-ok" : "icon-remove";
		echo "<tr id='delete_".($ctr)."'><td class='text-align'><strong>".$k->role."</strong></td><td class='text-align'><i>".rtrim($child[$k->xroles_id],',')."</i></td><td class='align-center'><span class='".$s."'>".$activated."</span></td><td class=\"forprint align-center \">".$actions."</td></tr>";
		$ctr++;
		}
			
			
			?>
			
		
			
		</tbody>
	</table>
	</div>
</fieldset>

<style type="text/css">
.row{margin-left: 0px;margin-right: 0px}
</style>
<script type="text/javascript">
var editor;
var forexport;
$(document).ready(function(){
var options = { container: $('#role'), showIndeterminate: true };
/* $('#check-all').checkAll(options);
		$.extend( true, $.fn.DataTable.TableTools.classes, {
				"container": "btn-group",
				"buttons": {
					"normal": "btn btn-default btn-sm",
					"disabled": "btn disabled"
				},
				"collection": {
					"container": "DTTT_dropdown dropdown-menu",
					"buttons": {
						"normal": "",
						"disabled": "disabled"
					}
				}
			} );*/

TableTools.BUTTONS.addBtn = $.extend( true,{}, $.fn.DataTable.TableTools.buttonBase, {
        'sButtonText': "Add New",
         'fnClick': function(nButton,oConfig){
             //$('#success_modal').modal();
             window.location = oConfig.sUrl
          }

      });
    $.extend( true, $.fn.DataTable.TableTools.classes, {
        "container": "btns",
        "buttons": {
          "normal": "btn btn-default btn-sm",
          "disabled": "btn disabled"
        },
        "collection": {
          "container": "DTTT_dropdown dropdown-menu",
          "buttons": {
            "normal": "btn btn-default",
            "disabled": "disabled"
          }
        }
      } );

		/* Datatable decleration
		-----------------------------*/
	 var oTable =  $('#table').dataTable({
		      /* "sDom": "<'row pull-left action-panel'T><'row pull-right search 'f><'clr'>t<'row pull-right pagination'p><'clr'>",
		      //  "aoColumns":[{"sWidth":"10px"},{"sWidth":"10px"},{"sWidth":"10px"},{"sWidth":"10px"},{"sWidth":"10px"}],
		      "sPaginationType": "bootstrap",
		      "oLanguage": {
		        "sLengthMenu": "_MENU_ records per page"
		      },
        	"oTableTools": {
               "sRowSelect": "multi",
                 "aButtons": [
                     <?=action_button($user['permission'])?>
                           ]
            },"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "scripts/jsonp.php",
				"fnServerData": function( sUrl, aoData, fnCallback, oSettings ) {
					oSettings.jqXHR = $.ajax( {
						"url": sUrl,
						"data": aoData,
						"success": fnCallback,
						"dataType": "jsonp",
						"cache": false
					} );
				}*/

				"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "api/<?=$user['permission']['_url']?>/",
					"fnServerData": function( sUrl, aoData, fnCallback, oSettings ) {
						oSettings.jqXHR = $.ajax( {
							"url": sUrl,
							"data": aoData,
							"success": fnCallback,
							"dataType": "jsonp",
							"cache": false
						} );
					}
    });
		/* end of datatable
		----------------------------------*/
	
 });
</script>