<?php
ini_set("display_errors",1);
//error_report(E_ALL);
if ( empty($_GET['page']) )
 {
 	$index_page_url =  'http://m.cnbeta.com/wap';
 }
else 
	{ $index_page_url='http://m.cnbeta.com/wap/index.htm?page='.$_GET['page'];
}

$index_page_html = file_get_contents($index_page_url);
//$html=str_replace("<head>", "<head><meta  charset=utf-8  />", $html);
//获取头部
preg_match("/<\?xml version=\"1.0\"([\s\S]*)<body style=\"margin-bottom\:100px\">/iU",$index_page_html,$article_result_firstpart);
//替换百度广告
$article_result_firstpart=str_replace("<script src=\"http://cpro.baidustatic.com/cpro/ui/mi.js\"></script>","", $article_result_firstpart);

$article_result_2_part[0]='<div><div>';
preg_match("/<div class=\"list\">([\s\S]*)<\/div><\/div>/iU",$index_page_html,$article_result_3_part);

$article_result_3_part[0]=str_replace("/wap/index.htm","index.php", $article_result_3_part[0]);
$article_result_3_part[0]=str_replace("/wap/view/","article.php?id=", $article_result_3_part[0]);
$article_result_3_part[0]=str_replace(".htm\">","\">", $article_result_3_part[0]);
$article_result_4_part[0]='</div>';

	preg_match("/<a href=\"\">([\s\S]*)<\/p>/iU",$index_page_html,$article_result_5_part);
 

$article_result_5_part[0]=str_replace("<a href=\"/mobile/wap\">","<a href=\"/\">", $article_result_5_part[0]);
$article_result_last_part[0]="<div class=\"copy\">&copy; 2003-2016</div></body></html>";

echo $article_result_firstpart[0].$article_result_2_part[0].$article_result_3_part[0].$article_result_4_part[0].$article_result_5_part[0].$article_result_last_part[0];
 
?>
