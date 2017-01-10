<?php
error_reporting(E_ALL & ~E_NOTICE);

//Next section, defindex functions will be used.
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

//Next section output first part of index.php.
$scrap_dir = realpath('..');
$index_temp_file=__DIR__."/index.htm";
call_user_func("rm_index", $index_temp_file);
$data_dir=$scrap_dir."/data";
$atags="";
echo '<!DOCTYPE><html><head><meta charset=utf-8><title>Generator</title><meta >';
echo '<style>';
echo 'body > h1,h2,#processing {text-align:center}';
echo 'body > h1 {position:relative; left:-90px}';
echo '#processing {font-size:13px; font-weight:700;}';
echo '</style>';
echo '</head><body style="margin:0 auto">';
echo "<h2>Welcome to use scrapbook html generator!</h2>";
echo '<div id="processing">';
echo "Using the data in $data_dir to generate ./index.htm (bookmark page) ...<br>\n";

//Next section, generate index.htm, and copy index.htm to index.html.
$scrap_bmark_index_html_content="<!DOCTYPE><html><head><meta charset=utf-8><title>bookmark for scrapbook</title></head><body>";
$scrap_bmark_index_html_content .= '<div id="bk_atags">';
$arr_art_id = array();
foreach(new DirectoryIterator($data_dir) as $art_id_origin_blob) {
    $art_id_origin = (string)$art_id_origin_blob;
    if(in_array($art_id_origin, array('.', '..', '.git'))) continue;
    array_unshift($arr_art_id, $art_id_origin);
}
$art_count = count($arr_art_id);
$scrap_bmark_index_html_content .=  '<h3 style="text-align:center">This Scrap Bookmark page contains '.${art_count}.' a-tags of site-notes.</h3>';
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
$scrap_bmark_index_html_content .= '</div>';

$scrap_bmark_index_html_content .= '<div id="footer" style="margin:25px 40px; font-size:18px; weight:900">';
$scrap_bmark_index_html_content .= '<div id="greeting" style="margin-bottom:16px">Enjoy it :)</div>';
$scrap_bmark_index_html_content .= '<div>'.date('r').'</div>';
$scrap_bmark_index_html_content .= '</div>';
$scrap_bmark_index_html_content .= '</body></html>';
//echo $scrap_bmark_index_html_content;
file_put_contents($index_temp_file, $scrap_bmark_index_html_content);
$index_file=__DIR__."/index.html";
call_user_func("rm_index", $index_file);
echo "Copying ./index.htm to ./html.html ...<br>\n";
copy($index_temp_file, $index_file);

//Next section, output the last part of the index.php.
echo "Done! ".$art_count." a-tags had been generated.<br>\n";
echo 'This is the bookmark site link: <a href="./index.html">Scrap Bookmark page</a>.<br>\n';
echo 'You can also view the Scrap data page by date: <a href="../data">Scrap Data by date</a>.'."<br>\n";
echo "</div>";
echo '<h1 style="font-size:55px"><span style="color:silver">Enjoy it :)</span></h1>'."\n";
echo "</body></html>";
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
