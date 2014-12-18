<?php
class room_type_management extends crackerjack{
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
			$data['result'] = $this->crud->read("SELECT * FROM _xparentmodule",array(),'obj');
			$this->template->_admin('xhrs/room_type',$data,$this->load);
		}

		public function new_record(){
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				unset($postData['btn-submit']);
				$postData['created_at'] = date("Y-m-d H:i:s");
				unset($postData['avatar']);
				unset($postData['x']);
				unset($postData['y']);
				unset($postData['h']);
				unset($postData['w']);
				unset($postData['i']);
				$result = $this->crud->create('_troom_type',$postData);
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

			$data['action'] = 'new-record';
			$this->template->_admin('xhrs/room_type_',$data,$this->load);

		}

		public function modify($id = false){
			$room_type_id = $this->hash->decryptMe_($id[0]);
			if (isAjax()) {
				if ($_POST) {

				$result = $postData = $this->form->post('btn-submit');
				unset($result['avatar']);
				unset($result['x']);
				unset($result['y']);
				unset($result['h']);
				unset($result['w']);
				unset($result['i']);
				$aResult = $this->crud->update('_troom_type',$result,array('room_type_id'=>$room_type_id));

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

			$data['result'] = $moduleResult = $this->crud->read("SELECT * FROM _troom_type WHERE room_type_id=:id",array(':id'=>$room_type_id),'assoc');
			$data['action'] = 'edit';
			$this->template->_admin('xhrs/room_type_',$data,$this->load);
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
									$rDelete += $this->crud->delete('_troom_type',array('room_type_id'=>$tid));

						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}
}

