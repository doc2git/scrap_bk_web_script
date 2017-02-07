<?php
$art_id=$_GET['art_id'];
$art_content=file_get_contents("../data/${art_id}/index.html");
//exit($art_content);
$qstr='/'.$_GET['qstr'].'/i';
$art_content=preg_replace_callback(
    $qstr,
    function($matches) {
        return '<span style="color:red">'.$matches[0].'</span>';
    },
    $art_content);
echo $art_content;

