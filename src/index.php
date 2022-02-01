<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Fusion d'images</title>
</head>
<body>
    <h1>Photoshop Low Cost</h1>
    <form action="upload/upload.php">
        <div class="flex flex-col justify-center">
            <div class="flex flex-row justify-center space-x-4">
                <div class="flex flex-col">
                    <label for="file">Upload votre 1ère image</label>
                    <input name="file" type="file">
                </div>
                <div class="flex flex-col">
                    <label for="file2">Upload votre 2e image</label>
                    <input name="file2" type="file">
                </div>
            </div>
            <button type="submit">Confirmer</button>
        </div>
    </form>
</body>
</html>