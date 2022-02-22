<?php
/**
 * 
 * 
 */
class Fusion {
    public $extensionAllowed =['jpeg','png','jpg'];
    public $pathImage;
    private $file1;
    private $file2;

    function __construct(Array $file1, Array $file2, String $path) {
        $this->file1 = $file1;
        $this->file2 = $file2;
        $this->pathImage = $path;
    }

    /**
     * @param file $file1 First file uploaded
     * @param file $file2 Second file uploaded
     */
    public function uploadFiles(){
        if(empty($this->file1) || empty($this->file2)) {
            $message="fileMissing";
            // header('Location:../index.php?message='.$message.'');
            // exit;
            return $message;
        }
        $files[] = $this->file1;
        $files[]=  $this->file2;

        for($i=0; $i<sizeof($files) ;$i++){
            $type=explode('/',$files[$i]['type']);
            $fileExtension[]=$type[1];
     
            if(!in_array($fileExtension[$i],$this->extensionAllowed)){
                $message=$files[$i]['name'];
                // header('Location:../index.php?message='.$message.'');
                // exit;
                return $message;
            } else{
                /*  Move tempory files to image folder  */
                $tmpName=$files[$i]['tmp_name'];
                move_uploaded_file($tmpName,$this->pathImage.'fichier'.($i+1).'.'.$fileExtension[$i].'');
            }
        }
        /*redirect to resize image url*/
        if(file_exists('image/fichier1.'.$fileExtension[0].'') && file_exists('image/fichier2.'.$fileExtension[1].'')){
            return true;
        } else return "Erreur de fichier</h1>";
    }
    /**
     * @param array $param Datas send by post method
     */
    public function resizeImages(array $param){
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
        $source=null;
        
        switch ($fileExtension){
            case $fileExtension=="jpeg":
                $source = imagecreatefromjpeg($fileToResize);
            break;
        
            case $fileExtension=="png":
                $source = imagecreatefrompng($fileToResize);
            break;
        
            default :
                $source = imagecreatefromjpeg($fileToResize);
        }
        
        list($width, $height) = getimagesize($fileToResize);
        $new_width = 50 ;
        $new_height = 50 ;
        
        $imgSize=imagecreatetruecolor($new_width,$new_height);/*création taille pour la nouvelle redimension*/
        
        //création image 2 avec nouvelle dimension
        imagecopyresampled($imgSize,$source, 0, 0, 0, 0,$new_width,$new_height,$width,$height);
        $image2=imagejpeg($imgSize, "copy.jpeg", 100);
        
        //récupération des images 1 et 2
        $image2=imagecreatefromjpeg("copy.jpeg");
        $image1 = imagecreatefrompng("image/fichier1.png");
        
        //calcul des hauteurs et largueurs des images1 et 2
        
        $largeur_image2 = imagesx($image2);
        $hauteur_image2 = imagesy($image2);
        
        $largeur_image1 = imagesx($image1);
        $hauteur_image1 = imagesy($image1);
        
        /*ATTENTION il faudra remplacer le 100 et 200 par les positions choisi par l'utilisateur*/
        
        $destination_x = $largeur_image1 - 100;//position pour placer la deuxième image en x
        $destination_y = $hauteur_image1 - 200;//position pour placer la deuxième image en y
        
        
        imagecopymerge($image1, $image2, $destination_x, $destination_y, 0, 0, $largeur_image2, $hauteur_image2, 100);
        
        
        imagejpeg($image1, "copyFinal.jpeg", 100);
    }

}