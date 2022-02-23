<?php
include "../vendor/autoload.php";
include "../vendor/Fusion/Fusion.php";
// load autoload from vendor 
$message=null;
if(isset($_POST["widthPrimary"])) {
    $fusion = new Fusion(null, null, dirname(__FILE__)."/image/");
    $m = $fusion->resizeImages($_POST);
    if($m !== false) {
        $r = json_encode(dirname(__FILE__).$m);
        $r = str_replace('\\\\', "/", $r);

        echo $r;
        exit;
    } else echo json_encode($m);
} else if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    // GIVE ABSOLUTE PATH 
    $p = dirname(__FILE__)."/image/";
    //die($p);
    $fusion = new Fusion($_FILES['file1'], $_FILES['file2'],$p);
    $m = $fusion->uploadFiles();
    if ($m != true) header('Location:../index.php?message='.$m.'');
    else header('Location: resize.php');
} else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
    exit;
}