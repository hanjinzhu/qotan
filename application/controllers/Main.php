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
		$this->load->model('explore_model','explore');
		$this->load->model('collect_model','collect');
		$allCatelogInfo = $this->explore->getAllExploreCatelog();
		$allCatelog = $allCatelogInfo['data'];

		$likeCatelogId = array_map(function($row){return $row['id'];},$allCatelog);
		$ret = $this->explore->getCollectByCatelogId($likeCatelogId);
		$collectInfo = $ret['data'];
		//处理文章和作者的映射关系
		$dataToUser = [];
		foreach($collectInfo as $v){
			$dataToUser[$v['data_id']] = $v['user_id'];
		}
		$collectIds = array_map(function($row){return $row['data_id'];},$collectInfo);
		$userIds = array_map(function($row){return $row['user_id'];},$collectInfo);
		$writeInfo = $this->user->getUserInfoById($userIds);
		$writeUser = $writeInfo['data'];
		$collectInfo = $this->collect->getCollectByIds($collectIds);
		$collect = $collectInfo['data'];
		$data['dataToUser'] = $dataToUser;
		$data['writeInfo'] = $writeInfo;
		$data['writeUser'] = $writeUser;
		$data['collect'] = $collect;
		$data['title']="离线阅读 - 让阅读更加方便 手机离线阅读的神器 lixianyuedu.com";
		$this->load->view('main', $data);
	}

	
}
