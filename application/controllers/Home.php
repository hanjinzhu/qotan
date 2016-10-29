<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$userInfo = $this->userInfo();
		if(!$userInfo['data']){
			$this->load->helper('url');
			redirect(base_url('/'));
		}
		$data['userInfo'] = $userInfo['data'];
		$data['title'] = "我的收录";
		$this->load->view('home', $data);
	}

	public function register()
	{
		$this->load->view('register');
	}

	public function test(){
		$this->load->library('Mailer',['sendType'=>'register','url'=>'http://www.lixianyuedu.com','email'=>'601630504@qq.com']);
		$this->mailer->sendMail();
	}
}
