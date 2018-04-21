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

$base_url = $navad;
$html = file_get_html($base_url);
//echo $html;

// For almost all websites, these tags are website dependent, they are a part of how they have organized their page.
// so these will work just for 90tv and may not work for other,
// on each page you can check the page source to find news tags in that specific page.
$tags = array("news-all","news-external","news-internal", "news-special");

foreach ($tags as $tag){
//    echo $tag."<br>";
    //get the news in each tag
    $news= $html->getElementById($tag);

    //for each one of those news, find the link to that specific news page
    foreach ($news->find('a') as $new){
//        echo $new."<br>";
        $rel_url = $new->href;
        $absolute_url=$base_url.$rel_url;

        //get the full content of that news page
        $each_news = file_get_html($absolute_url);
//        print_r($each_news) ;
//        echo $each_news;

        //get the header of that news
        foreach ($each_news->find('h1') as $item) {
            echo $item."<br>";
        }

        //get the page description from the <head> <meta name="description" content="...everything that is here...">
        $meta_tags= get_meta_tags($absolute_url);
        echo $meta_tags['description']."<br><br><br>";

        //in the main content of that news page, get the first image
        foreach ($each_news->find('main.content') as $content){
            foreach ($content->find('img') as $img){
                echo $img."<br>";
                break;
            }
//        exit("********");
        }
//        echo $absolute_url."<br>";
    }
}
?>
</body>
</html>
