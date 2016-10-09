<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$userInfo = $this->userInfo();
		if($userInfo['data']){
			$this->load->helper('url');
			redirect(base_url('/home'));
		}
		$data['title']="离线阅读 - 让阅读更加方便 手机离线阅读的神器";
		$this->load->view('main', $data);
	}

	
}
