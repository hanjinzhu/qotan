<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$userInfo = $this->userInfo();
		$data['userInfo'] = $userInfo['data'];
		$this->load->view('home', $data);
	}

	public function register()
	{
		$this->load->view('register');
	}
}
