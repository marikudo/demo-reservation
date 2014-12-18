<?php
if(!defined('APPS')) exit ('No direct access allowed');
class availability_api extends crackerjack{

	private $status;
	public function __construct(){
		parent::__construct();
			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}

			if (isAjax()==false) {
				redirect('xhrs/home/auth');
			}

	}

	public function index($id = false){
		require_once('system/core/error.php');
	}

	public function data(){

		//config
		if (isset($_GET['gConf'])) {
			$gConfig = unserialize(base64_decode($_GET['gConf']));
			extract($gConfig['uPermission']);
			}
		//	echo $_url;
		//print_r($gConfig['uPermission']);
		$aModule = trim(strtolower($module));
		$aModule = str_replace(' ', '_', $aModule);
		$mxConfig = $this->gData->$aModule();
		$aColumns =$mxConfig['aColumns'];
		$sIndexColumn = $mxConfig['iColumn'];
		$sTable = $mxConfig['tName']." ".$mxConfig['qJoin'];
		//$sTable = $mxConfig['qJoin'];

		//print_r($gConfig);

		//Paging
		$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
			}

		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{

					/*$aSort = $aColumns[ intval( $_GET['iSortCol_'.$i] ) ];
						if ($aSort=='status') {
							$aSort = 'status';
						}*/
						$aSort = preg_replace("/[a-zA-Z0-9_]*+./","$2", $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]);
					$sOrder .= "`".$aSort."` ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}

			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}




		$sWhere = "";
	$aWhere = array();
	/*
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
				{
					$sWhere .= $aColumns[$i]." LIKE :".$aColumns[$i]." OR ";
					$aWhere[':'.$aColumns[$i]] = $_GET['sSearch'].'%';
				}
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= '';
		}

		 Individual column filtering
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE (";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
		$sWhere .=") ";
		}*/

		if (isset($_GET['room_type_id']) && $_GET['room_type_id'] != "" ) {
			$sWhere .= " WHERE reference_id = :reference_id ";
			$aWhere[':reference_id'] = $_GET['room_type_id'];
		}

		switch ($aModule) {

			default:
					if ($sWhere!="") {
					//	$sWhere .= ' AND (xparentmodule_id > 1)';
					}else{
						//$sWhere .= 'WHERE';
					}
				break;
		}
		/*
		 * SQL queries
		 * Get data to display
		 */
		//$sQuery = "SELECT $sIndexColumn,".str_replace(" , ", " ", implode(", ", array_filter($aColumns)))." FROM $sTable $sWhere $sOrder $sLimit";

		 //$sQueryx = "SELECT $sIndexColumn,".str_replace(" , ", " ", implode(", ", array_filter($aColumns)))." FROM $sTable $sWhere $sOrder";
		//$result = $this->crud->read($sQuery,$aWhere,'obj');
		//$count = $this->crud->read($sQueryx,$aWhere,'obj');


			// Start date
		$date = date("Y-m-01");
		// End date
		$end_date = date("Y-m-t",strtotime($date));

		if (isset($_GET['month']) && $_GET['month'] != "" || isset($_GET['year']) && $_GET['year'] != "" ) {
			$date = $_GET['year'].'-'.$_GET['month'].'-01';
			$end_date = date("Y-m-t",strtotime($date));
			//$end_date = $_GET['year'].'-'.$_GET['month'].'';
		}


		$end = date("t", strtotime($date));
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $end,
			"iTotalDisplayRecords" => $end,
			"aaData" => array()
		);


		$room_type_id = $_GET['room_type_id'];

		$yearStart = date("Y",strtotime($date));
		$yearEnd = date("Y",strtotime($end_date));
		$dateQueue = array();
		$ctr = 1;
			while (strtotime($date) <= strtotime($end_date)) {
					$row = array();

					$dQuery = "SELECT * FROM _tdailyblockings_and_rates WHERE reference_id=:reference_id AND calendar_date=:calendar_date";
					$dQueryRoom = "SELECT * FROM _troom_type WHERE room_type_id=:reference_id AND status=1";
					$aResultx = $this->crud->read($dQuery,array(':reference_id'=>$room_type_id,':calendar_date'=>$date),"assoc");
					$dQueryRoomResult = $this->crud->read($dQueryRoom,array(':reference_id'=>$room_type_id),"assoc");
					//echo count($aResultx);
					//print_r($aResultx);
					$rates = $dQueryRoomResult['rate'];
					$child_rate = $dQueryRoomResult['child_rate'];
					$extra_pax_rate = $dQueryRoomResult['extra_pax_rate'];
					$extra_bed = $dQueryRoomResult['extra_bed_rate'];
					$qty = $dQueryRoomResult['room_quantity'];
					$block = 0;
					$reserve = 0;
					
					if ($aResultx) {
						$rates = $aResultx['daily_rates'];
						$extra_bed = $aResultx['extra_bed'];
						$extra_pax_rate = $aResultx['extra_pax'];
						$block = $aResultx['blocked'];
						/*
						$extra_bed = $aResultx->extra_bed_rate;*/
					}

					$dQueryx = "SELECT count(tb.bookings_id) as reserve FROM _tbooking_dates AS tbd LEFT JOIN _tbookings AS tb ON tbd.bookings_id = tb.bookings_id WHERE tbd.reference_id=:reference_id AND tbd.calendar_date =:calendar_date AND tb.booking_status='Confirmed'";
					$aResulty = $this->crud->read($dQueryx,array(':reference_id'=>$room_type_id,':calendar_date'=>$date),"obj");
				//	print_r($aResulty);
						if ($aResulty[0]->reserve > 0) {
						$reserve = $aResulty[0]->reserve;
						}
					$row['calendar_date'] = date("F j, Y",strtotime($date));
					$row['rates'] = number_format($rates,2);
					$row['block'] = $block;
					$row['child_rate'] = number_format($child_rate,2);
					$row['extra_bed'] = number_format($extra_bed,2);
					$row['extra_pax_rate'] = number_format($extra_pax_rate,2);
					$row['reserve'] = $reserve;
					$row['qty'] = ($reserve >= $qty) ? $reserve : $qty;
					$row['DT_RowId'] = genKey($v->$sIndexColumn);
					$row['checkbox'] = '<input type="checkbox"/>';
					$row['button'] = "<center>".$button."</center>";
					$output['aaData'][] = $row;

				$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
				$ctr++;
			}


			// if (count($result) > 0) {
			// 	$ctr = 1;
			// 	foreach ($result as $v) {
			// 		$row = array();
			// 		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			// 			if ($aColumns[$i]!="") {
			// 				$mCol = preg_replace("/[a-zA-Z0-9_]*+./","$2",$aColumns[$i]);
			// 				$row[$mCol] = $v->$mCol;





			// 			}
			// 		}


			// 		$sLabel = ($v->status==1) ? 'Deactive' : 'Activate';
			// 		 $sLabelx = ($v->status==1) ? 0 : 1;

			// 		 $activate   = "<a href='javascript:void()' onClick=\"fActivate(".$ctr.",'".genKey($v->$sIndexColumn)."','".$_GET['gConf']."','".$sLabelx."')\" class='activate actions' data-toggle='modal' data-index='".($ctr)."' id='".genKey($indxColumn)."'><i class='fa fa-check green w16'></i> ".$sLabel."</a>";
			// 	    $row['DT_RowId'] = genKey($v->$sIndexColumn);
			// 		$row['checkbox'] = '<input type="checkbox"/>';
			// 		$row['button'] = "<center>".$button."</center>";
			// 		$output['aaData'][] = $row;
			// 		$ctr++;
			// 	}
			// }
		header('Content-Type: application/json');
		echo json_encode($output);
	}




}