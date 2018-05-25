<?php
/**
 * 
 */
class Security {

	private static const $_secreyKey =
		'iCRZxINfYS9j69IJ7Ns8jr3iIMmBwrgLHfuUZTaVPtOTtQ6QLkIFMSAAtKRiaDa6a02yhXAsMmhZOQ60v5xXlX3wlPoI5YMXcSvVUhqdasMHIrKmIgynV9mnoJbllFbF';

	public static function generateToken($length = 128) {
		$token = '';
     	$codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $codeAlphabet.= 'abcdefghijklmnopqrstuvwxyz';
	    $codeAlphabet.= '0123456789';
	    $max = strlen($codeAlphabet);

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[random_int(0, $max-1)];
	    }

	    return $token;
	}

	public static function hashSign($value, $signature = '') {
  		return $value.hash_hmac('sha256', $value, $signature.$_secreyKey);
	}

	public static function verifyHashSign() {
		$val = substr($signed, 0, strlen($signed)-64);
	  	$mac = substr($signed, strlen($signed)-64, strlen($signed)-1);
	  	if (hash_equals(hash_hmac('sha256', $val, $signature.SECRET_KEY), $mac)) {
	    	$unsigned = $val;
	    	return true;
	  	}
	  	$unsigned = '';
	 	return false;
	}

}


?>	