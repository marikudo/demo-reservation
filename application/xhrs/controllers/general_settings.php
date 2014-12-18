<?php
class general_settings extends crackerjack{
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

			$data['payment'] = $this->crud->read("SELECT * FROM _tpayment_gateway LIMIT 0,1",array(),'assoc');
			$data['downpayment'] = $this->crud->read("SELECT * FROM _tdp_settings LIMIT 0,1",array(),'assoc');
			$data['dateandtimezone'] = $this->crud->read("SELECT * FROM _ttimezone",array(),'obj');
			$data['timezone'] = $this->crud->read("SELECT * FROM _ttimezone WHERE status=1",array(),'assoc');
			$this->template->_admin('xhrs/general_settings',$data,$this->load);
		}

	
}

