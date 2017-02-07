<?php
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
