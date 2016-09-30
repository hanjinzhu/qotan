

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
        $rawData = addslashes($this->htmlextract->getRawText());
        $transData = addslashes($this->htmlextract->getPlainText());
        $title = $this->htmlextract->getTitle();
        $summary = addslashes(mb_substr(trim(strip_tags($transData)), 0, 800)).'...';
        $data_id = $this->_isUrlExsists($url);
        $ctime = time();
        if(!$data_id){
            $data = [
                'title' => $title,
                'summary' => $summary,
                'raw_data'=>$rawData,
                'trans_data'=> $transData,
                'fetch_url' => $url,
                'create_time' => $ctime
            ];
            $ret = $this->db->insert('lxyd_data', $data);
            $data_id = $this->db->insert_id();
        }
        $data = [
            'user_id' => $userId,
            'platform' => $platform,
            'data_id' => $data_id,
            'status' => 1,
            'create_time' => $ctime,
        ];
        $data_id = $this->db->insert('lxyd_collect', $data);

        
        if($data_id){
            return ['code' => 0, 'msg' => '','data'=>['title'=>$title,'summary'=>$summary,'fetch_url'=>$url]];
        }else{
            return ['code' => 500, 'msg' => '系统错误，请稍后再试'];
        }
    }

    public function getCollectByUserId($userId, $page=1, $limit=12){
        $offset = $page - 1;
        $sql = "SELECT id,title,summary,fetch_url FROM lxyd_data WHERE id IN (SELECT data_id FROM lxyd_collect WHERE user_id='$userId') ORDER BY id DESC  LIMIT $offset,$limit";
        $ret = $this->db->query($sql)->result_array();
        foreach($ret as $k => $v){
            $ret[$k]['base_url'] = parse_url($v['fetch_url'], PHP_URL_HOST);
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

    public function getCollectById($id){
        $sql = "SELECT id,title,trans_data,fetch_url,create_time FROM lxyd_data WHERE id='$id'";
        $ret = $this->db->query($sql)->row_array();
        $ret['trans_data'] = stripcslashes($ret['trans_data']);
        if(!$ret){
            return ['code' => 100, 'msg' => '请求数据不存在','data'=>$ret];
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

    public function getCollectByIds($ids){
        $sql = "SELECT id,title,trans_data,fetch_url,create_time,summary FROM lxyd_data WHERE id IN (".implode(",", $ids).")";
        $ret = $this->db->query($sql)->result_array();
        foreach($ret as $k => $v){
            $ret[$k]['trans_data'] = stripcslashes($v['trans_data']);
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }



    private function _isUrlExsists($url){
        $sql = "SELECT id FROM lxyd_data WHERE fetch_url='$url'";
        $ret = $this->db->query($sql)->row_array();
        return isset($ret['id']) ? $ret['id'] : 0;
    }

    

}

?>