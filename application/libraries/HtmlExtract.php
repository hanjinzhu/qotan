<?php 
/**
 * Created on 2016-07-12
 * author: LinXin
 * Email: 601630504@qq.com
 */
class HtmlExtract {
	
	/**
	 * 目标转码页
	 * @var string
	 */
	public $url         = '';
	public $urlBase     = '';
	
	/**
	 * 原始源码
	 * @var string
	 */
	public $rawPageCode = '';

	/**
	 * 源码行数组
	 * @var array
	 */
	public $textLines   = [];
	
	/**
	 * block片段
	 * @var array
	 */
	public $blksLen     = [];
	
	public $title = '';
	public $platform = '1';
	/**
	 * 系统最后的转码html
	 * @var string
	 */
	public $text        = '';
	
	/**
	 * block片段长度
	 * 
	 * @var int
	 */
	public $blkSize;
	
	/**
	 * 字符编码
	 * @var string
	 */
	public $charset;
	
	///////////////////////////////////
	// METHODS
	///////////////////////////////////
	
	function __construct( $params) {
		$_url = $params['url'];
		$this->url = $_url;
		$this->platform = $params['platform'];
		$parse= parse_url ( $_url );
		$this->urlBase = $parse['scheme']."://".$parse['host'];
		$this->blkSize = 3;   //初始化行块长度
		$this->rawPageCode = $this->_fetchUrlContent( $this->url );
	}
	private function _fetchUrlContent($url, $timeout = 5, $method="GET"){
		$opts = [
		    'http'=>[
			    'method' => $method,
			    'timeout' => $timeout,
			]
		];
		$context = stream_context_create($opts); 
		return file_get_contents($url, false, $context);
	}

	
	/**
	 * 检查原始编码 处理完毕需要转换成UTF8
	 * @return void
	 */
	function procEncoding() {
		$this->charset = mb_detect_encoding($this->rawPageCode, ["ASCII","GB2312","GBK","BIG5","UTF-8"], true);
	}
	
	/**
	 * 对网页内容进行预处理
	 * @return string
	 */
	function preProcess() {
		$content = $this->rawPageCode;
		if($this->charset!='UTF-8'){
			$content = iconv($this->charset,"UTF-8//IGNORE",$content);
		}
		preg_match("/<title>(.*)<\/title>/si",$content, $title);
		$filterTitleChar = ['|','-','/','#','_'];
		$title = $title[1];
		foreach($filterTitleChar as $v){
			if(strpos($title,$v)!==false){
				$title=strchr($title,$v,true);//去除无意义的信息  正文标题 分隔符 网站描述信息  只留正文标题
			}
		}
		$this->title = $title;
		//预处理
		// 1. DTD  2. 注释 3. Java Script 4. CSS
		$pattern = ['/<!DOCTYPE.*?>/si','/<!--.*?-->/s','/<script.*?>.*?<\/script>/si','/<style.*?>.*?<\/style>/si'];
		$replacement = ['','','',''];
		$content = preg_replace( $pattern, $replacement, $content );
	 	//保留 img src
	 	$content = preg_replace('/<(img)\s+?.*?(src)=[\"|\'](.*?)[\"|\'].*?>/si','<img src="$3"/>',$content);
	 	//保留 a href
	 	$content = preg_replace('/<(a)\s+?.*?(href)=[\"|\'](.*?)[\"|\'].*?>/si','<a href="$3">',$content);
	 	//去除除A和IMG节点外的所有属性
	 	$content = preg_replace('/<((?!\bimg\b)(?!\ba\b)[a-z1-9]+?)\s+?.*?>/si','<$1>',$content);
		//处理特殊字符
		$pattern = '/&.{1,5};|&#.{1,5};/';
		$replacement = '';
		$content = preg_replace( $pattern, $replacement, $content );
		return $content;
	}
	
	/**
	 * 将原始网页转换成行数组 by '\n'
	 * replacing "\r\n", '\n', and '\r' with '\n'
	 * @param string @rawText
	 * @return void
	 */
	function getTextLines( $rawText ) {
		$order = [ "\r\n", "\n", "\r" ];
		$replace = '\n';
		$rawText = str_replace( $order, $replace, $rawText );
		$lines = explode( '\n', $rawText );
		$this->textLines = array_map('trim',$lines);
	}
	
	/**
	 * 计算行块长度用于做分布比较
	 * @return void
	 */
	function calBlocksLen() {
		$pattern = '/<.*?>/s';
		$replacement = '';
		$textLineNum = count( $this->textLines );
		// calculate the first block's length
		$blkLen = 0;
		for( $i = 0; $i < $this->blkSize; $i++ ) {
			$blkLen += strlen( preg_replace( $pattern, $replacement, $this->textLines[$i]) );
		}
		$this->blksLen[] = $blkLen;
		
		// calculate the other block's length using Dynamic Programming method
		for( $i = 1; $i < ($textLineNum - $this->blkSize); $i++ ) {
			$blkLen = $this->blksLen[$i - 1] + strlen( preg_replace( $pattern, $replacement, $this->textLines[$i - 1 + $this->blkSize]) ) - strlen( preg_replace( $pattern, $replacement, $this->textLines[$i - 1]));
			$this->blksLen[] = $blkLen;
		}
	}
	
	/**
	 * 计算最后的目标网页
	 * @return string
	 */
	function getPlainText() {
		$pattern = '/<.*?>/s';
		$replacement = '';
		$this->procEncoding();
		$preProcText = $this->preProcess();
		$this->getTextLines( $preProcText );
		//print_r($this->textLines);exit;
		$this->calBlocksLen();
		
		$start = $end = -1;
		$i = $maxTextLen = 0;
		
		$blkNum = count( $this->blksLen );
		while( $i < $blkNum ) {
			while( ($i < $blkNum) && ($this->blksLen[$i] == 0) ) $i++;
			if( $i >= $blkNum ) break;
			$tmp = $i;
			$curTextLen = 0;
			$portion = $this-> loadStyle();
			//$portion = '<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />';
			//$portion = $portion.'<link rel="stylesheet" type="text/css" href="/normalize.css" /><link rel="stylesheet" type="text/css" href="/medusa.css" />'; //加载自适应和自定义的CSS
			while( ($i < $blkNum) && ($this->blksLen[$i] != 0) ) {
				if( preg_replace( $pattern, $replacement, $this->textLines[$i] != '' )){
					$portion .= $this->textLines[$i]."\r\n";
					//$portion .= '<br />';
					$curTextLen += strlen( preg_replace( $pattern, $replacement, $this->textLines[$i]));
				}
				$i++;
			}
			if( $curTextLen > $maxTextLen ) {
				$this->text = $portion;
				$maxTextLen = $curTextLen;
				$start = $tmp;
				$end = $i - 1;
			}
		}
		$text = tidy_parse_string($this->text,['output-html' => true], 'utf8');
		$text->cleanRepair();
		$pattern="/<[img|IMG].*?src=[\'|\"](.*)[\'|\"].*?[\/]?>/";
		preg_match_all($pattern,$text,$matches);
		$imgMatches = $matches[1];
		$find = $replace =[];
		if(is_array($imgMatches)){
			//foreach($imgMatches as $v){
			//	$find[] = $v;
			//	$filePath = $v;
			//	$ext = pathinfo($v,PATHINFO_EXTENSION);
			//	if(!preg_match("/^[http|https].*/si", $filePath)){
			//		$filePath = $this->urlBase.$v;
			//	}
			//	$content = $this->_fetchUrlContent($filePath);
			//	if($ext){
			//		$toPath = "file/".md5($filePath).".".$ext;
			//	}else{
			//		$toPath = "file/".md5($filePath);
			//	}
			//	$replace[] = $toPath;
			//	file_put_contents($toPath, $content);
			//}
			//$text = str_replace($find,$replace,$text);
		}
		//preg_match_all('/<img src=".*"\/>/', $text, $matches );
		return $text;
	}

	public function getRawText(){
		return $this->rawPageCode;
	}
	public function getTitle(){
		return $this->title;
	}

	private function loadStyle(){
        $styleString = '';
        switch ($this->platform) {
            case '1':
                $styleString='<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />';
                $styleString.='<link rel="stylesheet" type="text/css" href="/static/css/normalize.css" />';
                $styleString.='<link rel="stylesheet" type="text/css" href="/static/css/medusa_pc.css" />';
                break;
            default:
                # code...
                break;
        }
        return $styleString;
    }
}
?>