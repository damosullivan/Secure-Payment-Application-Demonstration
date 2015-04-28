<?php
  include_once("../include/config.php");
  #$name = $_POST['file'];
  
  var_dump($_FILES);
  
  
  
  if(move_uploaded_file ( $_FILES['file']['tmp_name'] , "hi.jpg")){
      //echo $ext = pathinfo( (IMG_DIR . "." .  $_FILES['file']['name']) , PATHINFO_EXTENSION);
      echo "pass";
  }else{
    echo "FAILED!";
  }



?>