<script src="https://cdn.tailwindcss.com"></script>
<?php
include "../Fusion.php";

$extensionAllowed=['jpeg','png','jpg'];
$fileExtension=array();
$files=array();
$message=null;

if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    /*remove all files before creating*/
    $directory = scandir(__DIR__.'/image/');
    foreach ($directory as $file){
        if($file!="." && $file!=".."){
            unlink(__DIR__."/image/".$file);
        }
    }

    //redirect to resize image url if  fichier1 and fichier2 exist
    if(file_exists('image/fichier1.'.$fileExtension[0].'') && file_exists('image/fichier2.'.$fileExtension[1].'')){
        header('Location: resize.html');
        exit;
    }
    $fusion = new Fusion($_FILES['file1'], $_FILES['file2'], "src/upload/image/");
    $m = $fusion->uploadFiles();
    if ($m != true) header('Location:../index.php?message='.$m.'');
    else header('Location: resize.php');
} else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
    exit;
}



