<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends MY_Controller {

	public function index()
	{
		$userInfo = $this->userInfo();
		$data['userInfo'] = $userInfo['data'];
		$this->load->view('explore', $data);
	}

}
