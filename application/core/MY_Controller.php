<?php
class MY_Controller extends CI_Controller{
	public $userId = 0;
    public $userInfo = [];
    public function __construct(){
        parent::__construct();
        //非登录访问白名单预设

    }


    public function userInfo(){
    	$this->load->model('user_model','user');
        $this->userId = $this->user->checkAuth();
        $this->userInfo = $this->user->getUserInfoById($this->userId);
    }
}
?>