<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends CI_Controller {


	public function collectUrl(){
		$user_id =1024;
		$url = $this->input->post('url');
		$this->load->model('collect_model','collect');
		$ret = $this->collect->collectUrl($url, $user_id);
		output($ret);
	}

	public function getMyCollect(){
		$user_id =1024;
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
			$this->load->view('my_collect_detail',['article'=>$ret['data']['trans_data']]);
		}
	}








}
