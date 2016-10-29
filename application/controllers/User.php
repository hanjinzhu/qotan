<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function login(){
		$this->load->view('login');
	}

	public function register(){
		$data['title'] = "账户注册 -  让阅读更加方便 手机离线阅读的神器 lixianyuedu.com";
		$this->load->view('register', $data);
	}


	public function checkEmail(){
		if($this->input->is_ajax_request()){
			$this->load->model('user_model','user');
			$email = $this->input->get('email', true);
			$ret = $this->user->validEmail($email);
			output($ret);
		}
	}

	public function checkPassword(){
		if($this->input->is_ajax_request()){
			$this->load->model('user_model','user');
			$password = $this->input->get('password', true);
			$ret = $this->user->validPassword($password);
			output($ret);
		}

	}

	public function checkNick(){
		if($this->input->is_ajax_request()){
			$this->load->model('user_model','user');
			$nick = $this->input->get('nick', true);
			$ret = $this->user->validNick($nick);
			output($ret);
		}
	}

	public function doLogin(){
		if($this->input->is_ajax_request()){
			$this->load->model('user_model','user');
			$email = $this->input->post('email', true);
			$password = $this->input->post('password', true);
			$verify_code ='';
			$ret  =  $this->user->login($email, $password, $verify_code);
			if($ret['code']==0){
				$this->user->setAuth($ret['data']['user_id'],$ret['data']['auth_key']);
			}
			output($ret);
		}
		
	}
	public function doRegister(){
		if($this->input->is_ajax_request()){
			$this->load->model('user_model','user');
			$email = $this->input->get('email', true);
			$nick = $this->input->get('nick', true);
			$password = $this->input->get('password', true);
			$ret = $this->user->validEmail($email);
			if($ret['code']!=0){
				$ret['error_type'] = 'email';
				output($ret);
			}
			$ret = $this->user->validNick($nick);
			if($ret['code']!=0){
				$ret['error_type'] = 'nick';
				output($ret);
			}
			$ret = $this->user->validPassword($password);
			if($ret['code']!=0){
				$ret['error_type'] = 'password';
				output($ret);
			}
			$ret = $this->user->getUserInfoByEmail($email);
			if($ret['code'] == 0 && !empty($ret['data'])){
				$ret['error_type'] = 'email';
				$ret['msg'] = '该邮箱账号已经被注册';
				output($ret);
			}
			//自检完毕 注册账户

			$ret  =  $this->user->register($email, $nick, $password);
			if($ret['code']==0){
				//发送邮件 暂时使用同步发送 视情况构建redis list队列发送
				$salt = $this->config->item('salt');
				$url = $this->config->item('base_url').'user/verify/'.$ret['data']['user_id'].'/'.$ret['data']['verify_code'].'/'.md5($ret['data']['user_id'].$ret['data']['verify_code'].$salt);
				$this->load->library('Mailer',['sendType'=>'register','url' => $url,'email'=>$email]);
				$this->mailer->sendMail();
				output($ret);
				//$this->user->setAuth($ret['data']['user_id'],$ret['data']['auth_key']);
			}
			
		}
	}

	public function ucenter(){
		$userInfo = $this->userInfo();
		$data['userInfo'] = $userInfo['data'];
		$data['title'] = "个人中心";
		$this->load->view('ucenter',$data);
	}

	public function logout(){
		$this->load->helper('url');
		$this->load->helper('cookie');
		delete_cookie("lxyd_sid");
		redirect(base_url('/'));
	}

}
