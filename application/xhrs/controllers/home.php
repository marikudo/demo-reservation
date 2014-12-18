<?php
class home extends crackerjack{
		public function __construct(){
			parent::__construct();
		}

		public function index(){

			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}

		

			$this->template->_admin('xhrs/dashboard',$data,$this->load);
			//$this->load->render('xhrs/jlayout-template',$data);
		}

		public function testing($a = false){
			$this->template->_admin('xhrs/dashboard',$data,$this->load);
		}

		public function auth(){
			//print_r($_SESSION);
			if ($this->session->_get('xhrslogin')==true) {
				redirect('xhrs/home');
			}
			if (isset($_POST['btn_success'])) {
				$invalid = 'Invalid Username or password.';
					$_postData = $this->form->_serialize($_POST);
						if (empty($_postData['username']) || empty($_postData['password'])) {
							$data['error'] = $invalid;
						}else{
							$result = $this->user_auth->validate($_postData['username'],$_postData['password']);
							if ($result) {
								$this->session->_set(array('xhrslogin'=>true,'user_id'=>$result['xusers_id'],'role_id'=>$result['xroles_id']));
								redirect('xhrs');

							}else{
								$data['error'] = $invalid;
							}
						}

			}

			$data['title'] = "Administrator login";
			$data['notlogin'] = 'login';
			$this->load->render('notlogin/index',$data);
		}

		public function forgot(){
			if ($this->session->_get('xhrslogin')==true) {
				redirect('xhrs/home');
			}

			if (isset($_POST['btn_success'])) {
				$invalid = 'Email address not exists in database.';
					$_postData = $this->form->_serialize($_POST);
						$result = $this->user_auth->forgot($_postData['username']);

						if ($result) {
							//to do
							$data['success'] = 'Password was successfully reset. Kindly check your email.';
						}else{
							$data['error'] = $invalid;
						}
			}
			$data['title'] = "Forgot Password";
			$data['notlogin'] = 'forgot';
			$this->load->render('notlogin/index',$data);
		}

		public function logout(){
			$this->session->_unset();
			redirect('xhrs/home/auth');
		}

		public function reg(){
			$a = "text.test_s_sd";
			echo preg_replace("/[a-zA-Z0-9_]*+./","$2",$a);
		}

}