<?php
class package_setup extends crackerjack{
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

					if ($this->session->_get('action')=='update') {
						$data['success'] = '<strong>Congratulations!.</strong> Package was successfully update.';
					}
				$this->session->_set(array('message'=>0,'action'=>''));

			}
			$data['result'] = $this->crud->read("SELECT * FROM _xparentmodule",array(),'obj');
			$this->template->_admin('xhrs/package/package',$data,$this->load);
		}

		public function new_record(){
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				unset($postData['btn-submit']);
				unset($postData['packages_id']);
				unset($postData['services_id']);
				$postData['promo_date_start'] = date("Y-m-d",strtotime($postData['promo_date_start']));
				$postData['promo_date_end'] = date("Y-m-d",strtotime($postData['promo_date_end']));
				$postData['booking_date_start'] = date("Y-m-d",strtotime($postData['booking_date_start']));
				$postData['booking_date_end'] = date("Y-m-d",strtotime($postData['booking_date_end']));
				$result = $this->crud->create('_tpackages',$postData);
				//exit();
				if($result){
					header("Expires: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
					header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
					header("Cache-Control: no-cache, must-revalidate" );
					header("Pragma: no-cache" );
					header("Content-type: text/x-json");
					echo json_encode(array('result'=>'true'));
					$this->session->_set(array('message'=>true,'action'=>'add'));
					}
				}
				die();
			}
			$data['rooms'] = $this->crud->read("SELECT * FROM _troom_type WHERE status=1",array(),'obj');
			$data['services'] = $this->crud->read("SELECT * FROM _tservices WHERE status=1",array(),'obj');
			$data['action'] = 'new-record';
			$this->template->_admin('xhrs/package/package_',$data,$this->load);

		}

		public function modify($id = false){
			 $packages_id = $this->hash->decryptMe_($id[0]);
			if (isAjax()) {
				if ($_POST) {

				$result = $postData = $this->form->post('btn-submit');
				unset($postData['btn-submit']);
				unset($postData['packages_id']);
				unset($postData['services_id']);
				$postData['promo_date_start'] = date("Y-m-d",strtotime($postData['promo_date_start']));
				$postData['promo_date_end'] = date("Y-m-d",strtotime($postData['promo_date_end']));
				$postData['booking_date_start'] = date("Y-m-d",strtotime($postData['booking_date_start']));
				$postData['booking_date_end'] = date("Y-m-d",strtotime($postData['booking_date_end']));
				$aResult = $this->crud->update('_tpackages',$postData,array('packages_id'=>$packages_id));

					if ($aResult > 0) {
						header("Expires: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
						header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
						header("Cache-Control: no-cache, must-revalidate" );
						header("Pragma: no-cache" );
						header("Content-type: text/x-json");
						echo json_encode(array('result'=>'true'));
						$this->session->_set(array('message'=>true,'action'=>'update'));
			
					}
				}
				die();
			}
			$data['rooms'] = $this->crud->read("SELECT * FROM _troom_type WHERE status=1",array(),'obj');
			$data['services'] = $this->crud->read("SELECT * FROM _tservices WHERE status=1",array(),'obj');
			$data['result'] = $this->crud->read("SELECT * FROM _tpackages WHERE packages_id =:id",array(':id'=>$packages_id),'assoc');
			$data['action'] = 'edit';
			$this->template->_admin('xhrs/package/package_',$data,$this->load);
		}

		public function delete(){
			if (isAjax()) {
				if (isset($_GET['gConf'])) {
					$gConfig = unserialize(base64_decode($_GET['gConf']));
					extract($gConfig['uPermission']);

					//get post id's
					$row = array_unique($_POST['row']);
					if (is_array($row)) {
						$nDelete = '';
						$rDelete = 0;
						foreach ($row as $value) {
							$tid = $this->hash->decryptMe_($value);
									$rDelete += $this->crud->delete('_tpackages',array('packages_id'=>$tid));

						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}
}

