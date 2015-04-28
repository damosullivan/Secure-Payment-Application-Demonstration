<html>
  <head>
    <link type="text/css" rel="stylesheet" href="onoffswitch.css" />
  </head>
  <body>

<?php
  $mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );
  
  
  if (isset($_GET['enable'])){
    $onlyEnable = $_GET['enable'];
    
    $sql = "update code SET state = 0 WHERE idcode > 0";##DO THEM ALL
    $result = $mysqli->query($sql);
    
    
    foreach( $onlyEnable as $name){
      $strings = "UPDATE code SET state = 1 WHERE name = '". $name."';";
      $result = $mysqli->query($strings);
    }
    
    #$result->free();
    
  }
  
  
  $sql = "SELECT * FROM code;";
  $result = $mysqli->query($sql);
  

  echo '<form id="dashboard" action="'.$_SERVER['PHP_SELF'].'" method="get" >';

  echo "<table>";
  echo "<tr><th>Name</th><th>_____State_____</th></tr>";
  while ($data = $result->fetch_assoc()){
    echo "<tr><td>".$data['name']."</td>";
    
    if($data['state'] == 0){
    #  echo "<td>".$data['state']."</td>";
    }else{
     # echo "<td>".$data['state']."</td>";
    }
    
    #name="onoffswitch"
    
    echo '<td><input type="checkbox" name="enable[]" onclick="'."document.getElementById('dashboard').submit();".'" class="onoffswitch-checkbox" id="'.$data['name'].'" ' . ($data['state'] == 0 ? '':'checked="checked"' ) .' value="'.$data['name'].'" />';
    echo '<label class="onoffswitch-label" for="'.$data['name'].'" >';
    echo '<div class="onoffswitch-inner">
            <div class="onoffswitch-active"><div class="onoffswitch-switch">ON</div></div>
            <div class="onoffswitch-inactive"><div class="onoffswitch-switch">OFF</div></div>
        </div>';
    
    
    
    
    echo '</td>';
    
    
    echo "</tr>";
    
  }
  echo "</table>";

  #echo '<input type="submit" value="Update Values" /></form>';
  echo "<p><a href=\"https://localhost/FYP/Prototype2/tester.php\">Tester.php</a></p>";
  
  
  
  
  
  $result->free();
  
  
?>

 
 
</body>
</html>

<!-- SRC - http://proto.io/freebies/onoff/ -->