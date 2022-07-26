<?php

function pree($d){
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

function convert_to_webp($file, $quality){

    $image=  imagecreatefromjpeg($file);
    ob_start();
    imagejpeg($image,NULL,100);
    $cont=  ob_get_contents();
    ob_end_clean();
    imagedestroy($image);
    $content =  imagecreatefromstring($cont);
    $file_name = basename($file);
    $new_file_name = str_replace('.jpg', '.webp', $file_name);
    imagewebp($content,'output/'.$new_file_name, $quality);
    imagedestroy($content);
}

$dir = "images";

$dir_scan = scandir($dir);

foreach($dir_scan as $file){
    if($file == "." || $file == '..') continue;

    if(!is_dir($file)){
       $file_path = "images/".$file;
       convert_to_webp($file_path, 50);

    }
}

