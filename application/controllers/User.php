<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function login(){
		$this->load->view('login');
	}

	public function register(){
		$this->load->view('register');
	}


	public function checkEmail(){
		if($this->input->is_ajax_request()){
			$email = $this->input->get('email', true);
			$this->load->model('user_model','user');
			$ret = $this->user->validEmail($email);
			output($ret);
		}
	}

	public function checkPassword(){
		$password = $this->input->get('password', true);
		$this->load->model('user_model','user');
		$ret = $this->user->validPassword($password);
		output($ret);

	}

	public function checkNick(){
		$nick = $this->input->get('nick', true);
		$this->load->model('user_model','user');
		$ret = $this->user->validNick($nick);
		output($ret);
	}

}
