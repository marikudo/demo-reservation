<?php
class demo extends crackerjack{
		public function __construct(){
			parent::__construct();
		}

		public function index(){
			if (isAjax()) {

				 //$upload_dir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);  
			 		$upload_url = "uploads/";  
			      $temp_name = $_FILES['picture']['tmp_name'];  
			      $file_name = $_FILES['picture']['name'];  
			      echo $file_path = $upload_url.$file_name;  
			      if(move_uploaded_file($temp_name, $file_path))  
			      {  
			           echo "File uploaded Success !";  
			      }  	

				print_r($_FILES['picture']);
				print_r($_POST);
				die();
			}
		$this->template->_admin('xhrs/demo',$data,$this->load);
		}

		
}