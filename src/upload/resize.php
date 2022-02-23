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
<?php include('../components/header.php')?>
<div class="p-10">
    <div class="flex flex-col-reverse md:flex-row md:space-x-16">
        <div class="flex w-full justify-center items-center md:w-1/2 md:mb-0 bg-white px-2 pb-2 rounded-xl mt-6">
            <div class="flex h-full flex-col justify-between items-center my-6">
                <div class="flex flex-row rounded-xl space-x-3 p-2 w-max items-center">
                    <div class="rounded-full bg-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-lg">Rendu en direct</p>
                </div>
                <div class="relative" id="apercu">
                    <?php require '../Fusion.php'; ?>
                    <img src="<?php echo Fusion::getPathFile("fichier1")?>" id="img1">
                    <img src="<?php echo Fusion::getPathFile("fichier2")?>" id="img2" style="width: 50px;position: absolute;top: 0;left:0">
                </div>
                <div id="messageResponse"></div>
            </div>
        </div>
        <div class="md:w-1/2 flex flex-col justify-center items-center">
            <form id="formulaireImg">
                <div class="flex flex-row rounded-xl space-x-3 p-2 w-max items-center content-center align-middle">
                    <div class="rounded-full bg-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <p class="font-semibold text-lg">Taille des images</p>
                </div>
                <div class="flex flex-row w-full space-x-16">
                    <div clas="flex flex-col">
                        <div class="mb-2">Image n°1</div>
                        <input id="image1" value="500" class="appearance-none block w-full text-gray-700 border p-2 rounded-xl" name="widthPrimary" onchange="setPosImg(this.value)" placeholder="initial : 500px"><br>
                        <input type="hidden" id="HeightImgPrimary" value="0" name="HeightImgPrimary">
                    </div>
                    <div clas="flex felx-col">
                        <div class="mb-2">Image n°2</div>
                        <input id="image2" value="50" class="appearance-none block w-full text-gray-700 border p-2 rounded-xl" name="widthSecondary" onchange="setPosImgSuperpose(this.value)" placeholder="initial : 50px">
                        <input type="hidden" id="HeightImgSecondary" value="0" name="HeightImgSecondary">
                    </div>
                </div>
                <hr class="h-0.5 bg-gray-300 rounded-xl my-2 w-full">
                <div class="space-y-4 mb-6" >
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
                            <div class="mb-2">Position X</div>
                            <input class="appearance-none block w-full text-gray-700 p-2 rounded-xl" type="number" min="0" id="largeur" name="posX" value="0" onchange="setPosImgSecondary()" placeholder="initial : 0">
                        </div>
                        <div>
                            <div class="mb-2">Position Y</div>
                            <input class="appearance-none block w-full text-gray-700 p-2 rounded-xl" type="number" min="0" id="hauteur" value="0" name="posY" onchange="setPosImgSecondary()" placeholder="initial : 0">
                        </div>
                    </div>
                </div>
            </form>

            <button id="sauvegarder" class="flex flex-row space-x-2 bg-black hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full"  style="cursor: pointer">
                <a id="downloadLink" download></a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-base">Télécharger</p>

            </button>
        </div>

    </div>
    <div id="link_DL"></div>
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
        if(value > 0){
            jQuery('#img1').css('width',value);
            jQuery('#apercu').css('width',value);
        }
        if(value > 728) {
            jQuery('#img1').css('width', 600);
            jQuery('#apercu').css('width', 600);
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

    let linkDl={ elemnt:document.getElementById('downloadLink'),  ready:false }

    jQuery("#sauvegarder").click(()=>{

        //auto width for primary Image
        (function(){
            jQuery('#image1').val(document.getElementById("img1").clientWidth);
        })();


        if(jQuery("#largeur").val()>=0 && jQuery("#hauteur").val()>=0){
            setHeight();
            jQuery.post("upload.php", jQuery("#formulaireImg").serialize(), function(data){

            })
            .done(function(data) {
                //console.log(data)
                linkDl.elemnt.setAttribute("href","http://localhost/WEB_MDS/open_source_project/src/upload/image/copyFinal.jpeg");
                linkDl.ready=true;

                //setTimeout(function () { window.location = data; }, 100)
                //buffer
                setTimeout(()=>{}, 1000)

            })
            .fail(function(data) {
                $("#link_DL").html("GROSSE ERREUR T TRO NUL LOL")
            })
        }
        else{
        }

        if(linkDl.ready===true) linkDl.elemnt.click();

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
            jQuery("#img2").css("left", posX.value);
            jQuery("#img2").css("top", posY.value);
        }
    }
</script>
</body>
</html>
