<?php


function calculateNorm($expression){
#remove spaces
	$expression = str_replace(" ", "", $expression);

#split on +
	$expressions = explode("+", $expression);

#multiply out if there are multiplys
	for( $i=0; $i < count($expressions); $i++ ) {
		if (strpos($expressions[$i], '*') !== FALSE) {
			$mult = explode("*", $expressions[$i] );
			$expressions[$i] = array_product($mult);
		}
	}

#add them
	for ( $i= ( count($expressions)-1 ); $i > 0; $i-- ) { 
		$expressions[$i-1] = addNorm( $expressions[$i], $expressions[$i-1] );
	}
	#Answer will be in top of array
	return $expressions[0];

}


function addNorm( $a, $b ){
	return ($a + $b - ($a*$b));
}




?>