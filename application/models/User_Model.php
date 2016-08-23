

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
        $userId = $this->db->insert('lxyd_user', $data);
        if($userId){
            $data = [
                'user_id' => $userId,
                'status' => self::USER_STATUS_UNACTIVE,
                'nick' => $nick,
                'create_time' => time(),
            ];
            $this->db->insert('lxyd_user_info', $data);
            return ['code' => 0,'msg'=>'注册成功','data'=>['user_id'=>$userId, 'auth_key'=>substr($password, 20, 16), 'nick'=>$nick]];
        }else{
            return ['code' => 500, 'msg' => '用户注册失败，请稍后再试'];
        }
    }

    public function login($email, $password, $verify_code){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return ['code' => 100, 'msg' => '邮件格式不正确'];
        }
        //缓存计数器获取一段时间登陆次数 超过次数验证码伺候todo
        $password = sha1($password);
        $sql = "SELECT id,password FROM lxyd_user WHERE email = '$email'";
        $query = $this->db->query($sql);
        $row = $query->row();
        if(!$row){
            return ['code' => 101, 'msg' => '账号尚未注册'];
        }else{
            if($password == $row['password']){
                //登陆成功，组织缓存
                    $userId = $row['id'];
                    //命中缓存 todo
                    //重构todo  getUserInfoById
                    $userInfo = [];
                    if(!empty($userInfo)){
                        $sql = "SELECT nick,status FROM lxyd_user_info WHERE user_id='$userId'";
                        $query = $this->db->query($sql);
                        $row = $query->row();
                        $nick = $row['nick'];
                        return ['code' => 0,'msg'=>'登陆成功','data'=>['user_id'=>$userId,'auth_key'=>substr($password, 20, 16), 'nick'=>$nick]];
                    }
            }else{
                return ['code' => 101, 'msg' => '密码输入错误'];
            }
        }
    }
    public function checkAuth(){
        $authArr = isset($_COOKIE['lxyd_sid']) ?  explode("#", base64_decode($_COOKIE['lxyd_sid'])) : false;
        if($authArr){
            if(count($authArr)==5 && is_numeric($authArr[0])){
                return md5($authArr[0].$authArr[1].$authArr[2].$authArr[3]) == $authArr[4];
            } 
        }
        return false;
    }

    public function setAuth($userId, $authKey){
        $authKeyVal = $this->_genAuthKey($userId, $authKey);
        setcookie("lxyd_sid", $authKeyVal);
    }
    private function _genAuthKey($userId, $authKey){
        $salt = $this->config->item('salt');
        $timestamp = time(); 
        $authKeyVal = base64_encode($userId."#".$authKey."#".$timestamp."#".$salt."#".md5($userId.$auth_key.$timestamp.$salt));
        return $authKeyVal;
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