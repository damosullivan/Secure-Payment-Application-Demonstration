<?php
  require_once("../mitigate.php");
  include_once("../include/config.php");
?>

<html>
<head>
	 <title>Hello</title>
		<?php
		
		echo mitigate('frameBlock');
		
		
		?>
</head>
<body>
  <h1>Testing Page<h1>
  <?php
    echo "<h2>Add Slashes Test</h2>";
    echo "<p>".mitigate("addSlashes", "It's a test string!")."</p>";
  
    echo "<h2>Prepared Statement</h2>";
    echo "<p>No test</p>";
    
    echo "<h2>Remove Script</h2>";
    echo "<p>".mitigate("removeScript", "This is where the javascript is<script>alert('XSS');</script>")."</p>";
  
    echo "<h2>Illegal Charachters</h2>";
    $string = "ted";
    echo "<p>".$string." - ". (mitigate("illegalChars", array($string, '/[^a-zA-Z]+/')))==true?"YES":"NO" ."</p>";
    
    echo "<h2>Hummmm</h2>";
    echo (eval ('return false;'))?"humm":"mmuh";
    $str = mitigate("illegalChars", array($string, '/[^a-zA-Z]+/'));
    echo $str;
    
    echo "<h2>iFrame Blocking</h2>";
    echo '<iframe src="tester.php" ></iframe>';
  
    echo "<h2>Frame Blocking Legacy Test</h2>";
    echo "<code>".mitigate("frameBlockingLegacy")."</code>";
    
    echo HOST;
  ?>


</body>

</html>