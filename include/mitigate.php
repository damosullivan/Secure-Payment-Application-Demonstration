<?php



function mitigate($mysqli, $name, $args = null){
  #$mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );
  $sql = "SELECT * FROM code WHERE name = '".$name."';";
  $result = "Uh, Oh.";
  if($result = $mysqli->query($sql)){
    $row = $result->fetch_assoc();
    if($row['state'] == 1){
      $result = eval($row['onCode']);
    }else{
      $result = eval($row['offCode']);
    }
    #$result->close();
  }else{
    "Error with '" . $name . "'. Perhaps it's not in Database?";
  }
  #$mysqli->close();
  #echo "<p>Did I return?</p>";
  return $result;

}

function mitigateBool($mysqli, $name){
  #$mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );
  $sql = "SELECT * FROM code WHERE name = '".$name."';";
  if($result = $mysqli->query($sql)){
    $row = $result->fetch_assoc();
    if($row['state'] == 1){
      return true;
    }else{
      return false;
    }
  }else{
    echo "Error with '" . $name . "'. Perhaps it's not in Database?";
  }
  #$mysqli->close();
  #echo "<p>Did I return?</p>";
  return false;

}

function debug($message, $die = false){
  $debugging = true;
  if($debugging){
    if($die){
      die($message);
    }else{
      echo "<p>Debug: '".$message."'</p>";
    }  
  }
}

?>