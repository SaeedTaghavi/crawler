<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
<!--    <title>test page</title>-->
<!--</head>-->
<!--<body>-->

<?php
include_once('simple_html_dom.php');
header('Content-Type: text/html; charset=UTF-8');

$navad = "http://90tv.ir/";
$mypage = "http://localhost/crawler/mypage.html";

$html = file_get_html($navad);
//echo $html;
$base_url = $navad;

$tags = array("news-all","news-external","news-internal", "news-special");
foreach ($tags as $tag){
//    echo $tag."<br>";
    $news= $html->getElementById($tag);
    foreach ($news->find('a') as $new){
//        echo $new."<br>";
        $rel_url = $new->href;
        $absolute_url=$base_url.$rel_url;
        $each_news = file_get_html($absolute_url);
//        print_r($each_news) ;
//        echo $each_news;
        foreach ($each_news->find('h1') as $item) {
            echo $item;
        }
        foreach ($each_news->find('main.content') as $content){
            foreach ($content->find('img') as $img){
                echo $img."<br>";
                break;
            }
        }
//        echo $absolute_url."<br>";
    }
}

?>
</body>
</html>
