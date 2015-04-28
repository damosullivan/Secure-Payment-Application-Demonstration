<?php
include_once("../include/config.php");
include_once("norm.php");
?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="onoffswitch.css" />
	<link type="text/css" rel="stylesheet" href="dash.css" />
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
<body style="background:#F2F2F2;" >
	<div style="width:299px;" >

		<?php
			#back to previous page. include get info??
		$mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );

		$back = "#";
		if( isset($_SERVER["REQUEST_URI"]) ){
			$back = $_SERVER["REQUEST_URI"];
			$regex = "#&[\w\n%]*=[\w\n%&]*$#";
			$back = preg_replace($regex, "", str_replace("?", "&", $back) );
			$count = 1;
			$back = str_replace("&", "?", $back, $count);
		}
		


		echo '<p><a href="'.$back.'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
		$overallSeverity = array();

		if ( isset($_GET['vuln']) && isset($_GET['compliance'] ) ) {
				#echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
				# show attacls related to set vulns. multiple??
			$vuln = $_GET['vuln'];
			$compliance = $_GET['compliance'];
				#Allow toggles..
			echo '<form id="dashboard" action="enable.php" method="get" >';
			echo '<input type="hidden" name="enable[]" value="null" />';
			echo '<input type="hidden" name="compliance" value="'.$compliance.'" />';
			echo '<input type="hidden" name="vuln" value="'.$vuln.'" />';
			echo '<h2>' . $vuln.' Controls.</h2>';
			echo "<table class=\"table\" >";

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
				<div class="onoffswitch-inactive"><div class="onoffswitch-switch">OFF</div></div></div>';
				echo '</td>';

				echo "</tr>";

			}


			echo "</table>";
			echo '</form>';



#update then
		}elseif (isset($_GET['compliance'])) {
				#SHOW VULN's related to set complience
				#echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" ><< Back</a> | <a href="'.$_SERVER['PHP_SELF'].'" >Home</a></p>';
			$compliance = $_GET['compliance'];
			echo '<h2>'.$compliance.' Compliance</h2>';



			$sql = "SELECT attack FROM compliance WHERE audit = '".$compliance."';";
			$result = $mysqli->query($sql);
				#get complience
				#display vulns
			echo '<table class="table" >';

			while ($vuln = $result->fetch_assoc()){
				echo '<tr><td>'.$vuln['attack'].' Vulnerability</td><td><a href="'.$_SERVER['PHP_SELF'].'?compliance='.$compliance.'&vuln='.$vuln['attack'].'" >>></a></td>';

				$sql2 = "SELECT * FROM FYP.code, attacks where idcode = code_id AND attack_name = '".$vuln['attack']."';";
				$result2 = $mysqli->query($sql2);

				$severity = array();
				while ($count = $result2->fetch_assoc()){


					$severity[] = $count['state'] == 1 ? $count['enabledSeverity'] : $count['disabledSeverity'];


				}

				#$score = round( $total > 0 ? ($active / $total * 100) : 0);
				$score = calculateNorm(implode("+", $severity));
				$overallSeverity[] = $score;


				$color = "red";
				$boot = '';
				if( $score >= 0.8){
					$color = "red";
					$boot = 'class="bg-danger"';
				}elseif ($score >= 0.5) {
					$color = "orange";
					$boot = 'class="bg-warning"';
				}elseif ($score >= 0.2) {
					$color = "yellow";
					$boot = 'class="bg-info"';
				}else{
					$color = "lightGreen";
					$boot = 'class="bg-success"';
				}
				if(count($severity) == 0){
					$color = "lightGray";
					$boot = '';
				}




				#echo '<td style="background-color:'.$color.';" >'. number_format((float)$score, 3, '.', '') . '</td></tr>';
				echo '<td '.$boot.' >'. number_format((float)$score, 3, '.', '') . '</td></tr>';


			}
			$old =  count($overallSeverity) > 0 ? number_format((float)(calculateNorm(implode("+", $overallSeverity))), 3, '.', '') : 0 ;
			$avg = array_sum($overallSeverity) / (count($overallSeverity)>0?count($overallSeverity):1); # average!!
			echo '<tr><td></td><td>Average:</td><td>'.$avg.'</td></tr>';
			echo '<tr><td></td><td>Norm:</td><td>'.$old.'</td></tr>';
			echo '</table>';
#vuln's will be clickable, to drill down


		}elseif (isset($_GET['attack'])) {
			#$attacks = $_GET['attack'];
		

		
			?>

			<h2>Attacks</h2>

			<h3>CSRF</h3>
			<p>Using 'GET' requests to carry out actions. You can 
			link the user to directly execute these requests. They won't know it is done, until it is too late.</p>
			<p><a href="../attacks/CSRF.php" >Example</a></p>

			<h3>SQL Injection</h3>
			<p>Exploiting vulnerabilities to Injecting harmful code into databases,  or tampering with  stored values, tables or databases</p>
			<p><a href="../attacks/SQLInjection.php" >Example</a></p>

			<h3>XSS</h3>
			<p>Embedding <strong>malacious</strong> scripts into data fields where other users will be viewing and as a 
			result <strong>executing</strong> theses scripts</p>
			<p><a href="../attacks/XSS.php" >Example</a></p>

			<h3>Click Jacking</h3>
			<p>Use of <strong>iFrames</strong> and css invisibality to trick user into carrying out unintended actions without even knowing.</p>
			<p><a href="../attacks/clickJacking.php" >Example</a></p>

			<!--
			<h3>Path Traversal</h3>
			<p>Exploiting <strong>file upload</strong> fields and file names to gain access to private/confidental files</p>
			<p><a href="../attacks/pathTraversal.php" >Example</a></p>
			-->
			
			<h3>Session Fixation</h3>
			<p>Forcing a user to use a <strong>session id</strong> known or set by an evil user trying to do hard</p>
			<p><a href="../attacks/sessionFixation.php" >Example</a></p>







			<?php
				
		}else{
				#default page...
				# complience   |   attackes   | table
				$sql = "SELECT DISTINCT audit FROM compliance";##DO THEM ALL
				$result = $mysqli->query($sql);
				echo '<h2>Compliance Audit</h2>';
				echo '<table class="table" >';

				while ($complience = $result->fetch_assoc()){
					echo '<tr><td>'.$complience['audit'].' Compliance</td><td><ul><li><a href="'.$_SERVER['PHP_SELF'].'?compliance='.$complience['audit'].'" >Vulnns >>></a></li>
					<li><a href="'.$_SERVER['PHP_SELF'].'?attack='.$complience['audit'].'"  >Attacks >>></a></li>';

					$sql = "SELECT attack FROM compliance WHERE audit = '".$complience['audit']."';";
					$resultInner = $mysqli->query($sql);

					while ($vuln = $resultInner->fetch_assoc()){

						$sql2 = "SELECT * FROM FYP.code, attacks where idcode = code_id AND attack_name = '".$vuln['attack']."';";
						$result2 = $mysqli->query($sql2);

						$severity = array();
						while ($count = $result2->fetch_assoc()){


							$severity[] = $count['state'] == 1 ? $count['enabledSeverity'] : $count['disabledSeverity'];


						}
						$score = calculateNorm(implode("+", $severity));
						
						$overallSeverity[] = $score;

					}
					$whatIwant = ( count($overallSeverity) > 0 ? number_format((float)(calculateNorm(implode("+", $overallSeverity))), 3, '.', '') : 0 );
					$whatIwant = array_sum($overallSeverity) / (count($overallSeverity)>0?count($overallSeverity):1); # average!!
					$color = "red";
					$boot = '';
					if( $whatIwant >= 0.75){
						$color = "red";
						$boot = 'class="bg-danger"';
					}elseif ($whatIwant >= 0.45) {
						$color = "orange";
						$boot = 'class="bg-warning"';
					}elseif ($whatIwant >= 0.2) {
						$color = "yellow";
						$boot = 'class="bg-info"';
					}else{
						$color = "lightGreen";
						$boot = 'class="bg-success"';
					}
					
					echo '<li '.$boot.' >'.$whatIwant."</li></ul></td></tr>";

				}

				echo '</table>';






			}


			?>


	</div>
</body>
</html>

	<!-- SRC - http://proto.io/freebies/onoff/ -->





<!-- 


				/*
low
intermediate-1
intermediate-2
high

89
80 - 89
61 - 79
< 61

Category 5 (Very Severe) 
Highly dangerous threat type, very difficult to contain
 
Category 4 (Severe) 
Dangerous threat type, difficult to contain.
 
Category 3 (Moderate) 
Threat type characterized either as highly Wild (but reasonably harmless and containable) or potentially 
dangerous (and uncontainable) if released into the wild.
 
Category 2 (Low) 
Threat type characterized either as low or moderate Wild threat (but reasonably harmless and containable) 
or non-Wild threat characterized by an unusual Damage or spread routine or perhaps by some feature of the 
virus that makes headlines.
 
Category 1 (Very Low) 
Poses little threat to users. Rarely even makes headlines.


*/ -->