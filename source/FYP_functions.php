<?php

function hashPass($pass){
			  
	$salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);;
	$iterator = rand(10, 99);//iterate hash this many 
	$hashedPassword = hash("sha256", $salt.$pass );
			  
	for( $i = 0; $i < ($iterator - 1); $i++ ){
		$hashedPassword = hash("sha256", $salt.$hashedPassword );
	}
			  
	return $salt . ":" . $iterator . ":" . $hashedPassword;
			  			  
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
?>
