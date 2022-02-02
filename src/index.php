<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photoshop du pauvre</title>

    <!-- Scripts CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="style.css"></script>

    <!-- Srripts JS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.3.x/dist/index.js"></script>
   
</head>
<body class="m-0 p-0 w-full h-full">
    <div class="p-4 text-center space-y-10">
        <h1>Photoshop Low Cost</h1>
        <p>Télécharger vos deux photos pour les fusionner en une !</p>
    </div>
    <?php $upload_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>'; ?>
    <form action="upload/upload.php" method="post" class="m-10" enctype="multipart/form-data">
        <div class="flex flex-col justify-center space-y-10">
            <div class="flex flex-row justify-center space-x-4">
                <div class="flex flex-col">
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
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
                            <label for="file1">Upload votre 1ère image</label>
                            <button type="button" class="cursor bg-violet-600 hover:bg-violet-600 text-white rounded font-bold py-2 px-4 w-min inline-flex items-center space-x-2" x-on:click.prevent="$refs.photo.click()">
                                <?php echo $upload_svg ?>
                                <p>Télécharger</p>
                                <input class="cursor-pointer absolute block py-2 px-4 w-full opacity-0 pin-r pin-t">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <!-- Photo File Input -->
                        <input name="file2" type="file" class="hidden" x-ref="photo" x-on:change="
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
                            <label for="file2">Upload votre 2e image</label>
                            <button type="button" class="cursor bg-violet-600 hover:bg-violet-600 text-white rounded font-bold py-2 px-4 w-min inline-flex items-center space-x-2" x-on:click.prevent="$refs.photo.click()">
                                <?php echo $upload_svg ?>
                                <p>Télécharger</p>
                                <input class="cursor-pointer absolute block py-2 px-4 w-full opacity-0 pin-r pin-t">
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
                <button class="bg-orange-300 hover:bg-violet-600 text-white rounded font-bold py-2 px-4 w-min text-center" type="submit">Confirmer</button>
            </div>
        </div>
    </form>
</body>
</html>