<?php
ini_set("display_errors",1);

$id = $_GET['id'];

//获取评论url及页面
$comment_url =  'http://m.cnbeta.com/wap/comments.htm?id='.$id;
$comment_html = file_get_contents($comment_url);

//获取评论主体
preg_match("/<div class=\"content\">([\s\S]*)<div class=\"pager\">/iU",$comment_html,$comment_result);

//获取文章页面
$article_url =  'http://m.cnbeta.com/wap/view/'.$id.'.htm';
$article_html = file_get_contents($article_url);

//获取文章页面头部
preg_match("/<\?xml version=\"1.0\"([\s\S]*)<body style=\"margin-bottom\:100px\">/iU",$article_html,$article_result_firstpart);
//替换百度广告
$article_result_firstpart=str_replace("<script src=\"http://cpro.baidustatic.com/cpro/ui/mi.js\"></script>","", $article_result_firstpart);

//获取文章内容
preg_match("/<section class=\"clearfix\">([\s\S]*)<\/a><br\/>/iU",$article_html,$main_article);

//替换图片url，图片设置了referer，因此需间接获取
$main_article[0]=str_replace("http://static.cnbetacdn.com/","/get_img_file.php?img_url=http://static.cnbetacdn.com/", $main_article[0]);
 
//替换优酷或者土豆url，编辑总是将优酷设置成flash版本，导致手机看不了。
//preg_match("/<section class=\"clearfix\">([\s\S]*)<\/a><br\/>/iU",$article_html,$main_article);

//$main_article[0]=str_replace("http://static.cnbetacdn.com/","http://www.tudou.com/programs/view/Zq1aYsD_e0I", $main_article[0]);
//<iframe height=498 width=510 src="http://player.youku.com/embed/XMTYzMDI1NzYzNg==" frameborder=0 allowfullscreen></iframe>



$copyright="<div class=\"copy\">
	&copy; 2003-2016
</div>
</body>
</html>";



//输出页面
echo $article_result_firstpart[0].$main_article[0].$comment_result[0].$copyright;
?>
