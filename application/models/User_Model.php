

<?php
class User_Model extends CI_Model {
    private $cache_lock;

    const USER_STATUS_UNACTIVE = 0;
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_LOCK = 2;
    const USER_STATUS_DELETE = 3;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->cache_lock = $this->config->item('cache_lock');
    }

    public function getUserInfoByEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return ['code' => 100, 'msg' => '邮件格式不正确'];
		}else{
            $ret=  [];
            if($this->cache_lock){
                //$redis = new Redis();
                //$ret = $redis->mget($email);
            }
            if(!empty($ret)){
                $sql = "SELECT * FROM lxyd_user_info WHERE id = (SELECT id FROM lxyd_user)";
                $ret = $this->db->query($sql)->row_array();
            }
            return ['code' => 0, 'msg' => '','data'=>$ret];

        }
    }

    public function getUserInfoById($id){
        if(is_numeric($id)){
            return ['code' => 0, 'msg' => '邮件格式不正确'];
        }elseif(is_array($id)){

        }else{
            return ['code' => 500, 'msg' => '用户信息获取失败'];
        }
    }
    public function register($email, $nick, $password){
        $password = sha1($password);
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $user_id = $this->db->insert('lxyd_user', $data);
        if($user_id){
            $data = [
                'user_id' => $email,
                'status' => self::USER_STATUS_UNACTIVE,
                'nick' => $password,
            ];
            $user_id = $this->db->insert('lxyd_user_info', $data);
            return ['code' => 0,'msg'=>'注册成功','data'=>['user_id'=>$user_id, 'email'=>$email, 'auth_key'=>substr($password, 20, 16), 'nick'=>$nick]];
        }else{
            return ['code' => 500, 'msg' => '用户注册失败，请稍后再试'];
        }


    }
    public function validEmail($email){
        $ret = $this->getUserInfoByEmail($email);
        if($ret['code']!=0){
            return $ret;
        }else{
            if(!empty($ret['data'])){
                return ['code' => 101, 'msg' => '该邮箱已经被注册'];
            }else{
                return ['code' => 0];
            }
        }
    }
    public function validPassword($password){
        if(strlen($password)<4){
            return ['code' => 102, 'msg' => '密码设置太过简短'];
        }
        return ['code' => 0];
    }
    public function validNick($nick){
        if(empty($nick)){
            return ['code' => 103, 'msg' => '昵称不能为空'];
        }
        return ['code' => 0];
    }


}

?>