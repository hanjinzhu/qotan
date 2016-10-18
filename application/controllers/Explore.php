<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends MY_Controller {

	public function index()
	{
		$this->load->model('explore_model','explore');
		$this->load->model('collect_model','collect');
		$this->load->model('user_model','user');
		$userInfo = $this->userInfo();
		$myCatelog = $this->explore->getMyExploreCatelog($this->userId);
		$allCatelogInfo = $this->explore->getAllExploreCatelog();
		$allCatelog = $allCatelogInfo['data'];
		$myCatelogId = $myCatelog['data'];
		//$myCatelogId = [];
		if(count($myCatelogId) ==0){
			$likeCatelogId = [];
			$myLikeCatelog = false;
			$collect = [];
		}else{
			$myLikeCatelog = true;
			$likeCatelogId = array_map(function($row){return $row['catelog_id'];},$myCatelogId);
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
			$data['writeInfo'] = $writeInfo;
		}
		$data['title'] = "发现更多优质文章";
		$data['likeCatelogId'] = $likeCatelogId;
		$data['allCatelog'] = $allCatelog;
		$data['myLikeCatelog'] = $myLikeCatelog;
		$data['userInfo'] = $userInfo['data'];
		$data['dataToUser'] = $dataToUser;
		$data['writeUser'] = $writeUser;
		$data['collect'] = $collect;
		$this->load->view('explore', $data);
	}



}
