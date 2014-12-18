<?php

class role extends crackerjack{
	private $modules = array();
	private $result;
	public function __construct(){
		parent::__construct();
		if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}
		//print_pre($_SESSION);
		$query = 'SELECT * FROM _xparentmodule WHERE status=1 AND xparentmodule_id !=1 ORDER BY xparentlabel_id';
			if($this->session->_get('role_id')!=1){

				$query = 'SELECT * FROM _xparentmodule WHERE status=1 AND xparentmodule_id > 2 ORDER BY xparentlabel_id';
			}
		$this->result= $this->crud->read($query,array(),'obj');

		foreach($this->result as $k => $g){

			$this->modules[$g->xparentmodule_id] = array();
			$this->modules[$g->xparentmodule_id]['_xcreate'] =  0;
			$this->modules[$g->xparentmodule_id]['_xread'] 	=  0;
			$this->modules[$g->xparentmodule_id]['_xupdate'] =  0;
			$this->modules[$g->xparentmodule_id]['_xdelete'] =  0;
			$this->modules[$g->xparentmodule_id]['_xprint'] 	=  0;
			$this->modules[$g->xparentmodule_id]['_xexport'] =  0;
			$this->modules[$g->xparentmodule_id]['_xupload'] =  0;
		}


	}

	public function index(){
		$data['result'] = $this->result;
		if(isset($_POST['_delete'])){
				$id = $_POST['id'];
					$result = $this->crud->read("SELECT xrole_id FROM _users WHERE role_id=:id",array('id'=>$id),'obj');
					if(empty($result)){
						$result = $this->crud->delete('_role',array('role_id' => $id));
						$result = $this->crud->delete('_acl',array('role_id' => $id));
						echo 1;
					}else{
						echo 0;
					}
				return false;
			}

			if($this->session->_get('message')==1){
					if ($this->session->_get('action')=='add') {
						$data['success'] = '<strong>Congratulations!.</strong> New record successfully added.';
					}

					if ($this->session->_get('action')=='update') {
						$data['success'] = '<strong>Congratulations!.</strong> Role was successfully update.';
					}
				$this->session->_set(array('message'=>0,'action'=>''));

			}

		//$this->load->model(array('admin'));
		$data['userRole']  = $result=  $this->crud->read('SELECT * FROM _xroles WHERE xroles_id > 1 AND is_specific=0',array(),'obj');
		$childList = array();
		foreach ($result as $key => $value) {
				# code...
				if ($value->xroles_id !=2) {
					//$childList[$value->xroles_id] =  $this->admin->getChild($value->xroles_id);
				}

			}
		//$data['child'] = $childList;

		$this->template->_admin('xhrs/role_',$data,$this->load);
	}


	public function new_record(){
		$ifsuccess = 0;
				$result = $this->form->post('btn-submit');
				 if($result){
					//create role
					$role_data['role'] = $result['role'];
					$role_data['status'] =  $result['status'];
					unset($result['role']);
					unset($result['role_id']);
					unset($result['status']);
					$role_data['date_created'] = date('Y-m-d H:i:s');
					$role_id = $this->crud->create('_xroles',$role_data);



				foreach($result as $k => $v){
					$xparentmodule_id = str_replace('_','',$k);
					//echo $k;
					$roleData['xparentmodule_id'] = $xparentmodule_id;
					$roleData['xroles_id'] = $role_id;
					$roleData['_xcreate'] 	= ($v['_xcreate']==0)? 0 : $v['_xcreate'];
					$roleData['_xread'] 	= ($v['_xread']==0)	? 0 : $v['_xread'];
					$roleData['_xupdate'] 	= ($v['_xupdate']==0)? 0 : $v['_xupdate'];
					$roleData['_xdelete'] 	= ($v['_xdelete']==0)? 0 : $v['_xdelete'];
					$roleData['_xexport'] 	= ($v['_xexport']==0)? 0 : $v['_xexport'];
					$roleData['_xprint'] 	= ($v['_xprint']==0)? 0 : $v['_xprint'];
					$roleData['_xupload'] 	= ($v['_xupload']==0)? 0 : $v['_xupload'];
					$ifsuccess += $this->crud->create('_xacl',$roleData);


				}

				if($ifsuccess > 0){
						// $action_data['xparentmodule_id'] = 3;
						// $action_data['xusers_id'] = $this->session->_get('user_id');
						// $action_data['action'] = "Created";
						// $action_data['remarks'] = $role_data['role'];
						// $this->admin_actions->createlog($action_data);
					$this->session->_set(array('message'=>true,'action'=>'add'));
					redirect('xhrs/role');
				}


			}
		$data['result'] = $this->result;
		$data['action'] = "Add";
		$this->template->_admin('xhrs/role_create',$data,$this->load);
	}


	public function modify($id = false){
	 $role_id = $this->hash->decryptMe_($id[0]);
	$result = $this->form->post('btn-submit');
	//print_pre($result);
	$ifsuccess = 0;
	if($result){

				$role_data['role'] = $result['role'];
				$role_data['status'] = $result['status'];
				unset($result['role']);
				unset($result['role_id']);
				unset($result['status']);
				//print_r($role_data);
					$ifsuccess = $this->crud->update('_xroles',$role_data,array('xroles_id'=>$role_id));
			//	print_pre($result);
				foreach($result as $k => $v){
					$xparentmodule_id = str_replace('_','',$k);
					//echo $k;
					$roleData['xparentmodule_id'] = $xparentmodule_id;
					$roleData['xroles_id'] = $role_id;
					$roleData['_xcreate'] 	= ($v['_xcreate']==0)? 0 : $v['_xcreate'];
					$roleData['_xread'] 	= ($v['_xread']==0)	? 0 : $v['_xread'];
					$roleData['_xupdate'] 	= ($v['_xupdate']==0)? 0 : $v['_xupdate'];
					$roleData['_xdelete'] 	= ($v['_xdelete']==0)? 0 : $v['_xdelete'];
					$roleData['_xexport'] 	= ($v['_xexport']==0)? 0 : $v['_xexport'];
					$roleData['_xprint'] 	= ($v['_xprint']==0)? 0 : $v['_xprint'];
					$roleData['_xupload'] 	= ($v['_xupload']==0)? 0 : $v['_xupload'];

					$resultx = $this->crud->read('SELECT count(xroles_id) AS count FROM _xacl WHERE xparentmodule_id=:id AND xroles_id=:idx',array(':id'=>$xparentmodule_id,':idx'=>$role_id),'assoc');
					if($resultx['count']==1){
						$ifsuccess +=$this->crud->update('_xacl',$roleData,array('xparentmodule_id'=>$xparentmodule_id,'xroles_id'=>$role_id),'=');
					}else{
						$ifsuccess += $this->crud->create('_xacl',$roleData);
					}
				}

				if($ifsuccess > 0){
					$this->session->_set(array('message'=>true,'action'=>'update'));
					redirect('xhrs/role');
				}

			}



		$data['result'] = $this->result;
		$data['role'] = $this->crud->read('SELECT * FROM _xroles WHERE xroles_id=:id',array(':id'=>$role_id),'assoc');
		$result = $this->crud->read('SELECT * FROM _xparentmodule AS m INNER JOIN _xacl AS p ON m.xparentmodule_id=p.xparentmodule_id WHERE p.xroles_id=:id AND m.xparentmodule_id!=2',array(':id'=>$role_id),'obj');
		$modules = array();
		$modules_init = array();
		foreach($result as $k => $g){
			if ($g->xparentmodule_id !=2) {
			$modules[$g->xparentmodule_id] = array();
			$modules[$g->xparentmodule_id]['_xcreate'] = ($g->_xcreate==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xread'] = ($g->_xread ==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xupdate'] = ($g->_xupdate==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xdelete'] = ($g->_xdelete==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xexport'] = ($g->_xexport==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xprint'] = ($g->_xprint==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xupload'] = ($g->_xupload==1) ? 1 : 0;
		}
		}
		$data['modules'] = $modules;
		$data['action'] = "Edit";
		$this->template->_admin('xhrs/role_create',$data,$this->load);
	}

	public function view($id = false){
	 $role_id = $this->hash->decryptMe_($id[0]);
	$result = $this->form->post('btn-submit');
	//print_pre($result);
	$ifsuccess = 0;
	if($result){

				$role_data['role'] = $result['role'];
				$role_data['status'] = $result['status'];
				unset($result['role']);
				unset($result['role_id']);
				unset($result['status']);
				//print_r($role_data);
					//$ifsuccess = $this->crud->update('_xroles',$role_data,array('xroles_id'=>$role_id));
			//	print_pre($result);
				foreach($result as $k => $v){
					$xparentmodule_id = str_replace('_','',$k);
					//echo $k;
					$roleData['xparentmodule_id'] = $xparentmodule_id;
					$roleData['xroles_id'] = $role_id;
					$roleData['_xcreate'] 	= ($v['_xcreate']==0)? 0 : $v['_xcreate'];
					$roleData['_xread'] 	= ($v['_xread']==0)	? 0 : $v['_xread'];
					$roleData['_xupdate'] 	= ($v['_xupdate']==0)? 0 : $v['_xupdate'];
					$roleData['_xdelete'] 	= ($v['_xdelete']==0)? 0 : $v['_xdelete'];
					$roleData['_xexport'] 	= ($v['_xexport']==0)? 0 : $v['_xexport'];
					$roleData['_xprint'] 	= ($v['_xprint']==0)? 0 : $v['_xprint'];
					$roleData['_xupload'] 	= ($v['_xupload']==0)? 0 : $v['_xupload'];

					$resultx = $this->crud->read('SELECT count(xroles_id) AS count FROM _xacl WHERE xparentmodule_id=:id AND xroles_id=:idx',array(':id'=>$xparentmodule_id,':idx'=>$role_id),'assoc');
					if($resultx['count']==1){
						//$ifsuccess +=$this->crud->update('_xacl',$roleData,array('xparentmodule_id'=>$xparentmodule_id,'xroles_id'=>$role_id),'=');
					}else{
						//$ifsuccess += $this->crud->create('_xacl',$roleData);
					}
				}

				if($ifsuccess > 0){
					$this->session->_set(array('message'=>true,'action'=>'update'));
					redirect('xhrs/role');
				}

			}



		$data['result'] = $this->result;
		$data['role'] = $this->crud->read('SELECT * FROM _xroles WHERE xroles_id=:id',array(':id'=>$role_id),'assoc');
		$data['modules'] = $modules;
		$data['action'] = "edit";
		$this->template->_admin('xhrs/role_view',$data,$this->load);
	}

	public function delete(){
		if (isAjax()) {
			if ($_POST) {
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
							$qResult = $this->crud->read("SELECT COUNT(xu.xroles_id) AS cnt,xr.role as role FROM _xusers AS xu INNER JOIN _xroles AS xr ON xu.xroles_id =  xr.xroles_id WHERE xu.xroles_id=:id",array(':id'=>$tid),'assoc');

								if ($qResult['cnt'] > 0) {
										$nDelete .= $qResult['role'].",";
										}else{
									$ifDelete = $this->crud->delete('_xroles',array('xroles_id'=>$tid));
										if ($ifDelete) {
											$rDelete++;
										}
								}


							//$aResult =+ $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}
	}

	public function activate(){
		if (isAjax()) {
			if ($_POST) {

			}
		}
	}

	public function dactive(){
		if (isAjax()) {
			if ($_POST) {
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
							$qResult = $this->crud->read("SELECT COUNT(xu.xroles_id) AS cnt,xr.role as role FROM _xusers AS xu INNER JOIN _xroles AS xr ON xu.xroles_id =  xr.xroles_id WHERE xu.xroles_id=:id",array(':id'=>$tid),'assoc');

								if ($qResult['cnt'] > 0) {
										$nDelete .= $qResult['role'].",";
										}else{
									$data['status'] = 0;
									$rDelete =+ $this->crud->update('_xroles',$data,array('xroles_id'=>$tid));

								}


							//$aResult =+ $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}
		}
	}


}