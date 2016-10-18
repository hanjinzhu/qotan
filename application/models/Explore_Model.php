

<?php
class Explore_Model extends CI_Model {
    private $cache_lock;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->cache_lock = $this->config->item('cache_lock');
    }

    public function getCollectByCatelogId($likeCatelogId,$lastId = 0,$limit = 20){
        if($lastId){
            $whereClause = "AND data_id>$lastId";
        }else{
            $whereClause = "";
        }
        $sql = "SELECT DISTINCT(t.data_id),t.user_id FROM (SELECT * FROM lxyd_data_catelog WHERE catelog_id IN (".implode(",",$likeCatelogId).") ".$whereClause."  ORDER BY id DESC LIMIT ".$limit.") AS t";
        $dataInfo = $this->db->query($sql)->result_array();
        //$ret = array_map(function($row){return $row['data_id'];},$dataInfo);
        return ['code' => 0, 'msg' => '','data'=>$dataInfo];
    }

    public function getMyExploreCatelog($userId){
        $sql = "SELECT catelog_id FROM lxyd_explore_like WHERE user_id='$userId'";
        $ret = $this->db->query($sql)->result_array();
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

    public function getAllExploreCatelog(){
        $sql = "SELECT id,name FROM lxyd_catelog ORDER BY sort DESC";
        $ret = $this->db->query($sql)->result_array();
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }

   

    

}

?>