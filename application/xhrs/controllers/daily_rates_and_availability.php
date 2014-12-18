<?php
class daily_rates_and_availability extends crackerjack{
		private $labels;
		public function __construct(){
			parent::__construct();
			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}


		}

		public function index(){
			if($this->session->_get('message')==1){
					if ($this->session->_get('action')=='add') {
						$data['success'] = '<strong>Congratulations!.</strong> New record successfully added.';
					}
					$this->session->_set(array('message'=>0,'action'=>''));

			}

			/*PREPARE DATE*/

			$dQueryRoom = "SELECT * FROM _troom_type WHERE status=1";
			$dQueryRoomResult = $this->crud->read($dQueryRoom,array(),"obj");
			$output = array();
			$datex		= '2014-12-01';
			$end_datex 	= '2014-12-15';
				if ($dQueryRoomResult) {
					foreach ($dQueryRoomResult as $get) {
						$rates = $get->rate;
						$child_rate = $get->child_rate;
						$extra_pax_rate = $get->extra_pax_rate;
						$room_type_id = $get->room_type_id;
						$date		= '2014-12-01';
						$end_date 	= '2014-12-15';
						$ctr = 0;
						while (strtotime($date) <= strtotime($end_date)) {
								$row = array();

								$dQuery = "SELECT * FROM _tdailyblockings_and_rates WHERE reference_id=:reference_id AND calendar_date=:calendar_date";
								$aResultx = $this->crud->read($dQuery,array(':reference_id'=>$room_type_id,':calendar_date'=>$date),"obj");
								//echo count($aResultx);
								//print_r($aResultx);

								$block = '0';
								$qty = '0';
								if (count($aResultx) > 0) {

								$rates = $aResultx->daily_rates;
								$block = $aResultx->blocked;
								$qty = '0';
								}
								$row['calendar_date'] = date("F j, Y",strtotime($date));
								$row['rates'] = number_format($rates,2);
								$row['block'] = $block;
								$row['child_rate'] = number_format($child_rate,2);
								$row['extra_pax_rate'] = number_format($extra_pax_rate,2);
								$row['qty'] = $qty;
								$row['DT_RowId'] = genKey($v->$sIndexColumn);
								$row['checkbox'] = '<input type="checkbox"/>';
								$row['button'] = "<center>".$button."</center>";
								$output[$room_type_id][$date] = $row;

							$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							$ctr++;
						}
					}
				}

			$data['daily_data'] =$output;
			$data['date_start'] =$datex;
			$data['date_end'] =$end_datex;
			$data['rooms'] = $this->crud->read("SELECT * FROM _troom_type WHERE status=1",array(),"obj");
			//$data['result'] = $this->crud->read("SELECT * FROM _xparentmodule",array(),'obj');
			$this->template->_admin('xhrs/daily_rates_and_availability',$data,$this->load);
		}

		public function modify($id =false){
			if (isAjax()) {
				if (isset($_POST['rate']) && count($_POST['rate']) > 0) {

					$c = 0;
						foreach ($_POST['rate'] as $date => $rates) {
							if (count($rates) > 1) {
								$room_type_id = $_POST['room_type_id'];
								$strtotime = mktime(0, 0, 0, $_POST['month'], $date, $_POST['year']);
								$calendarDate = date("Y-m-d",$strtotime);
								$baseRate = $rates[0];
								$extraBedRate = $rates[1];
								$extraPaxRate = $rates[2];
								$isBlocked = $rates[3];

								$aResult = $this->dailyblockings_and_rates($room_type_id,$calendarDate);
								if ($aResult) {
									$updateData['calendar_date'] = $calendarDate;
									$updateData['daily_rates'] = $baseRate;
									$updateData['extra_bed'] = $extraBedRate;
									$updateData['extra_pax'] = $extraPaxRate;
									$updateData['blocked'] = ($isBlocked==1) ? $isBlocked : '0';
										$c += $this->crud->update('_tdailyblockings_and_rates',$updateData,array('id'=>$aResult['id']));	
									}else{
									$dQueryRoom = "SELECT * FROM _troom_type WHERE status=1 AND room_type_id =:id";
									$dQueryRoomResult = $this->crud->read($dQueryRoom,array(':id'=>$room_type_id),"assoc");
									$insertData['reference_id'] = $room_type_id;
									$insertData['calendar_date'] = $calendarDate;
									$insertData['daily_rates'] = $dQueryRoomResult['rate'];
									$insertData['extra_bed'] = $dQueryRoomResult['extra_bed_rate'];
									$insertData['extra_pax'] = $dQueryRoomResult['extra_pax_rate'];
									$insertData['blocked'] = ($isBlocked==1) ? $isBlocked : '0';
									$c += $this->crud->create('_tdailyblockings_and_rates',$insertData);
								}
								
							}
						}
					echo $c;
				}
				//print_r($_POST['rate']);
			}
		}

		private function dailyblockings_and_rates($room_type_id,$calendar_date){
			$dQuery = "SELECT * FROM _tdailyblockings_and_rates WHERE reference_id=:reference_id AND calendar_date=:calendar_date";
			$aResultx = $this->crud->read($dQuery,array(':reference_id'=>$room_type_id,':calendar_date'=>$calendar_date),"assoc");
			return ($aResultx) ? $aResultx : null;									
		}
}

