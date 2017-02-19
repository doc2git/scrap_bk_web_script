<?php
//Next section, replace local reference $source to ./$src_dir/$files, except $source contain string in $except_substrs[]. 
$art_id=$_GET['art_id'];
$src_dir="../data/${art_id}";
$index_html_content=file_get_contents("${src_dir}/index.html");
$local_refer_pattern='/( src| href)(=(\"|\'))([^(\/)|(\")|(\')]*)(\"|\')/i';
$local_refer_replacement="$1$2${src_dir}/$4\"";
$index_html_content=iconv("UTF-8", "GB2312//IGNORE", $index_html_content);
$index_html_content=str_replace( '<script charset="utf-8" ', '<script charset="gb2312" ', $index_html_content);
$index_html_content=str_replace( '<script charset="UTF-8" ', '<script charset="GB2312" ', $index_html_content);
$index_html_content=
$index_html_content=preg_replace_callback(
    $local_refer_pattern,
    function ($matches) {
        $except_substrs=array('about:', 'chrome:', 'http://', 'https://', 'ftp://', 'ssh://', 'git://', 'rsync://'); 
        foreach($except_substrs as $value){
            if(substr_count($matches[0], $value)) {
                return $matches[0];
            }
        }
        return $matches[1].$matches[2].$GLOBALS['src_dir'].'/'.$matches[4].$matches[3];
    },
    $index_html_content
);


function iconame_gen(){
    date_default_timezone_set('Asia/Shanghai');
    $art_id=$GLOBALS['art_id'];
    $cur_stamp=time();
    $art_id_stamp=mktime(substr($art_id, 8, 2), substr($art_id, 10, 2), substr($art_id, 12, 2), substr($art_id, 4, 2), substr($art_id, 6, 2), substr($art_id, 0, 4));
    $past=$cur_stamp-$art_id_stamp;
    $days_year=date('L')?366:365;
    $days_month=date('t');
    //var_dump($art_id);
    //if(1<2 && 2<3) echo $art_id; echo '<br>';
    if($past>(60*60*24*$days_year)) { $when='favicon_year'.intval(substr($art_id, 0, 4)).'.ico'; }
    if((60*60*24*$days_month)<$past && $past<(60*60*24*$days_year)) { $when='favicon_month'.intval(substr($art_id, 4, 2)).'.ico'; }
    if((60*60*24*7)<$past && $past<(60*60*24*$days_month)) { $when='favicon_week'.intval(floor($past/(60*60*24*7))).'.ico'; }
    if((60*60*24)<$past && $past<(60*60*24*7)) { $when='favicon_day'.intval(floor($past/(60*60*24))).'.ico'; }
    if((60*60)<$past && $past<(60*60*24)) { $when='favicon_hour'.intval(floor($past/(60*60))).'.ico'; }
    if($past<(60*60)) { $when='favicon_quarter'.intval(floor($past/(15*60))).'.ico'; }
    //if($past<60*15) { $when='favicon_just_now.ico'; }
    //$_SERVER=$GLOBALS['_SERVER'];
    //var_dump($_SERVER); exit;
    $favicon_prefix='http://'.$_SERVER["SERVER_NAME"].'/data/favicon.ico.d';
    return $favicon_prefix.'/'.$when;
    //echo '<br>';
    //var_dump(file_exists($favicon_prefix.'/'.$when));
}



//Next section, replace link ico image to myown.
//$link_pattern='/\<link [^\/|\>]*image\/x-icon[^\/|\>]*\/\>/i';
$link_pattern='/<link [^>]+\.ico[^>]+>/';
$index_html_content=preg_replace_callback(
    $link_pattern,
    function ($matches) {
        return '';
    },
    $index_html_content);
$iconame=call_user_func('iconame_gen');
//exit($iconame);
//echo $iconame; exit;
$close_title_tag=array('</ title>', '</title>', '<title />', '<title/>');
$index_html_content=str_replace($close_title_tag, '</title><link rel="Shortcut Icon" href="'.$iconame.'" type="image/x-icon" />', $index_html_content);
//$index_html_content=htmlEntities($index_html_content);
echo $index_html_content;

