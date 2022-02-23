<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redimensioner mon image</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
</head>
<body>
<div style="float: left;width: 400px">
    <form id="formulaireImg">
        <div>
            <label>Largueur image principale</label>
            <input id="image1" value="500" name="widthPrimary" onchange="setPosImg(this.value)" placeholder="initial : 500px"><br>
            <input type="hidden" id="HeightImgPrimary" value="0" name="HeightImgPrimary">
            <label>Largueur image à superposer</label>
            <input id="image2" value="50" name="widthSecondary" onchange="setPosImgSuperpose(this.value)" placeholder="initial : 50px">
            <input type="hidden" id="HeightImgSecondary" value="0" name="HeightImgSecondary">
        </div>

        <div style="margin-top: 50px">
            <h2>Position 2e image à superposer</h2>
            <label>positionX</label>
            <input type="number" min="0" id="largeur" name="posX" value="0" onchange="setPosImgSecondary()" placeholder="initial : 0"><br>
            <label>positionY</label>
            <input type="number" min="0" id="hauteur" value="0" name="posY" onchange="setPosImgSecondary()" placeholder="initial : 0">
        </div>
    </form>
</div>

<div style="float: left;">
    <div style="position: relative;border: 1px solid red;width: 500px" id="apercu">
        <!-- DonT FORGET TO REPLACE .JPEG -->
        <img src="image/fichier1.jpeg" id="img1" style="width: 100%">
        <img src="image/fichier2.jpeg" id="img2" style="width: 50px;position: absolute;top: 0;left:0">
    </div>
    <button id="sauvegarder" style="margin-top: 100px">Télécharger</button>
    <div id="messageResponse">
    </div>
</div>
<?php 
if(!empty($ok)) {
    ?>
        <a download="custom-filename.jpg" href="/path/to/image" title="ImageName">
            test
        </a>
    <?php
}
?>



<script>
        function setPosImgSecondary() {
            let posX = document.getElementById("largeur");
            let posY = document.getElementById("hauteur");

            if ((posX.value === "") || (posY.value === "") || (posX.value >= 0 && posY.value >= 0)) {
                if (posX.value == "") {
                    posX.value = 0;
                }
                if (posY.value == "") {
                    posY.value = 0;
                }
                jQuery("#img2").css("left", posX.value);
                jQuery("#img2").css("top", posY.value);
            }
        }

        //set input hidden for both images heigth
        function setHeight(){
            let element1=document.getElementById("img1").clientHeight;
            let element2 = document.getElementById("img2").clientHeight;

            jQuery('#HeightImgPrimary').val(element1);
            jQuery('#HeightImgSecondary').val(element2);
        }

        //display primary image width  onchange
        function setPosImg(value){
            if(value>0){
                jQuery('#img1').css('width',value);
                jQuery('#apercu').css('width',value);
            }
            else{
                jQuery('#image1').val(document.getElementById("img1").clientWidth);
            }


        }
        //display secondary  image width  onchange
        function setPosImgSuperpose(value){
            if(value>0){
                jQuery('#img2').css('width',value);
            }
            else{
                jQuery('#image2').val(document.getElementById("img2").clientWidth);
            }

        }

        //sauvegarder image TODO
        jQuery("#sauvegarder").click(()=>{
            //TODO controle si image bien positionné et non en dehors du cadre
            if(jQuery("#largeur").val()>=0 && jQuery("#hauteur").val()>=0){
                setHeight();
                jQuery.post("upload.php",jQuery("#formulaireImg").serialize(), function(data){
                    jQuery("#apercu").css('width',data+"px");
                    console.log(data);
                    // add the image if is ok 
                },'json');
            }
            else{
            }
        })
</script>

</body>
</html>

