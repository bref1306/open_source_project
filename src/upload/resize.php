<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div style="float: left;width: 400px">
    <div>
        <form id="formulaireImg">
            <label>Largueur image principale</label>
            <input id="image1" value="" name="image1" onchange="setPosImg(this.value)" placeholder="initial : 500px"><br>
            <label>Largueur image à superposer</label>
            <input id="image2" value="" name="image2" onchange="setPosImgSuperpose(this.value)" placeholder="initial : 50px">
            <input type="hidden" id="apercuHeight" value="" name="apercuHeight">
        </form>
    </div>

    <div style="margin-top: 50px">
        <h2>Position 2e image à superposer</h2>
        <label>positionX</label>
        <input type="number" min="0" id="largeur" value="" onchange="getPosX()" placeholder="initial : 0"><br>
        <label>positionY</label>
        <input type="number" min="0" id="hauteur" value="" onchange="getPosX()" placeholder="initial : 0">
    </div>
</div>

<div  style="float: left;">
    <div style="position: relative;border: 1px solid red;width: 500px" id="apercu">
        <img src="image/fichier1" id="img1"style="width: 100%">
        <img src="image/copy" id="img2" style="width: 50px;position: absolute;top: 0;left:0">
    </div>
    <button id="sauvegarder" style="margin-top: 100px">Télécharger</button>
    <div id="messageResponse">

    </div>
</div>


<script>
    function setPosImg(value){
        if(value!=0){
            jQuery('#img1').css('width',value);
            jQuery('#apercu').css('width',value);
        }

    }

    function setPosImgSuperpose(value){
        if(value!=0)
            jQuery('#img2').css('width',value);
    }

    //sauvegarder image TODO
    jQuery("#sauvegarder").click(()=>{

        jQuery.post("createImage.php",jQuery("#formulaireImg").serialize(), function(data){
            //jQuery("#apercu").css('width',data+"px");
            console.log(data);
        })
    })

</script>

<script>
    let largeur=document.getElementById("largeur");
    let hauteur=document.getElementById("hauteur");
    let btn=document.getElementById("validate");
    let img=document.getElementById("img2");

    //default image position
    //img.style+="position: absolute;top:0; left:0";


    function getPosX(){
        let posX=document.getElementById("largeur");
        let posY=document.getElementById("hauteur");

        if(posX.value!="" && posY.value !="" && (posX.value >=0 && posY.value>=0) ){
            if(posX.value==""){
                posX.value=0;
            }
            if(posY.value==""){
                posY.value=0;
            }
            else{
                //img.style+="position: absolute; top:"+posX.value+"px; left:"+posY.value+"px";
                jQuery("#img2").css("top",posX.value);
                jQuery("#img2").css("left",posY.value);
            }
        }

    }
</script>

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

list($width, $height) = getimagesize($fileToResize);
$new_width = 50 ;
$new_height = 50 ;

$imgSize=imagecreatetruecolor($new_width,$new_height);/*création taille pour la nouvelle redimension*/

//création image 2 avec nouvelle dimension
imagecopyresampled($imgSize,$source, 0, 0, 0, 0,$new_width,$new_height,$width,$height);
$image2=imagejpeg($imgSize, __DIR__."/image/copy.jpeg", 100);

//récupération des images 1 et 2
$image2=imagecreatefromjpeg(__DIR__."/image/copy.jpeg");
$image1 = imagecreatefromjpeg(__DIR__."/image/fichier1.jpeg");

//calcul des hauteurs et largueurs des images1 et 2

$largeur_image2 = imagesx($image2);
$hauteur_image2 = imagesy($image2);

$largeur_image1 = imagesx($image1);
$hauteur_image1 = imagesy($image1);

/*ATTENTION il faudra remplacer le 100 et 200 par les positions choisi par l'utilisateur*/

$destination_x = $largeur_image1 - 200;//position pour placer la deuxième image en x
$destination_y = $hauteur_image1 - 200;//position pour placer la deuxième image en y

//fusion des images
imagecopymerge($image1, $image2, $destination_x, $destination_y, 0, 0, $largeur_image2, $hauteur_image2, 100);
imagejpeg($image1, __DIR__."/image/copyFinal.jpeg", 100);

//echo "<img src='copyFinal.jpeg' style='width=100%'>";