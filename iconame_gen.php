<?php
date_default_timezone_set('Asia/Shanghai');
$cur_stamp=date("YmdHis", time());
$past=$cur_stamp-$art_id;
$days_year=date('L')?366:365;
$days_month=date('t');
$art_id=$_GET['art_id'];
if(1<2 && 2<3) echo $art_id; echo '<br>';
if($past>(60*60*24*$days_year)) { $when='favicon_year'.substr($art_id, 0, 4).'.ico'; }
if((60*60*24*$days_month)<$past && $past<(60*60*24*$days_year)) { $when='favicon_month'.substr($art_id, 4, 6).'.ico'; }
if((60*60*24*7)<$past && $past<(60*60*24*7*$days_month)) { $when='favicon_week'.float(substr($art_id, 6, 8)/7).'.ico'; }
if((60*60*24)<$past && $past<(60*60*24*7)) { $when='favicon_day'.substr($art_id, 6, 8).'.ico'; }
if((60*60)<$past && $past<(60*60*24)) { $when='favicon_hour'.substr($art_id, 8, 10).'.ico'; }
if($past<(60*60)) { $when='favicon_quarter'.floor(substr($art_id, 10, 12)/(15*60)).'.ico'; }
$favicon_ico_d="../favicon.ico.d";
echo $favicon_ico_d.'/'.$when;
echo '<br>';
var_dump(file_exists($favicon_ico_d.'/'.$when));
