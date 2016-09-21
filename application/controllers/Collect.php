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
		$user_id =1024;
		$this->load->model('collect_model','collect');
		$ret = $this->collect->getCollectById($id,$user_id);
		if($ret['code']){
			$this->load->helper('url');
			redirect('/home', 'refresh');
		}else{
			$this->load->view('my_collect_detail',['article'=>$ret['data']['trans_data']]);
		}
	}

	public function test(){
		$t="中新网北京12月1日电(记者 张曦) 30日晚，高圆圆和计算机技术赵又廷在京举行答谢宴，诸多明星现身捧场，其中包括张杰(微博)、谢娜(微博)夫妇、何炅(微博)、蔡康永(微博)、徐克、张凯丽、黄轩(微博)等
高圆圆身穿粉色外套，看到大批记者在场露出娇羞神色，赵又廷则戴着鸭舌帽，十分淡定，两人快步走进电梯，未接受媒体采访
记者了解到，出席高圆圆、赵又廷答谢宴的宾客近百人，其中不少都是女方的高中同学";
		$this->load->model('collect_model','collect');
		$ret = $this->collect->getCollectTag($t);
		var_dump($ret);
	}






}
