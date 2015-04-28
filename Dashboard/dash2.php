<html>
  <head>
    <link type="text/css" rel="stylesheet" href="onoffswitch.css" />
    <script language="JavaScript" >
    
    function toggle(source) {
      // Get all input elements
      //alert("XSSRemove Script".indexOf("Remove Script") != -1);
      var inputs = document.getElementsByTagName('input');
      // Loop over inputs to find the checkboxes whose name starts with `orders`
      for(var i =0; i<inputs.length; i++) {
	//alert(inputs[i].id + ' = ' + source.value + '? ' + (inputs[i].id.indexOf(source.value) != -1) );
	if (inputs[i].type == 'checkbox' && inputs[i].id.indexOf(source.value) != -1 && inputs[i].checked != source.checked) { 
	  inputs[i].checked = source.checked;
	  toggle(inputs[i]);
	}
      }
      return true;
    }
    
    
    
    </script>
    
  </head>
  <body>

<?php
  $mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );
  #source.value.indexOf(inputs[i].name) === 0)
  
  if (isset($_GET['enable'])){
    $onlyEnable = $_GET['enable'];
    
    $sql = "update code SET state = 0 WHERE idcode > 0";##DO THEM ALL
    $result = $mysqli->query($sql);
    
    
    foreach( $onlyEnable as $name){
      #echo $name."<br />";
      $strings = "UPDATE code SET state = 1 WHERE name = '". $name."';";
      $result = $mysqli->query($strings);
    }
    
    #$result->free();
    
  }
  
   echo '<form id="dashboard" action="'.$_SERVER['PHP_SELF'].'" method="get" >';
   echo '<input type="hidden" name="enable[]" value="null" />';
    echo "<table>";
    #echo "<tr><th>Name</th><th>_____State_____</th></tr>";
    
    
  #SELECT DISTINCT attack_name FROM FYP.attacks;
  #$sql = "SELECT DISTINCT attack_name FROM FYP.attacks;";
  $sql = 'SELECT attack1 as attack_name, total, active FROM (
SELECT * FROM (SELECT attack_name as attack1, COUNT(*) as total FROM FYP.attacks GROUP BY attack1 ) as total
LEFT JOIN (SELECT COUNT(*) as active, attack_name as attack2 FROM FYP.code, FYP.attacks WHERE idcode = code_id AND state = 1 GROUP BY attack2 ) as active
ON attack1 = attack2
) as result ORDER BY attack_name DESC';
  $result_attacks = $mysqli->query($sql);
  while ($data_attacks = $result_attacks->fetch_assoc()){
   
   #echo "<tr><th>".$data_attacks['attack_name']. " Attack</th><td width=\"100px\"><input type=\"checkbox\" name=\"enable[]\" onclick=\"document.getElementById('dashboard').submit(toggle(this));\" class=\"onoffswitch-checkbox\" id=\"".$data_attacks['attack_name']."\" value=\"".$data_attacks['attack_name']."\" /></td></tr>";
   echo "<tr><th>".$data_attacks['attack_name'].'  Attack</th><th width="110px"><input type="checkbox" onclick="document.getElementById(\'dashboard\').submit(toggle(this));" id="'.$data_attacks['attack_name'].'" value="'.$data_attacks['attack_name'].'" name="'.$data_attacks['attack_name'].'" class="onoffswitch-checkbox" '.($data_attacks['total'] == $data_attacks['active'] ? 'checked="checked"':'' ).' />';
   echo '<label class="onoffswitch-label" for="'.$data_attacks['attack_name'].'" >';
      echo '<div class="onoffswitch-inner">
	      <div class="onoffswitch-active"><div class="onoffswitch-switch">ALL ON</div></div>
	      <div class="onoffswitch-inactive"><div class="onoffswitch-switch">ALL OFF</div></div>
	  </div>';
      echo '</th></tr>';
   #$data['attack_name']
     #	SELECT * FROM code WHERE idcode IN (SELECT code_id FROM attacks WHERE attack_name = 'XSS')
    $sql = "SELECT * FROM code WHERE idcode IN (SELECT code_id FROM attacks WHERE attack_name = '".$data_attacks['attack_name']."');";
    $result = $mysqli->query($sql);
    
    
   

    
    while ($data = $result->fetch_assoc()){
      echo "<tr><td>".$data['name']."</td>";
      
      # onclick="'."document.getElementById('dashboard').submit();".'"
      echo '<td><input type="checkbox" name="enable[]" onclick="'."document.getElementById('dashboard').submit(toggle(this));".'" class="onoffswitch-checkbox" id="'.$data_attacks['attack_name'].$data['name'].'" ' . ($data['state'] == 0 ? '':'checked="checked"' ) .' value="'.$data['name'].'" />';
      echo '<label class="onoffswitch-label" for="'.$data_attacks['attack_name'].$data['name'].'" >';
      echo '<div class="onoffswitch-inner">
	      <div class="onoffswitch-active"><div class="onoffswitch-switch">ON</div></div>
	      <div class="onoffswitch-inactive"><div class="onoffswitch-switch">OFF</div></div>
	  </div>';
      echo '</td>';
      
      echo "</tr>";
      
    }
    

    #onclick="'."toggle(this)".'" 
   
    
    
    
  
  
  $result->free();
  


  
  
  }
  
  echo '<tr><th>Everything!</th><th> <input type="checkbox" id="every" name="every" value="" onclick="toggle(this);" class="onoffswitch-checkbox" />';
   echo '<label class="onoffswitch-label" for="every" >';
      echo '<div class="onoffswitch-inner">
	      <div class="onoffswitch-active"><div class="onoffswitch-switch">EVERY</div></div>
	      <div class="onoffswitch-inactive"><div class="onoffswitch-switch">EVERY</div></div>
	  </div>';
      echo '</th></tr>';
  
  echo "</table>";
  echo '<input type="submit" value="Update Values" /></form>';
    echo "</form>";
  
   echo "<p><a href=\"https://localhost/FYP/Prototype2/tester.php\">Tester.php</a></p>";
  
  
  

  
  
?>

 
 
</body>
</html>

<!-- SRC - http://proto.io/freebies/onoff/ -->