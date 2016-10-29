<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Mailer{  
    //发送类型，不同的类型选择不同的模板
    public $sendType;
    //回调链接
    public $url;
    //邮箱用户名
    public $email;
    function __construct( $params) {
        $this->sendType = $params['sendType'];
        $this->url = isset($params['url']) ? $params['url'] : '';
        $this->email = $params['email'];
    }
    function sendMail(){  
     
        //加载邮件模板
        $mailTplPath = APPPATH.'libraries/PHPMailer/tpl/'.$this->sendType.'.tpl';
        if(!file_exists($mailTplPath)){
            return false;
        }
        $mailTpl = str_replace(['{url}','{email}'], [$this->url,$this->email],file_get_contents($mailTplPath));
        if($this->sendType == 'register'){
            $title = '请激活您的离线阅读用户账号';
        }else{
            $title = '北京的二环';
        }
        include_once("PHPMailer/class.smtp.php");       // 引入php邮件类  
        include_once("PHPMailer/class.phpmailer.php");      // 引入php邮件类  
        $mail= new PHPMailer();  
        $mail->CharSet = "utf-8";                // 编码格式  
        //$mail->SMTPDebug = 1;
        $mail->IsSMTP();  
        $mail->SMTPAuth   = true;                   // 必填，SMTP服务器是否需要验证，true为需要，false为不需要  
        $mail->Host       = "smtp.163.com";         // 必填，设置SMTP服务器  
        $mail->Port       = 465;                     // 设置端口  
        $mail->Username   = "kapokilin@163.com";           // 必填，开通SMTP服务的邮箱
        $mail->Password   = "hanjinzhu1989";         // 必填， 以上邮箱对应的密码  
        $mail->SMTPSecure = 'ssl';                 //传输协议  
        $mail->From       = "kapokilin@163.com";       // 必填，发件人Email  
        $mail->FromName   = "离线阅读小秘书";             // 必填，发件人昵称或姓名  
        $mail->Subject    = "欢迎来我的公司参观";          // 必填，邮件标题（主题）  
        $mail->Body    = $mailTpl;
        $mail->AddReplyTo("support@lixianyuedu.com");           // 收件人回复的邮箱地址  
        $mail->AddAddress($this->email);      // 收件人邮箱  
        $mail->IsHTML(true);                 // 是否以HTML形式发送，如果不是，请删除此行  
  
        if(!$mail->Send())  
        {  
            //echo "Mailer Error: " . $mail->ErrorInfo;  
        }  
        
  
    }  
}  