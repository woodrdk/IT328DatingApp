<?php
session_start();
echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Date By Food </title>
    <!-- FAVICON -->
    <link rel=\"icon\" type=\"image/ico\" href=\"images/food.ico\">
    <!-- Bootstrap CSS -->
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
    <!-- Custom written CSS -->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/style.css\">
</head>
<body>
<nav class=\"navbar navbar-expand-lg navbar-dark\" style=\"background-color: red;\">
    <a class=\"navbar-brand font-weight-bold\" href=\"home\">Date By Food</a>
    <a class=\"navbar-brand\" href=\"home\">Home</a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\"
            data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
        <ul class=\"navbar-nav\">
            <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"/\"> </a>
            </li>
        </ul>
    </div>
</nav>";

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
echo "
    <div class='container redb rounded' id='container'>
        <h1>Upload Picture Status</h1>
        <hr>";

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $_SESSION['picName'] = basename( $_FILES["fileToUpload"]["name"]);
        echo " <button type=\"button\" class=\"btn text-center button\" onclick=\"window.location.href='summary'\">Continue</button>";
    }
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
echo "</div>";
?>