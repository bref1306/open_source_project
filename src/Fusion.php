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

    function __construct(?array $file1, ?array $file2, string $path) {
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
     * @param  $filename without the extension
     * return an array
     */
    public function createCopyImage($fileName){

        $files=scandir('image/');
        $filePath=null;
        $image=null;
        foreach ($files as $file){
            if($file !="." && $file !=".."){
                $fileToResize="image/".$file;
                $fileExtension=explode('.',$fileToResize);

                if($fileExtension[0]==$this->pathImage.$fileName){
                    $fileExtension=$fileExtension[1];
                    switch ($fileExtension){
                        case $fileExtension=="jpeg":
                            $image = imagecreatefromjpeg($fileToResize);
                            $filePath=$fileToResize;

                            break;

                        case $fileExtension=="png":
                            $image = imagecreatefrompng($fileToResize);
                            $filePath=$fileToResize;
                            break;

                        default :
                            $image = imagecreatefromjpg($fileToResize);
                            $filePath=$fileToResize;
                    }
                }
            }
        }

        return ['path'=>$filePath,'ressource'=>$image];
    }

    /**
     * @param array $param Datas send by post method
     */
    public function resizeImages(array $param){

         $fichier1=$this->createCopyImage("fichier1");
         $fichier2=$this->createCopyImage("fichier2");

        //copy image1
        list($widthImg1,$heightImg1)=getimagesize($fichier1['path']);
        $new_widthImg1 = $param['widthPrimary'];
        $new_heightImg1 = $param['HeightImgPrimary'];

        $sizeImg1=imagecreatetruecolor($new_widthImg1, $new_heightImg1);
        imagecopyresampled($sizeImg1,$fichier1['ressource'],0,0,0,0,$new_widthImg1,$new_heightImg1,$widthImg1,$heightImg1 );
        imagejpeg($sizeImg1,"newIm1.jpeg");

        // 2 nd image to resize
        list($width, $height) = getimagesize($fichier2['path']);
        $new_width = $param["widthSecondary"];
        $new_height = $param["HeightImgSecondary"];

        $sizeImg2=imagecreatetruecolor($new_width,$new_height);/*création taille pour la nouvelle redimension*/
        imagecopyresampled($sizeImg2,$fichier2['ressource'], 0, 0, 0, 0,$new_width,$new_height,$width,$height);
        $image2=imagejpeg($sizeImg2, "copy.jpeg", 100);


        //création image 2 avec nouvelle dimension
        // imagecopyresampled(
        //     GdImage $dst_image,
        //     GdImage $src_image,
        //     int $dst_x,
        //     int $dst_y,
        //     int $src_x,
        //     int $src_y,
        //     int $dst_width,
        //     int $dst_height,
        //     int $src_width,
        //     int $src_height
        // ): bool



        //récupération des images 1 et 2
        $image2=imagecreatefromjpeg("copy.jpeg");
        $image1 = imagecreatefromjpeg("newIm1.jpeg");

        //calcul des hauteurs et largueurs des images1 et 2

        $largeur_image2 = imagesx($image2);
        $hauteur_image2 = imagesy($image2);



        $destination_x = $param['posX']; //$largeur_image2;//position pour placer la deuxième image en x
        $destination_y = $param['posY'];//$hauteur_image2;//position pour placer la deuxième image en y

        // imagecopymerge(
        //     GdImage $dst_image,
        //     GdImage $src_image,
        //     int $dst_x,
        //     int $dst_y,
        //     int $src_x,
        //     int $src_y,
        //     int $src_width,
        //     int $src_height,
        //     int $pct
        // ): bool
        imagecopymerge($image1, $image2,$destination_x, $destination_y, 0, 0, $largeur_image2, $hauteur_image2, 100);


        imagejpeg($image1, "copyFinal.jpeg", 100);
    }

}
