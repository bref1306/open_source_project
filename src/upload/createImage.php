<?php
if(isset($_POST['widthPrimary'])){

}
if(isset($_POST['image1'])){
    echo $_POST['image1'];
}



/*$files = scandir('image/');
$fileToResize = null;
$fileExtension = null;
foreach ($files as $file) {
    if ($file != "." || $file != "..") {
        $fileToResize = "image/" . $file;
    }
}
$fileExtension = explode('.', $fileToResize);
$fileExtension = $fileExtension[1];
$source = null;

switch ($fileExtension) {
    case $fileExtension == "jpeg":
        $source = imagecreatefromjpeg($fileToResize);
        break;

    case $fileExtension == "png":
        $source = imagecreatefrompng($fileToResize);
        break;

    default :
        $source = imagecreatefromjpg($fileToResize);
}

list($width, $height) = getimagesize($fileToResize);
$new_width = 50;
$new_height = 50;

//$imgSize = imagecreatetruecolor($new_width, $new_height);création taille pour la nouvelle redimension

//création image 2 avec nouvelle dimension
imagecopyresampled($imgSize, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
$image2 = imagejpeg($imgSize, __DIR__ . "/image/copy.jpeg", 100);

//récupération des images 1 et 2
$image2 = imagecreatefromjpeg(__DIR__ . "/image/copy.jpeg");
$image1 = imagecreatefromjpeg(__DIR__ . "/image/fichier1.jpeg");

//calcul des hauteurs et largueurs des images1 et 2

$largeur_image2 = imagesx($image2);
$hauteur_image2 = imagesy($image2);

$largeur_image1 = imagesx($image1);
$hauteur_image1 = imagesy($image1);

//ATTENTION il faudra remplacer le 100 et 200 par les positions choisi par l'utilisateur

$destination_x = $largeur_image1 - 200;//position pour placer la deuxième image en x
$destination_y = $hauteur_image1 - 200;//position pour placer la deuxième image en y

//fusion des images
imagecopymerge($image1, $image2, $destination_x, $destination_y, 0, 0, $largeur_image2, $hauteur_image2, 100);
imagejpeg($image1, __DIR__ . "/image/copyFinal.jpeg", 100);*/

//echo "<img src='copyFinal.jpeg' style='width=100%'>";
