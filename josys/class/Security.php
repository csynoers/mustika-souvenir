<?php
/*==============================================================================
*	CLASS SECURITY UNTUK PROSES clean_input, anti_injection , enkrip, dekrip
*							2016 (c) By NFY Nautilus
*                           LAST UPDATE 2016/02/29
*==============================================================================*/
class Security{
    //Function clean character
    function clean_input($value) {
    	$character = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','_','/','\\',',','.','#',':',';','\'','"','[',']');
    	$clean     = strtolower(str_replace($character,"",$value));
    	return $clean;
    }

    //Function Anti SQL inject
    function anti_injection($value, $clean='') { //$clean='FALSE'
    	$filter = stripslashes(strip_tags(htmlspecialchars($value,ENT_QUOTES)));
        if($clean == 'FALSE') {
    	    $clean  = $filter;
        }else{
            $clean  = $this->clean_input($filter);
        }
        return $clean;
    }

    function encrypt($value) {
        $key = 'qJB0rGtIn5UB1xG03efyCp';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($value, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    function decrypt($value) {
        $key = 'qJB0rGtIn5UB1xG03efyCp';
        list($encrypted_data, $iv) = explode('::', base64_decode($value), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
}
