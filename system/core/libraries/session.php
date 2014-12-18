<?php
/**
 *  Session
 */

if(!defined('APPS')) exit ('No direct access allowed');

 if(session_start() == false){
          session_start();
         }

class session{
    protected $alias = '';
    public function __contruct(){
      
    }

    public function _set($var){
       $this->getCOnfig();
        if (is_array($var)) {
            foreach ($var as $key => $value) {
            # code...
               $_SESSION[$this->alias]["$key"] = "$value";
			   
            }
			
        }
    }

    public function _get($key) {
	$this->getCOnfig();

             if (!isset($_SESSION[$this->alias]["$key"])) {
                $_SESSION[$this->alias]["$key"] = "";
            } 

        return $_SESSION[$this->alias]["$key"];
    }

    protected function getCOnfig(){
         $con = new config;
        $this->alias = $con->config['alias'];
    }

    public function _destroy(){
        session_destroy();
        session_unset();
    }

    public function _unset(){
        $this->getCOnfig();
        unset($_SESSION[$this->alias]);
    }

}