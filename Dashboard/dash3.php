<?php
include_once("../include/config.php");
include_once("norm.php");
?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="onoffswitch.css" />
	<link type="text/css" rel="stylesheet" href="dash.css" />
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
<body style="background:white;" >
	<div style="width:300px;" >

		<?php
			#back to previous page. include get info??
		$mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );

		echo '<p><a href="'.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'').'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
		$overallTotal = 0;
		$overallSum = 0;

		if (isset($_GET['compliance'])) {
				#SHOW VULN's related to set complience
				#echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
			$compliance = $_GET['compliance'];
			echo '<h2>'.$compliance.' Compliance</h2>';



			$sql = "SELECT attack FROM compliance WHERE audit = '".$compliance."';";
			$result = $mysqli->query($sql);
				#get complience
				#display vulns
			echo '<table>';

			while ($vuln = $result->fetch_assoc()){
				echo '<tr><td>'.$vuln['attack'].' Vulnerability</td><td><a href="'.$_SERVER['PHP_SELF'].'?vuln='.$vuln['attack'].'" >>></a></td>';

				$sql2 = "SELECT * FROM FYP.code, attacks where idcode = code_id AND attack_name = '".$vuln['attack']."';";
				$result2 = $mysqli->query($sql2);
				$total = 0;
				$active = 0;
				while ($count = $result2->fetch_assoc()){
					$active += $count['state'];
					$overallSum += $count['state'];
					$total++;
					$overallTotal++;
				}

				$score = round( $total > 0 ? ($active / $total * 100) : 0);
				$color = "red";
				if( $score >= 80){
					$color = "lightGreen";
				}elseif ($score >= 50) {
					$color = "orange";
				}elseif ($score >= 20) {
					$color = "red";
				}

				if($total == 0){
					$color = "lightGray";
				}


				echo '<td style="background-color:'.$color.';" >'. $score . '</td></tr>';


			}
			echo '<tr><td></td><td>Average:</td><td>'.round( $overallTotal > 0 ? ($overallSum / $overallTotal * 100) : 0).'</td></tr>';
			echo '</table>';
				#vuln's will be clickable, to drill down


		}elseif (isset($_GET['vuln'])) {
				#echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
				# show attacls related to set vulns. multiple??
			$vuln = $_GET['vuln'];
				#Allow toggles..
			echo '<form id="dashboard" action="enable.php" method="get" >';
			echo '<input type="hidden" name="enable[]" value="null" />';
			echo '<h2>' . $vuln.' Controls.</h2>';
			echo "<table>";

			echo '<tr><th></th><th width="100px" ></th></tr>';

			$sql = "SELECT * FROM code WHERE idcode IN (SELECT code_id FROM attacks WHERE attack_name = '".$vuln."');";
			$result = $mysqli->query($sql);


			while ($data = $result->fetch_assoc()){
				echo "<tr><td>".$data['name']."</td>";

					# onclick="'."document.getElementById('dashboard').submit();".'"
				echo '<td><input type="checkbox" name="'.($data['state'] == 0 ? 'enable[]':'disable[]').'" onclick="window.location = \'enable.php?' . ($data['state'] == 0 ? 'enable[]':'disable[]') . '=' . $data['name'] . '\';"  class="onoffswitch-checkbox" id="'.$vuln.$data['name'].'" ' . ($data['state'] == 0 ? '':'checked="checked"' ) .' value="'.$data['name'].'" />';
				echo '<label class="onoffswitch-label" for="'.$vuln.$data['name'].'" >';
				echo '<div class="onoffswitch-inner">
				<div class="onoffswitch-active"><div class="onoffswitch-switch">ON</div></div>
				<div class="onoffswitch-inactive"><div class="onoffswitch-switch">OFF</div></div>
			</div>';
			echo '</td>';

			echo "</tr>";

		}


		echo "<table>";
		echo '</form>';



				#update then
	}elseif (isset($_GET['attack'])) {
		$attacks = $_GET['attack'];

		echo "<h2>{$attacks} Attacks</h2>";

		echo "<h3>ClickJacking <a href=\"dash3.php?vuln=Click Jacking\" >>>></a></h3>";
		echo '<p>Use of iFrames and css invisibality to trick user into carrying out unintended actions without even knowing.</p>';
		echo '<p><a href="../attacks/clickJacking.php" >Example</a></p>';

		echo "<h3>XSS (Cross-site Scripting) <a href=\"dash3.php?vuln=XSS\" >>>></a></h3>";
		echo '<p>XSS enables attackers to inject client-side script into Web pages viewed by other users.
		A cross-site scripting vulnerability may be used by attackers to bypass access controls such
		as the same origin policy.</p>';
		echo '<p><a href="#" >Example</a></p>';

				#WILL BE COMPLETLY DIFFERENT PAGE YO!
	}else{
				#default page...
				# complience   |   attackes   | table
				$sql = "SELECT DISTINCT audit FROM compliance";##DO THEM ALL
				$result = $mysqli->query($sql);
				echo '<h2>Compliance Audit</h2>';
				echo '<table>';

				while ($complience = $result->fetch_assoc()){
					echo '<tr><td>'.$complience['audit'].' Compliance</td><td><ul><li><a href="'.$_SERVER['PHP_SELF'].'?compliance='.$complience['audit'].'" >Vulnns >>></a></li>
					<li><a href="'.$_SERVER['PHP_SELF'].'?attack='.$complience['audit'].'"  >Attacks >>></a></li></ul></td></tr>';
				}

				echo '</table>';






			}



/*



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


*/



			?>


		</div>
	</body>
	</html>

<!-- SRC - http://proto.io/freebies/onoff/ -->