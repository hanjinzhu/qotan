<?php 
/**
 * Created on 2016-09-12
 * author: LinXin
 * Email: 601630504@qq.com
 */
require_once "TextRank/vendor/multi-array/MultiArray.php";
require_once "TextRank/vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "TextRank/class/Jieba.php";
require_once "TextRank/class/Finalseg.php";
require_once "TextRank/class/JiebaAnalyse.php";
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;




class TextRank {
	function getTag($article) {
		Jieba::init(array('mode'=>'test','dict'=>'samll'));
		Finalseg::init();
		JiebaAnalyse::init();
		$top_k = 10;
		$tags = JiebaAnalyse::extractTags($article, $top_k);
		return $tags;
	}
	
}
?>