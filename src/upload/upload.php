<script src="https://cdn.tailwindcss.com"></script>
<?php
include "../Fusion.php";

$message=null;
// conditionnal, execution save new image

if(isset($_POST["widthPrimary"])) {
    $fusion = new Fusion(null, null, "image/");
    $m = $fusion->resizeImages($_POST);
    if($m === true) return json_encode(true);

} else if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    /*remove all files before creating*/
    $directory = scandir(__DIR__.'/image/');
    foreach ($directory as $file){
        if($file!="." && $file!=".."){
            unlink(__DIR__."/image/".$file);
        }
    }
    $fusion = new Fusion($_FILES['file1'], $_FILES['file2'], "image/");
    $m = $fusion->uploadFiles();
    if ($m != true) header('Location:../index.php?message='.$m.'');
    else header('Location: resize.php');
} else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
    exit;
}