<?php
session_start();
  $_SESSION['auth']['user_id'] = null;
  $_SESSION['auth']['fName'] = null;
  $_SESSION['auth']['login_string'] =  null;
  $_SESSION['auth'] = null;
  
  $_SESSION = array();


session_destroy();

header( 'Location: index.php?error=logged out' ) ;

?>