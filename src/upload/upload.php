
<<<<<<< HEAD
=======
<h2>Formulaire de test réception fichier local</h2>
<!-- <form method="post" action="" enctype='multipart/form-data'>
    <input type="file" name="file1">
    <input type="file" name="file2">
    <button type="submit">valider</button>
</form> -->


>>>>>>> b7293e0c72277f115fa8be71428d4c70b0ea808b
<form method="post" action="">
    <h3>choisir position pour la deuxième image</h3>
    <label style="display: inline-block; width: 100px">horizontale : </label>
    <input placeholder="exemple : 100.3" name="posX" style="margin-left: 20px"><br>
    <label style="display: inline-block;width: 100px">verticale :  </label>
    <input placeholder="exemple : 100.3" name="posY" style="margin-left: 20px">
    <button type="submit">Valider</button>
</form>
<?php


$extension=['jpeg','png','jpg'];
$files=array();

$message=null;
if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    $files[] = $_FILES['file1'];
    $files[]=  $_FILES['file2'];

    for($i=0;$i<sizeof($files);$i++){
       $type=explode('/',$files[$i]['type']);
        if(!in_array($type[1],$extension)){
            $message=$files[$i]['name'];
            header('Location:../index.php?message='.$message.'');
            exit;
        }
    }
}
else{
    $message="fileMissing";
    header('Location:../index.php?message='.$message.'');
}

