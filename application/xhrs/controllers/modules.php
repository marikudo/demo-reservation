<?php
class modules extends crackerjack{
		private $labels;
		public function __construct(){
			parent::__construct();
			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}
			$this->labels = $this->crud->read("SELECT * FROM _xparentlabel WHERE status=1",array(),'obj');

		}

		public function index(){
			if($this->session->_get('message')==1){
					if ($this->session->_get('action')=='add') {
						$data['success'] = '<strong>Congratulations!.</strong> New record successfully added.';
					}
					$this->session->_set(array('message'=>0,'action'=>''));

			}
			$data['result'] = $this->crud->read("SELECT * FROM _xparentmodule",array(),'obj');
			$this->template->_admin('xhrs/modules',$data,$this->load);
		}

		public function new_record(){
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				unset($postData['btn-submit']);
				$result = $this->crud->create('_xparentmodule',$postData);
				if($result){
					echo $result;
					$this->session->_set(array('message'=>true,'action'=>'add'));
					}
				}
				die();
			}
			$data['label'] = $this->crud->read("SELECT * FROM _xparentlabel WHERE status=1",array(),'obj');
			$data['xmodules'] =$a =  $this->crud->read("SELECT * FROM _xparentmodule WHERE xparentlabel_id = 1 AND parent_id = 0 AND status=1",array(),'obj');
			
			$data['action'] = 'new-record';
			$this->template->_admin('xhrs/modules_',$data,$this->load);

		}

		public function modify($id = false){
			$module_id = $this->hash->decryptMe_($id[0]);
			if (isAjax()) {
				if ($_POST) {
				
				$result = $postData = $this->form->post('btn-submit');
			

				$result['_xcreate'] 	= isset($result['_xcreate']) ? $result['_xcreate'] : 0 ;
				$result['_xread'] 		= isset($result['_xread']) 	? $result['_xread']	 : 0 ;
				$result['_xupdate'] 	= isset($result['_xupdate']) ? $result['_xupdate'] : 0 ;
				$result['_xdelete'] 	= isset($result['_xdelete']) ? $result['_xdelete'] : 0 ;
				$result['status'] 		= isset($result['status']) ? $result['status'] : 0 ;
				$result['_xexport'] 	= isset($result['_xexport']) ? $result['_xexport'] : 0 ;
				$result['_xprint'] 		= isset($result['_xprint']) ? $result['_xprint'] : 0 ;
				$result['_xupload'] 		= isset($result['_xupload']) ? $result['_xupload'] : 0 ;
				$result['parent_id'] = isset($result['parent_id']) ? $result['parent_id'] : 0 ;
				
				$aResult = $this->crud->update('_xparentmodule',$result,array('xparentmodule_id'=>$module_id));
				
					if ($aResult > 0) {
						$this->session->_set(array('message'=>true,'action'=>'update'));
						echo $aResult;
					}
					/*if ($result['parent_id'] > 0) {
						
					}else{
						$result = $this->crud->create('_xparentmodule',$result);
					}*/
					/*$aResult = $this->crud->update('_xparentmodule',$result,array('xparentmodule_id'=>$module_id));
				
					if ($aResult > 0) {
						$this->session->_set(array('message'=>true,'action'=>'update'));
						echo $aResult;
					}*/
				}
				die();
			}

			$data['result'] = $moduleResult = $this->crud->read("SELECT * FROM _xparentmodule WHERE xparentmodule_id=:id",array(':id'=>$module_id),'assoc');
			$label_id = $moduleResult['xparentlabel_id'];
			$data['xmodules'] = $this->crud->read("SELECT * FROM _xparentmodule WHERE xparentlabel_id = :id AND parent_id = 0 AND status=1",array(':id'=>$label_id),'obj');
    				
			$data['label'] = $this->crud->read("SELECT * FROM _xparentlabel WHERE status=1",array(),'obj');
			$data['action'] = 'modify';
			$this->template->_admin('xhrs/modules_',$data,$this->load);
		}

		public function getxmodules(){
			if (isAjax()) {
				if ($_POST) {
					$label_id = $_POST['label_id'];

					  $aResult =  $this->crud->read("SELECT * FROM _xparentmodule WHERE xparentlabel_id = :id AND parent_id = 0 AND status=1",array(':id'=>$label_id),'obj');
    				$rReturn = '<option value="">-Select-</option>';
    					foreach ($aResult as $get) {
    						$rReturn .='<option value="'.$get->xparentmodule_id.'">'.$get->parentmodule.'</option>';
    					}
    				echo $rReturn;
				}
			}
		}
}

