<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends MY_Controller {

	public function index()
	{
		$this->load->model('explore_model','explore');
		$userInfo = $this->userInfo();
		$likeCatelog = $this->explore->getMyExploreCatelog($this->userId);
	
		if(empty($likeCatelog['data'])){
			$collect = [];
		}else{
			$likeCatelogId = array_map(function($row){return $row['id'];},$likeCatelog['data']);
			$ret = $this->explore->getCollectByCatelogId($likeCatelogId);
			$collect = $ret['data'];

		}
		
		$data['userInfo'] = $userInfo['data'];
		$data['likeCatelog'] = $likeCatelog;
		$data['collect'] = $collect;
		$this->load->view('explore', $data);
	}



}
