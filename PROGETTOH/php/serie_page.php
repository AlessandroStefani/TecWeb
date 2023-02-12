<?php 
require_once '../php/bootstrap.php';

$templateParams["serieInfo"] = array();
$templateParams["postSerie"] = array();
$templateParams["notifiche"] = $_GET["notifiche"];
$templateParams["tipo"] = $_GET["tipo"];
$templateParams["idTipo"] = $_GET["id"];

getInfoContent();

function getInfoContent(){
  global $dbh;
  global $templateParams;
  if($templateParams["tipo"] == "serietv"){
    $templateParams["serieInfo"] = $dbh->getSerieTvInfoByID($_GET["id"])[0];
    $templateParams["posts"] = $dbh->getPostSeriebyID($_GET["id"]);
  } else {
    if($_GET["tipo"] == "anime"){
      $templateParams["serieInfo"] = $dbh->getAnimeInfoByID($_GET["id"])[0];
      $templateParams["posts"] = $dbh->getPostAnimebyID($_GET["id"]);

    } else {
      if($_GET["tipo"] == "film"){
        $templateParams["serieInfo"] = $dbh->getFilmInfoByID($_GET["id"])[0];
        $templateParams["posts"] = $dbh->getPostFilmbyID($_GET["id"]);

      }
    }
  }
}

if(isset($_POST["notif"]) && filter_has_var(INPUT_POST, "notif")){
  $templateParams["notifiche"] = !$templateParams["notifiche"];
  // Fare una update nel db, nigga.
}

if((isset($_FILES["fileToUpload"]) && ($_FILES["fileToUpload"]["size"])) && (isset($_POST["postText"]) && strlen($_POST["postText"]))) {
  inserisciPost($_FILES["fileToUpload"], $_POST["postText"]);
} else {
  if(isset($_FILES["fileToUpload"]) && ($_FILES["fileToUpload"]["size"])){
    inserisciPost($_FILES["fileToUpload"], null);
  }
  
  if(isset($_POST["postText"]) && strlen($_POST["postText"])){
    inserisciPost(null, $_POST["postText"]);
  }
}
function inserisciPost($image, $text) {
  global $dbh;
  global $templateParams;
  $imageName = NULL;
  $author = 1;
  $date = date("Y-m-d H:i:s");
  if(isset($image)){
    $target_dir = "../img/";
    $target_file = $target_dir.basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($image["tmp_name"]);
      if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".\n";
        $uploadOk = 1;
      } else {
        //echo "File is not an image.\n";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists, it renames it.
    if (file_exists($target_file)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($target_dir.$imageName));
        $target_file = $target_dir.$imageName;
    }
    
    // Check file size
    if ($image["size"] > 5000000) {
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
      if (move_uploaded_file($image["tmp_name"], $target_file)) {
        $dbh->associaPost($dbh->insertPost($text, $date, $imageName, $author), $templateParams["idTipo"], $templateParams["tipo"]);
        // InsertPost con testo = NULL e immagine diverso da null.
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }    
  } else {
    if(isset($text)){
      $dbh->associaPost($dbh->insertPost($text, $date, $imageName, $author), $templateParams["idTipo"], $templateParams["tipo"]);
    }
  }
  echo "<meta http-equiv='refresh' content='0'>";
}

require '../html/Seriepage-form.php';
?>