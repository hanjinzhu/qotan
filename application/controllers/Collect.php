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





}
