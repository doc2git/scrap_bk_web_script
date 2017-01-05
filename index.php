<?php

function substr_art_title($html_file){
    $html_contents=file_get_contents($html_file); 
    $start_title_tag_index =  strpos($html_contents, '<title>');
    $length_start_title_index = strlen('<title>');
    $start_title_index = $start_title_tag_index + $length_start_title_index;
    $close_title_index = strpos($html_contents, '</title>');
    $title_length = $close_title_index - $start_title_index;
    //echo "Title is: ";
    return substr($html_contents, $start_title_index, $title_length);
    //echo "<br>\n================<br>\n";
}

$scrap_bmark_index_html_content="<!DOCTYPE><html><head><meta charset=utf-8><title>bookmark for scrapbook</title></head><body>";
$scrap_dir = realpath('..');
$bmark_content_file=__DIR__."/bmark_content.html";
if (file_exists($bmark_content_file)) {
    unlink($bmark_content_file) or die("Cannot delete $bmark_content_file: $php_errormsg");
}
$data_dir=$scrap_dir."/data";
$atags="";
echo "Using the data in $data_dir to generate index.html (bookmark page) ...<br>\n";
foreach(new DirectoryIterator($data_dir) as $art_id) {
    //echo "<br>\n================<br>\n";
    if(in_array($art_id, array('.', '..'))) continue;
    $art_index_file=__DIR__."/../data/${art_id}/index.html";
    $atag_inner=call_user_func('substr_art_title', $art_index_file);
    $atag="<a href='../data/${art_id}/index.html'>${atag_inner}</a><br>";
    //echo $atag."<br>\n";
    $atags.=$atag;
    //$scrap_bmark_index_html_content .= $atag;
}
$scrap_bmark_index_html_content .= $atags;
$scrap_bmark_index_html_content .= '</body></html>';
//echo $scrap_bmark_index_html_content; exit;
//file_put_contents(__DIR__."/index.html", utf8_encode($scrap_bmark_index_html_content));
file_put_contents(__DIR__."/index.html", $scrap_bmark_index_html_content);
echo "Done!";
