<?php
function output($data, $callback='', $exit = true){
	if (!empty($callback)){
		if (! headers_sent())
		{
			header("Cache-Control:maxage=1");
			header("Content-type: text/javascript; charset=UTF-8");
		}
		$jsonp = $callback;
		echo $jsonp . '(' . json_encode($data,JSON_UNESCAPED_UNICODE) . ')';
	}
	else{
		$result = json_encode($data,JSON_UNESCAPED_UNICODE);
		if (function_exists('json_last_error')) {
			$error = json_last_error();
			if ($error !== JSON_ERROR_NONE) {
				//TODO  Json编码错误，打印日志
				//log('Action/json_encode', "======================================");
				//$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
				//log("Action/json_encode", array('data' => print_r($data, true), 'request_url' => $url, 'error' => $error));
			}
		}
		echo $result;
	}
	if ($exit){
			exit();
	}
	return true;
}

function time_tran($the_time) {  
    $now_time = date("Y-m-d H:i:s", time());  
    //echo $now_time;  
    $now_time = strtotime($now_time);  
    $show_time = strtotime($the_time);  
    $dur = $now_time - $show_time;  
    if ($dur < 0) {  
        return $the_time;  
    } else {  
        if ($dur < 60) {  
            return $dur . '秒前';  
        } else {  
            if ($dur < 3600) {  
                return floor($dur / 60) . '分钟前';  
            } else {  
                if ($dur < 86400) {  
                    return floor($dur / 3600) . '小时前';  
                } else {  
                    if ($dur < 259200) {//3天内  
                        return floor($dur / 86400) . '天前';  
                    } else {  
                        return $the_time;  
                    }  
                }  
            }  
        }  
    }  
}  
 
/**
* 返回的值的一列$input阵列，确定由columnKey。或者，您可以提供一个indexKey指数的$input数组中的值从indexKey列返回的数组中的值。
* 像从数据库获取一列，但返回是数组（扩展：获取多列）
* @param array $input 一个多维数组（记录集），拉一列值
* @param mixed $columnKey 返回值的列。想要检索的列值可以是整数键，或者它可能是一个关联数组，字符串键名。
* 扩展功能：数组，
* 传递array()，则直接返回所有数据，
* array('key1', 'key2', ....)，则返回对应相应的key所对应的值，索引保持不变
* @param mixed $indexKey 列返回的数组中的索引/键使用。此值可以是该列的整数键，或者它可以是字符串键的名称。（可选）
*
* @return array
*/
function hd_array_column($input, $columnKey, $indexKey = null){
	$result = array();
	if(!is_array($input))
	return $result;
	$isFetchAll = false;
	foreach($input as $item){
		if(is_array($columnKey)){ // 数组
			if(empty($columnKey))
			$isFetchAll = true;
			if(!empty($columnKey) || $isFetchAll){
				$tempItem = '';
				if(!$isFetchAll){
					foreach($columnKey as $colKey){
						if(isset($item[$colKey]))
						$tempItem[$colKey] = $item[$colKey];
					}
				}
				else
				$tempItem = $item;
				if(null !== $indexKey && isset($item[$indexKey]) && !is_array($item[$indexKey]))
				$result[$item[$indexKey]] = $tempItem;
				else
				$result[] = $tempItem;
			}
		}
		else{ // 整数、字符串
			if(isset($item[$columnKey])){
				if(null !== $indexKey && isset($item[$indexKey]) && !is_array($item[$indexKey]))
				$result[$item[$indexKey]] = $item[$columnKey];
				else
				$result[] = $item[$columnKey];
			}
		}
	}
	return $result;
} 
?>