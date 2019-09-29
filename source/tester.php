<?php
include_once(dirname(__FILE__) . "/include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

session_start();

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

outputHeader(true, $mysqli);

?>


<h1>Testing Page<h1>
  <?php
  echo "<h2>Add Slashes Test</h2>";
  echo "<p>".mitigate($mysqli, "addSlashes", "'It's a test string!'")."</p>";
  
  echo "<h2>Prepared Statement</h2>";
  echo "<p>No test</p>";
  
  echo "<h2>Remove Script</h2>";
  echo "<p>".mitigate($mysqli, "removeScript", "This is where the javascript is<script>alert('XSS');</script>")."</p>";
  
  echo "<h2>Illegal Charachters</h2>";
  echo "<p><em>Note:</em> An illegal charachter is anything other than a letter or a space.</p>";
  $strings = array('This is a test string',"I'm illegal", "'; DROP TABLE 'users';", 'Ten', 45);
  foreach($strings as $string){
    echo "<p>Does '<strong>".$string."</strong>' contain illegal charachters? - ". (mitigate($mysqli, "illegalChars", array($string, '/[^a-zA-Z\s]+/'))==true?"YES":"NO") ."</p>";
  }
  
  
  echo "<h2>iFrame Blocking</h2>";
  echo '<iframe src="tester.php" ></iframe>';
  
  echo "<h2>MySQLi Real Escape Strings</h2>";
  echo "<p>".mitigate($mysqli, "realEscapeString", "'It's a test string!'")."</p>";
  
  echo "<h2>Frame Blocking Legacy Test</h2>";
  echo " <iframe src=\"index.php\" /></iframe>";
  
  echo "<h2>Session Regenerate Id</h2>";
  echo "<p>Old Session Id = '".session_id()."'.</p>";
  mitigate($mysqli, "regenerateSessionId");
  echo "<p>New Session Id = '".session_id()."'.</p>";
  
  echo "<h2>Check Refer</h2>";
  echo "<p><a href=\"http://cs1.ucc.ie/~dos4/FYP_redirect.html\">cs1 redirect</a></p>";
  $reffer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"Unknown";
  echo "<p><strong>" . (mitigate($mysqli, "checkReferAddress", $reffer )?"PASS":"FAIL" . "</strong>. Request came from '".$reffer."'." ) ."</p>";
  
  

  
     #<input type="hidden" name="CSRFToken"
  
  ?>
  
  <?php
  outputFooter(true);
  $mysqli->close();
  ?>
