<!--Source: https://www.w3schools.com/php/php_file_upload.asp-->

<?php
$target_dir = "C:/xampp/htdocs/webshop/grafical/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Das Format ist korrekt - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Dies ist kein Bild.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, das Bild existiert bereits.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, das Bild ist zu gross.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Nur JPG, JPEG, PNG & GIF Dateien sind erlaubt.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Das Bild konnte nicht hochgeladen werden.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Die Datei ". basename( $_FILES["fileToUpload"]["name"]). " wurde erfolgreich erfasst.";
    } else {
        echo "Beim Upload ging etwas schief.";
    }
}
?>