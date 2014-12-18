<?php

class charges_and_taxes extends crackerjack{
	
	public function __construct(){
		parent::__construct();
		if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}


		
	}
	public function index(){
		//$data['users'] = $this->crud->read('SELECT * FROM _xusers as u LEFT JOIN _role as r ON u.role_id=r.role_id WHERE u.users_id!=:id AND u.users_id!=1',array(':id'=>$this->session->_get('users_id')),'obj');
			if($this->session->_get('message')==1){
					if ($this->session->_get('action')=='add') {
						$data['success'] = '<strong>Congratulations!.</strong> New record successfully added.';
					}
					if ($this->session->_get('action')=='update') {
						$data['success'] = '<strong>Congratulations!.</strong> User was successfully update.';
					}
				$this->session->_set(array('message'=>0,'action'=>''));
			}
		$data['tax_feesx'] = $this->crud->read("SELECT * FROM _ttax_and_charges",array(),'obj');
		$this->template->_admin('xhrs/services_charges_and_taxes',$data,$this->load);
	}
	
	public function new_record($id = false){
		
		$this->load->libraries(array('form'));
		$result = $this->form->post('btn-submit');
		
		if (isAjax()) {
				if ($_POST) {
				 if( $this->crud->create('_ttax_and_charges',$result)){
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
	$data['role'] = $this->crud->read('SELECT * FROM _xroles WHERE status=1 AND xroles_id!=1',array(),'obj');
	$data['action'] = 'Add';
			$this->template->_admin('xhrs/services_charges_and_taxes_',$data,$this->load);
	}
	
	public function modify($id =false){
		$tax_and_charges_id = $this->hash->decryptMe_($id[0]);
			
		$this->load->libraries(array('form'));
		$result = $this->form->post('btn-submit');
		
		if (isAjax()) {
			if ($_POST) {
				print_r($result);
				 if($this->crud->update('_ttax_and_charges',$result,array('tax_and_charges_id'=>$tax_and_charges_id))){
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
			
			$data['result'] = $this->crud->read('SELECT * FROM _ttax_and_charges WHERE tax_and_charges_id = :id',array(':id'=>$tax_and_charges_id),'assoc');
			$data['action'] = 'Edit';
			$this->template->_admin('xhrs/services_charges_and_taxes_',$data,$this->load);

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
									$rDelete += $this->crud->delete('_ttax_and_charges',array('tax_and_charges_id'=>$tid));

						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}
}