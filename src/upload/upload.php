<script src="https://cdn.tailwindcss.com"></script>

<?php 

include '../vendor/gumlet/php-image-resize/lib/ImageResize.php'; 
$image = new \Gumlet\ImageResize('fichier1.png');
$image->scale(50);
$image->save('image2.jpg');
var_dump($image);

?>

<form method="post" action="">
    <h3>choisir position pour la deuxième image</h3>
    <label style="display: inline-block; width: 100px">horizontale : </label>
    <input placeholder="exemple : 100.3" name="posX" style="margin-left: 20px"><br>
    <label style="display: inline-block;width: 100px">verticale :  </label>
    <input placeholder="exemple : 100.3" name="posY" style="margin-left: 20px">
    <button type="submit">Valider</button>
</form>
<?php


$extensionAllowed=['jpeg','png','jpg'];
$fileExtension=array();
$files=array();
$message=null;

if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    $files[] = $_FILES['file1'];
    $files[]=  $_FILES['file2'];

    for($i=0; $i<sizeof($files) ;$i++){
       $type=explode('/',$files[$i]['type']);
       $fileExtension[]=$type[1];

        if(!in_array($fileExtension[$i],$extensionAllowed)){
            $message=$files[$i]['name'];
            header('Location:../index.php?message='.$message.'');
            exit;
        }
        else{
            /*  Move tempory files to image folder  */
            $tmpName=$files[$i]['tmp_name'];
            move_uploaded_file($tmpName,'image/fichier'.($i+1).'.'.$fileExtension[0].'');
        }
    }

    /*redirect to resize image url*/
    if(file_exists('image/fichier1.'.$fileExtension[0].'') && file_exists('image/fichier2.'.$fileExtension[0].'')){
        header('Location: resize.php');
        exit;
    }
    else{
         echo "<h1>Erreur de fichier</h1>";
    }
}
else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
    exit;
}



