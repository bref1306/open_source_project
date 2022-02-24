<?php namespace Adbl\MergePictures;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photoshop du pauvre</title>

    <!-- Scripts CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">

    <!-- Srripts JS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.3.x/dist/index.js"></script>

</head>
<body class="m-0 p-0 w-full h-full bg-stone-200">
    <div class="flex flex-row justify-center items-center p-6 text-2xl bg-white text-black drop-shadow-md">
        <div class="w-48 flex justify-center">
             <img src="assets/download.png" height="130" width="130">
        </div>
        <div>
            <h1 class="font-bold text-lg md:text-2xl text-left">Photoshop Low Cost</h1>
            <p class="text-left text-base md:text-lg">Télécharger vos deux photos pour les fusionner en une !</p>
        </div>
    </div>
    <?php $upload_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>'; ?>
    <div class="p-10">
    <form class="flex flex-col-reverse md:flex-row md:space-x-16" style="justify-content:center;" action="upload/upload.php" method="post"  enctype="multipart/form-data">
        <div class="flex flex-col justify-center space-y-10">
            <div class="flex flex-col-reverse md:flex-row md:space-x-16">
                <div class="flex flex-col">
                    <div x-data="{photoName: null, photoPreview: null}" class="flex flex-col items-center space-y-4 col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <!-- Photo File Input -->
                        <input  name="file1" type="file" class="hidden" x-ref="photo" x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        ">
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="assets/no-file.jpg" class="w-40 h-40 m-auto rounded-full shadow">
                        </div>
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <button type="button" class="w-44 flex flex-col items-center p-4 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-red-800" x-on:click.prevent="$refs.photo.click()">
                                <?php echo $upload_svg ?>
                                <p  class="text-black">Télécharger</p>
                                <input class="cursor-pointer absolute block py-2 px-4 w-min opacity-0 pin-r pin-t">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div x-data="{photoName: null, photoPreview: null}" class="flex flex-col space-y-4 items-center col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <!-- Photo File Input -->
                        <input name="file2" type="file" class="hidden" x-ref="photo" x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        ">
                        <div class="mt-2 md:shrink-0" x-show="! photoPreview">
                            <img src="assets/no-file.jpg" class="w-40 h-40 m-auto rounded-full shadow">
                        </div>
                        <div class="mt-2 md:shrink-0" x-show="photoPreview" style="display: none;">
                            <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <button type="button" class="w-44 flex flex-col items-center p-4 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-red-800" x-on:click.prevent="$refs.photo.click()">
                                <?php echo $upload_svg ?>
                                <p class="text-black">Télécharger</p>
                                <input class="cursor-pointer absolute block py-2 px-4 w-min opacity-0 pin-r pin-t">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-msg text-center text-red-700">
                <?php
                if(isset($_GET['message'])){
                    switch ($_GET['message']){
                        case $_GET['message']=="fileMissing":
                            echo "tous les fichier sont obligatoires";
                            break;
                        default :
                            echo $_GET['message'] ." non pris en charge";
                    }
                }
                ?>
            </div>
            <div class="w-full text-center">
                <button style="font-family: monospace" class="bg-orange-300 text-xl hover:bg-red-600 text-white rounded font-bold py-2 px-4 w-min text-center" type="submit">Confirmer</button>
            </div>
        </div>
    </form>
</body>
</html>
