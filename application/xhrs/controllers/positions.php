<?php

class positions extends crackerjack{
	
	public function __construct(){
		parent::__construct();
		if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}
		
	}
	public function index(){
		if($this->session->_get('message')==1){
			if($this->session->_get('action')=='update'){
				$data['success'] = 'Position was successfully updated.';
			}
			if($this->session->_get('action')=='add'){
				$data['success'] = 'Position was successfully added';
			}
		$this->session->_set(array('message'=>false,'action'=>''));
		}
		$this->template->_admin('xhrs/position',$data,$this->load);
	}
	
	
	public function new_record($id = false){
		
		$this->load->libraries(array('form'));
		$result = $this->form->post('btn-submit');
		unset($result['position_id']);
			
		if($result){
		 if( $this->crud->create('_tposition',$result)){
			$this->session->_set(array('message'=>true,'action'=>'add'));
			$data['log_data'] = $result['position'];
			redirect('xhrs/positions');
		} 
		}
	$data['department'] = $this->crud->read('SELECT * FROM _tdepartment WHERE status=1',array(),'obj');
	$data['action'] = 'Add';
			$this->template->_admin('xhrs/position_',$data,$this->load);
	}

	public function modify($id =false){
		$rID = $this->hash->decryptMe_($id[0]);
		$result = $this->form->post('btn-submit');
			if ($result) {
				unset($result['position_id']);
				 $isupdate = $this->crud->update('_tposition',$result,array('position_id'=>$rID));
					if ($isupdate==true) {
						$this->session->_set(array('message'=>true,'action'=>'update'));
							$data['log_data'] = $result['position'];
						redirect('xhrs/positions');
					} 
			}

			
			$data['result'] = $this->crud->read('SELECT * FROM _tposition WHERE position_id = :id',array(':id'=>$rID),'assoc');
			$data['action'] = 'Edit';
			$data['department'] = $this->crud->read('SELECT * FROM _tdepartment WHERE status=1',array(),'obj');
			$this->template->_admin('xhrs/position_',$data,$this->load);

	}

	public function doesexists($data){
		$mode = $data[0];
		$a = "SELECT count(*) as count FROM _position WHERE department_id =:id AND position=:val LIMIT 0,1";
		 $res =  $this->crud->read($a,array(':id'=>$_REQUEST['department_id'],':val'=>$_REQUEST['position']),'assoc');
			$result = 'true';
				if ($res['count'] > 0) {
					$result = 'false';
					if($_REQUEST['current']==$_REQUEST['position'] && $_REQUEST['department']==$_REQUEST['department_id'] && $mode=='edit'){
								$result = 'true';
					}
				}				
			echo $result;
			
	}
	
}