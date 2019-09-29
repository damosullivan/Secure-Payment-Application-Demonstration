<?php

function hashPass($pass, $salt = null, $iterator  = null){
	if($salt == null){
	  $salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
	}
	if($iterator == null){
	  $iterator = rand(10, 99);//iterate hash this many 
	}
	
			  
	for( $i = 0; $i < $iterator; $i++ ){
		$pass = hash("sha256", $salt.$pass );
	}
			  
	return $salt . ":" . $iterator . ":" . $pass;
			  			  
}


function comaprePassword($dbPassword, $pass){
	
		list($salt, $iterator, $storedHashedPassword) = explode(":", $dbPassword);
		
		$hashedPassword = hash("sha256", $salt.$pass );
			  
	for( $i = 0; $i < ($iterator - 1); $i++ ){
		$hashedPassword = hash("sha256", $salt.$hashedPassword );
	}
				  
			  
	return $hashedPassword == $storedHashedPassword;
	

}

function truncateCard($card){
	$length = strlen($card);
	
	$last4 = substr($card, -4);
	
	$truncated = preg_replace("/[^\s]/","*",$card);
	
	$result = substr($truncated, 0, -4) . $last4;
	
	return $result;
}

function fnEncrypt($sValue, $sSecretKey)
{
	return rtrim(
		base64_encode(
			mcrypt_encrypt(
				MCRYPT_RIJNDAEL_256,
				$sSecretKey, $sValue, 
				MCRYPT_MODE_ECB, 
				mcrypt_create_iv(
					mcrypt_get_iv_size(
						MCRYPT_RIJNDAEL_256, 
						MCRYPT_MODE_ECB
					), 
					MCRYPT_RAND)
				)
			), "\0"
		);
}

function fnDecrypt($sValue, $sSecretKey)
{
	return rtrim(
		mcrypt_decrypt(
			MCRYPT_RIJNDAEL_256, 
			$sSecretKey, 
			base64_decode($sValue), 
			MCRYPT_MODE_ECB,
			mcrypt_create_iv(
				mcrypt_get_iv_size(
					MCRYPT_RIJNDAEL_256,
					MCRYPT_MODE_ECB
				), 
				MCRYPT_RAND
			)
		), "\0"
	);
}

function loggedIn($mysqli){
  if(isset($_SESSION['auth']) && isset($_SESSION['auth']['user_id']) ) {
      
      $statement = $mysqli->prepare("SELECT passwordHash FROM user_info WHERE userId = ? LIMIT 1");
      
      $id = $_SESSION['auth']['user_id'];
      
      $statement->bind_param('s', $id);
      $statement->execute();
      $statement->store_result();
      
      if ($statement->num_rows == 1) {
	$statement->bind_result($storedPass);
	$statement->fetch();
	

	$user_browser = $_SERVER['HTTP_USER_AGENT'];#can be checked evertime
	
	$securityCheck = $_SESSION['auth']['login_string'];
	if(mitigateBool($mysqli, 'sessionSecurityCheck')){
		$securityCheck = hash('sha512', $storedPass . $user_browser);#may not use!!
	}
	

	if($securityCheck == $_SESSION['auth']['login_string']){
	    return true;
	    #echo "<p>Login OK, ".$_SESSION['auth']['fName'].".</p>";
	}else{
	  #echo "<p>Session verification failed. Go away</p>";
	  return false;
	}
	
      }else{
	#echo "<p>User ID not in database. Go away</p>";
	return false;
      }
      
  }else{
    #echo "<p>Session not set. Go away</p>";
    return false;
  }
}
?>
