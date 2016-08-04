<?php
function preProcess() {
		//$content = $this->rawPageCode;
		$content = '这里是网页原始码';
		//预处理
		// 1. DTD information 2. HTML comment 3. Java Script 4. CSS
		$pattern = ['/<!DOCTYPE.*?>/si','/<!--.*?-->/s','/<script.*?>.*?<\/script>/si','/<style.*?>.*?<\/style>/si'];
		$replacement = ['','','',''];
		$content = preg_replace( $pattern, $replacement, $content );
	 	//保留 img src
	 	$content = preg_replace('/<(img)\s+?.*?(src)=[\"|\'](.*?)[\"|\'].*?>/si','<img src="$3"/>',$content);
	 	//保留 a href
	 	$content = preg_replace('/<(a)\s+?.*?(href)=[\"|\'](.*?)[\"|\'].*?>/si','<a href="$3">',$content);
	 	//去除除A和IMG节点外的所有属性
	 	$content = preg_replace('/<((?!\bimg\b)(?!\ba\b)[a-z1-9]+?)\s+?.*?>/si','<$1>',$content);

		return $content;
	}

?>