

<?php
class Collect_Model extends CI_Model {
    private $cache_lock;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        $this->cache_lock = $this->config->item('cache_lock');
    }

    public function collectUrl($url,$userId,$platform = 1){
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            return ['code' => 100, 'msg' => 'URL格式错误'];
		}
        if(!$userId){
            return ['code' => 101, 'msg' => '用户信息解析错误，请重新登录再试'];
        }
        $this->load->library('htmlExtract',['url' => $url]);
        $rawData = $this->htmlextract->getRawText();
        $transData = $this->htmlextract->getPlainText();
        $title = $this->htmlextract->getTitle();;
        $data = [
            'user_id' => $userId,
            'title' => $title,
            'raw_data'=>$rawData,
            'trans_data'=> $transData,
            'fetch_url' => $url,
            'platform' => $platform,
            'create_time' => time()
        ];
        $data_id = $this->db->insert('lxyd_data', $data);
        if($data_id){
            return ['code' => 0, 'msg' => '','data'=>['title'=>$title,'summary'=>mb_substr(strip_tags($transData), 0, 60),'fetch_url'=>$url]];
        }else{
            return ['code' => 500, 'msg' => '系统错误，请稍后再试'];
        }
    }

    

}

?>