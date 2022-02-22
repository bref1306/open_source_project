<script src="https://cdn.tailwindcss.com"></script>
<?php
include "../Fusion.php";

$extensionAllowed=['jpeg','png','jpg'];
$fileExtension=array();
$files=array();
$message=null;

if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    $fusion = new Fusion($_FILES['file1'], $_FILES['file2'], "src/upload/image/");
    $m = $fusion->uploadFiles();
    if ($m != true) header('Location:../index.php?message='.$m.'');
    else header('Location: resize.php');
} else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
    exit;
}



