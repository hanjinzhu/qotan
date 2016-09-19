<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function login(){
		$this->load->view('login');
	}

	public function register(){
		$this->load->view('register');
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
			$email = $this->input->post('email', true);
			$password = $this->input->post('password', true);
			$verify_code ='';
			$ret  =  $this->user->login($email, $password, $verify_code);
			
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
			//自检完毕 注册账户
			$ret  =  $this->user->register($email, $nick, $password);
			output($ret);
		}
	

	}

}
