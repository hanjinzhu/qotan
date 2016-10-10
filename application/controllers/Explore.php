<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends MY_Controller {

	public function index()
	{
		$this->load->model('explore_model','explore');
		$this->load->model('collect_model','collect');
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
			$collectIds = $ret['data'];
			$collectInfo = $this->collect->getCollectByIds($collectIds);
			$collect = $collectInfo['data'];
		}
		$data['title'] = "发现更多优质文章";
		$data['likeCatelogId'] = $likeCatelogId;
		$data['allCatelog'] = $allCatelog;
		$data['myLikeCatelog'] = $myLikeCatelog;
		$data['userInfo'] = $userInfo['data'];
		$data['collect'] = $collect;
		$this->load->view('explore', $data);
	}



}
