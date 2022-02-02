<?php

$files=scandir('image/');
$fileToResize=null;
$fileExtension = null;
foreach ($files as $file){
    if($file !="." || $file !=".."){
        $fileToResize="image/".$file;
    }
}
$fileExtension=explode('.',$fileToResize);
$fileExtension=$fileExtension[1];

$imgSize=imagecreatetruecolor(200,100);

$source=null;
switch ($fileExtension){
    case $fileExtension=="jpeg":
        $source = imagecreatefromjpeg($fileToResize);
    break;

    case $fileExtension=="png":
        $source = imagecreatefrompng($fileToResize);
    break;

    default :
        $source = imagecreatefromjpg($fileToResize);
}

/*list($width, $height) = getimagesize($source);*/


imagecopyresampled($imgSize,$source, 0, 0, 0, 0,200,300,200,300);
imagejpeg($imgSize, "copy.jpeg", 100);