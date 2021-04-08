<?php

if(isset($_POST["send"])){

    $uploadDir = 'public/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = array('jpg', 'jpeg', 'png');
    $taille_max = 2097152;

    if(!$getimagesize = getimagesize($_FILES['avatar']['tmp_name'])) {
        $erreurs[] = "Le fichier n'est pas une image valide.";
    }
    if(!in_array($extension, $extensions_ok)){
        $erreurs[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }
    if(file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $taille_max){
        $erreurs[] = "Votre fichier doit faire moins de 2M !";
    }

    if(!isset($erreurs)){
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)){
            $valid[] = "Image uploadé avec succès";
        }
        else{
            $erreurs[] = "Impossible d'uploader le fichier.";
        }
    }
}

var_dump($_POST);
echo '<br>';
var_dump($_FILES);
echo '<br>';
var_dump($erreurs);
var_dump($valid);

?>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload an image</label>
    <input type="file" name="avatar" id="imageUpload">
    <button type="submit" name="send" value="send">Send</button>
</form>




/*$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
    echo "Le fichier est valide, et a été téléchargé avec succès.\n";
}
else {
    echo "Attaque potentielle par téléchargement de fichiers.\n";
}

echo "Voici quelques informations de débogage :\n";
print_r($_FILES);
echo '<pre>';
