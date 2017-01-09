<?php
error_reporting(E_ALL & ~E_NOTICE);
function rm_index($index) {
    if (file_exists($index)) {
        if (!(unlink($index))) {
            echo "Cannot delete $index: $php_errormsg";
            exit;
        }
    }
}
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
$index_temp_file=__DIR__."/index.htm";
call_user_func("rm_index", $index_temp_file);
$data_dir=$scrap_dir."/data";
$atags="";
echo "Using the data in $data_dir to generate index.html (bookmark page) ...<br>\n";
$arr_art_id = array();
foreach(new DirectoryIterator($data_dir) as $art_id_origin_blob) {
    $art_id_origin = (string)$art_id_origin_blob;
    if(in_array($art_id_origin, array('.', '..', '.git'))) continue;
    array_unshift($arr_art_id, $art_id_origin);
}
$art_count = count($arr_art_id);
$scrap_bmark_index_html_content .=  "<h3>This Scrap Bookmark page contains ".${art_count}." a-tags of site-notes.</h3>";
foreach ($arr_art_id as $art_id) {
    //echo "<br>\n================<br>\n";
    $art_index_file=__DIR__."/../data/${art_id}/index.html";
    $atag_inner=call_user_func('substr_art_title', $art_index_file);
    $atag="<a href='../data/${art_id}/index.html'>${atag_inner}</a><br>";
    //echo $atag."<br>\n";
    $atags.=$atag;
    //$scrap_bmark_index_html_content .= $atag;
}
$scrap_bmark_index_html_content .= $atags;
$scrap_bmark_index_html_content .= '</body></html>';
//echo $scrap_bmark_index_html_content;
file_put_contents($index_temp_file, $scrap_bmark_index_html_content);
$index_file=__DIR__."/index.html";
call_user_func("rm_index", $index_file);
copy($index_temp_file, $index_file);
echo "Done! ".$art_count." a-tags had been generated.<br>\n";
echo "This is the bookmark site link: <a herf='./index.html'>Scrap Bookmark page</a><br>\n";
echo "Enjoy it :)<br>\n";
$execute_log_file = "./execute.log";
if (!(file_exists($execute_log_file))){
    $str_log = "";
} else {
    $str_log = file_get_contents("$execute_log_file");
}
//date.timezone = "Asia/Chongqing";
$str_log_increase = "Executed at ".date('r').".\n";
$str_log .= $str_log_increase;
file_put_contents($execute_log_file, $str_log);
