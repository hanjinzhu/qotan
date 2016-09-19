<?php
class MY_Controller extends CI_Controller{
	public $userId = 0;

    public function __construct(){
        parent::__construct();
    }
 
    public function isLogin(){
        return $this->userId == 0 ? false : true;
    }

    public function userInfo(){
    	
    }
}
?>