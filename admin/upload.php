<?php

$ds  = DIRECTORY_SEPARATOR;

// foldername
$storeFolder = $_POST['folder_name'];
if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $random_file = rndStr().$_FILES['file']['name'];
    $targetFile =  $targetPath. $random_file;
    $imagePath =$random_file;


    // check filename inside folder
    if (file_exists($targetFile)) {
      echo "file name exist";
    }else{
      move_uploaded_file($tempFile,$targetFile);
      echo $imagePath;
    }
}
function rndStr(){
  $characters = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
  
  //generate 6 characters from it 
  $charI = rand(0,25);
  $charII = rand(0,25);
  $charIII = rand(0,25);
  $charIV = rand(0,25);
  $charV = rand(0,25);
  $charVI = rand(0,25);
  
  //output as string
  $rnd_name = $characters[$charI].$characters[$charII].$characters[$charIII].$characters[$charIV].$characters[$charV].$characters[$charVI] ; 
  return $rnd_name;
  }
?>
