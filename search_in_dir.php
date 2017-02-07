<?php
foreach(new DirectoryIterator($data_dir) as $art_id_origin_blob) {
    $art_id_origin = (string)$art_id_origin_blob;
    if(in_array($art_id_origin, array('.', '..', '.git', 'favicon.ico.d'))) continue;
    array_unshift($arr_art_id, $art_id_origin);
}

