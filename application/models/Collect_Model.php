

<?php
class Collect_Model extends CI_Model {
    private $cache_lock;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        $this->cache_lock = $this->config->item('cache_lock');
    }

    public function collectUrl($url, $userId, $platform = 1){
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            return ['code' => 100, 'msg' => 'URL格式错误'];
		}
        if(!$userId){
            return ['code' => 101, 'msg' => '用户信息解析错误，请重新登录再试'];
        }
        $this->load->library('htmlExtract',['url' => $url,'platform'=>$platform]);
        $rawData = $this->htmlextract->getRawText();
        $transData = $this->htmlextract->getPlainText();
        $title = $this->htmlextract->getTitle();
        $summary = mb_substr(strip_tags(str_replace(["\r\n","\n","\r"],"",$transData)), 0, 400);

        $data = [
            'user_id' => $userId,
            'title' => $title,
            'summary' => $summary,
            'raw_data'=>$rawData,
            'trans_data'=> $transData,
            'fetch_url' => $url,
            'platform' => $platform,
            'create_time' => time()
        ];
        $data_id = $this->db->insert('lxyd_data', $data);
        if($data_id){
            return ['code' => 0, 'msg' => '','data'=>['title'=>$title,'summary'=>$summary,'fetch_url'=>$url]];
        }else{
            return ['code' => 500, 'msg' => '系统错误，请稍后再试'];
        }
    }

    public function getCollectByUserId($userId, $page=1, $limit=12, $catelog_id = 0){
        $offset = $page - 1;
        $sql = "SELECT id,title,summary,fetch_url FROM lxyd_data WHERE user_id='$userId' AND  catelog_id='$catelog_id' ORDER BY id DESC LIMIT $offset,$limit";
        $ret = $this->db->query($sql)->result_array();
        foreach($ret as $k => $v){
            $ret[$k]['base_url'] = parse_url($v['fetch_url'], PHP_URL_HOST);
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

    public function getCollectById($id,$userId=0){
        $sql = "SELECT id,title,trans_data,fetch_url,create_time FROM lxyd_data WHERE id='$id'";
        if($userId){
            $sql.=" AND user_id='$userId'";
        }
        $ret = $this->db->query($sql)->row_array();
        if(!$ret){
            return ['code' => 100, 'msg' => '请求数据不存在','data'=>$ret];
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

    

}

?>