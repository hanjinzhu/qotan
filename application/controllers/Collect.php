<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends MY_Controller {


	public function collectUrl(){
		$userInfo = $this->userInfo();
		if(!$userInfo['data']){
			//登录超时
		}
		$user_id =$this->userId;
		$url = $this->input->post('url');
		$this->load->model('collect_model','collect');
		$ret = $this->collect->collectUrl($url, $user_id);
		output($ret);
	}

	public function getMyCollect(){
		$userInfo = $this->userInfo();
		if(!$userInfo['data']){
			//登录超时
		}
	
		$user_id =$this->userId;
		$this->load->model('collect_model','collect');
		$ret = $this->collect->getCollectByUserId($user_id);
		output($ret);
	}

	public function getCollectDetail(){
		$id = $this->input->get('id');
		$this->load->model('collect_model','collect');
		$ret = $this->collect->getCollectById($id); 
		if($ret['code']){
			$this->load->helper('url');
			redirect('/home', 'refresh');
		}else{
			$data['article'] = $ret['data']['trans_data'];
			$this->load->view('my_collect_detail',$data);
		}
	}








}
