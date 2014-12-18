<?php
class services extends crackerjack{
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
						$data['success'] = '<strong>Congratulations!.</strong> Service was successfully update.';
					}
				$this->session->_set(array('message'=>0,'action'=>''));

			}
			$data['result'] = $this->crud->read("SELECT * FROM _xparentmodule",array(),'obj');
			$this->template->_admin('xhrs/services/package_service',$data,$this->load);
		}

		public function new_record(){
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				unset($postData['btn-submit']);
				unset($postData['services_id']);

				$result = $this->crud->create('_tservices',$postData);
				//exit();
				if($result){
					$this->session->_set(array('message'=>true,'action'=>'add'));
					}
				}
				die();
			}
			$data['room_type'] = $moduleResult = $this->crud->read("SELECT * FROM _troom_type WHERE status=1",array(),'obj');

			$data['action'] = 'new-record';
			$this->template->_admin('xhrs/services/package_service_',$data,$this->load);

		}

		public function modify($id = false){
			 $services_id = $this->hash->decryptMe_($id[0]);
			if (isAjax()) {
				if ($_POST) {

				$result = $postData = $this->form->post('btn-submit');
				unset($postData['btn-submit']);
				unset($postData['services_id']);
				print_r($postData);
				$aResult = $this->crud->update('_tservices',$postData,array('services_id'=>$services_id));

					if ($aResult > 0) {
						$this->session->_set(array('message'=>true,'action'=>'update'));
						echo $aResult;
					}
				}
				die();
			}
			$data['room_type'] = $this->crud->read("SELECT * FROM _troom_type WHERE status=1",array(),'obj');
			$data['result'] = $this->crud->read("SELECT * FROM _tservices WHERE services_id =:id",array(':id'=>$services_id),'assoc');
			$data['action'] = 'edit';
			$this->template->_admin('xhrs/services/package_service_',$data,$this->load);
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
									$rDelete += $this->crud->delete('_tservices',array('services_id'=>$tid));

						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}
}

