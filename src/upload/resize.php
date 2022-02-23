<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Redimensioner mon image</title>
</head>
<body class="m-0 p-0 w-full h-full bg-stone-200">
<div class="flex flex-row justify-center items-center p-6 text-2xl bg-white text-black drop-shadow-md">
    <div class="w-48 flex justify-center">
        <img src="../assets/download.png" height="130" width="130">
    </div>
    <div>
        <h1 class="font-bold text-2xl text-left">Photoshop Low Cost</h1>
        <p class="text-left">Paramétrez vos images</p>
    </div>
</div>
<div class="p-10">
    <div class="flex flex-row space-x-16">
        <div class="w-1/2">
            <div class="relative" id="apercu">
                <?php require '../Fusion.php'; ?>
                <img src="<?php Fusion::getPathFile("fichier")?>" id="img1" style="width: 100%">
                <img src="<?php Fusion::getPathFile("fichier")?>" id="img2" style="width: 50px;position: absolute;top: 0;left:0">
            </div>
            <div id="messageResponse"></div>
        </div>
        <div class="w-1/2 space-y-2">
            <div class="flex flex-row rounded-xl space-x-3 p-2 w-max items-center content-center align-middle">
                <div class="rounded-full bg-white p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <p class="font-semibold text-lg">Taille des images</p>
            </div>
            <form id="formulaireImg">
                <div class="flex flex-row w-full space-x-16">
                    <div clas="flex flex-col">
                        <label class="mb-8">Largueur image n°1</label>
                        <input id="image1" value="500" class="appearance-none block w-full text-gray-700 border p-2 rounded-xl" name="widthPrimary" onchange="setPosImg(this.value)" placeholder="initial : 500px"><br>
                        <input type="hidden" id="HeightImgPrimary" value="0" name="HeightImgPrimary">
                    </div>
                    <div clas="flex felx-col">
                        <label class="mb-8">Largueur image n°2</label><br>
                        <input id="image2" value="50" class="appearance-none block w-full text-gray-700 border p-2 rounded-xl" name="widthSecondary" onchange="setPosImgSuperpose(this.value)" placeholder="initial : 50px">
                        <input type="hidden" id="HeightImgSecondary" value="0" name="HeightImgSecondary">
                    </div>
                </div>
                <hr class="h-0.5 bg-gray-300 rounded-xl my-2">
                <div class="space-y-4">
                    <div class="flex flex-row rounded-xl space-x-3 p-2 w-max items-center content-center align-middle">
                        <div class="rounded-full bg-white p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                            </svg>
                        </div>
                        <p class="font-semibold text-lg">Position de la 2e image</p>
                    </div>
                    <div class="flex flex-row space-x-16">
                        <div>
                            <label class="mb-8">Position X</label>
                            <input class="appearance-none block w-full text-gray-700 p-2 rounded-xl" type="number" min="0" id="largeur" name="posX" value="0" onchange="setPosImgSecondary()" placeholder="initial : 0">
                        </div>
                        <div>
                            <label class="mb-8">Position Y</label>
                            <input class="appearance-none block w-full text-gray-700 p-2 rounded-xl" type="number" min="0" id="hauteur" value="0" name="posY" onchange="setPosImgSecondary()" placeholder="initial : 0">
                        </div>
                    </div>
                </div>
            </form>

            <button id="sauvegarder" class="bg-black hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">Télécharger</button>
        </div>
    </div>
</div>
<script>
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
                //jQuery("#apercu").css('width',data+"px");
                console.log(data);
            },'json');
        }
        else{
        }
    })
</script>
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
            jQuery("#img2").css("top", posX.value);
            jQuery("#img2").css("left", posY.value);
        }
    }
</script>
</body>
</html>
