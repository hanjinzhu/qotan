

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
            if(empty($ret)){
                $sql = "SELECT * FROM lxyd_user_info WHERE user_id = (SELECT id FROM lxyd_user WHERE email='$email')";
                $ret = $this->db->query($sql)->row_array();
            }
            return ['code' => 0, 'msg' => '','data'=>$ret];

        }
    }

    public function getUserInfoById($id){
        

        if(is_array($id)){
            $sql = "SELECT * FROM lxyd_user_info WHERE user_id IN (".implode(",",$id).")";
            $ret = $this->db->query($sql)->result_array();
        }else{
            if($this->cache_lock){
                //$redis = new Redis();
                //$ret = $redis->mget($uid);
            }
            $sql = "SELECT * FROM lxyd_user_info WHERE user_id = '$id'";
            $ret = $this->db->query($sql)->row_array();
        }
        return ['code' => 0, 'msg' => '','data'=>$ret];
    }
    public function register($email, $nick, $password){
        $password = sha1($password);
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $this->db->insert('lxyd_user', $data);
        $userId = $this->db->insert_id();
        if($userId){
            $data = [
                'user_id' => $userId,
                'status' => self::USER_STATUS_UNACTIVE,
                'nick' => $nick,
                'verify_code' => substr(md5(time().uniqid()),0,16),
                'verify_code_expire' => time()+86400,
                'create_time' => time(),
            ];
            $this->db->insert('lxyd_user_info', $data);
            return ['code' => 0,'msg'=>'注册成功','data'=>['user_id'=>$userId, 'auth_key'=>substr($password, 20, 16)]];
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
        $row = $query->row_array();  
        if(!$row){
            return ['code' => 101, 'msg' => '账号尚未注册'];
        }else{
            if($password == $row['password']){
                //登陆成功，组织缓存
                    $userId = $row['id'];
                  
                    //命中缓存 todo
                    //重构todo  getUserInfoById
                    $userInfo = [];
                    if(empty($userInfo)){
                        $sql = "SELECT nick,status FROM lxyd_user_info WHERE user_id='$userId'";
                        $query = $this->db->query($sql);
                        $row = $query->row_array();
                        $nick = $row['nick'];
                        return ['code' => 0,'msg'=>'登陆成功','data'=>['user_id'=>$userId,'auth_key'=>substr($password, 20, 16)]];
                    }
            }else{
                return ['code' => 101, 'msg' => '密码输入错误'];
            }
        }
    }
    public function checkAuth(){
        $this->load->helper('cookie');
        $salt = $this->config->item('salt');
        $lxydSid = get_cookie('lxyd_sid');
        $authArr =explode("#", base64_decode($lxydSid));
        if($authArr){
            if(is_numeric($authArr[0])){
                if(md5($authArr[0].$authArr[1].$authArr[2].$salt) == $authArr[3]){
                    return $authArr[0];
                }
            } 
        }
        return 0;
    }

    public function setAuth($userId, $authKey){
        $authKeyVal = $this->_genAuthKey($userId, $authKey);
        $this->load->helper('cookie');
        set_cookie("lxyd_sid", $authKeyVal, 0);
    }
    private function _genAuthKey($userId, $authKey){
        $salt = $this->config->item('salt');
        $timestamp = time(); 
        $authKeyVal = base64_encode($userId."#".$authKey."#".$timestamp."#".md5($userId.$authKey.$timestamp.$salt));
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