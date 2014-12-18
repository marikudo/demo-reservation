<?php
class account extends crackerjack{
		public function __construct(){
			parent::__construct();
		}

		public function index(){
			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}

			$this->template->_admin('xhrs/account_information',$data,$this->load);
		}


		public function information($value=false){
			if ($_POST) {
				$_postdata = $_postData = $this->form->_serialize($_POST);
				$userId = $this->session->_get('user_id');
				$result = $this->crud->update('_xusers',$_postdata,array('xusers_id'=>$userId));
				$data['success'] = ($result) ? '<strong>Congratulations! </strong> Information was successfully update.' : null;
			}

			$this->template->_admin('xhrs/account_information',$data,$this->load);
		}

		public function settings(){
			if ($_POST) {
				$_postdata = $_postData = $this->form->_serialize($_POST);
				$userId = $this->session->_get('user_id');
					if (isset($_postdata['change_email'])) {
						$checkEmail = $this->user_auth->email_exists($_postdata['email']);
						if ($checkEmail) {
							$data['error'] = '<strong>Ooops..</strong> Email is already exists.';
						}else{
							$pass = $this->user->isPasswordCorrect($userId,$_postdata['password']);
								if ($pass) {
									$result = $this->crud->update('_xusers',array('email'=>$_postdata['email']),array('xusers_id'=>$userId));
									if ($result) {
										$data['success'] = '<strong>Congratulations!</strong> Email was successfully update.';
									}
								}else{
									$data['error'] = '<strong>Ooops..</strong> Incorrect password.';
								}
						}
					}

					if (isset($_postdata['change_password'])) {
						$pass = $this->user->isPasswordCorrect($userId,$_postdata['password']);
								if ($_postdata['newpassword']==$_postdata['cnewpassword']) {
									if ($pass) {
											$password['password'] = $this->hash->encryptMe_($_postdata['newpassword']);
											$result = $this->crud->update('_xusers',$password,array('xusers_id'=>$userId));
											if ($result) {
												$data['success'] = '<strong>Congratulations!</strong> Password was successfully change.';
											}
									}else{
										$data['error'] = '<strong>Ooops..</strong> Incorrect old password.';	
									}
								}else{
									$data['error'] = '<strong>Ooops..</strong> New password is not match.';
								}
					}

				//$result = $this->crud->update('_xusers',$_postdata,array('xusers_id'=>$userId));
				//$data['success'] = ($result) ? '<strong>Congratulations! </strong> Information was successfully update.' : null;
			}

			$this->template->_admin('xhrs/account_settings',$data,$this->load);
		}
		
}