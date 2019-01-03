<?php
date_default_timezone_set('Asia/Kolkata');

	
class result
{
	var $status=""; 
	var $message="";
	var $response=""; 

}

class CommonClass
{

	public $baseUrl	= "http://192.168.1.111/spellbee_digital";	
	public $mailUrl	= "http://192.168.1.111/spellbee_digital";	

    public	function SQLEscape($value,$dataType)
	{
		$db=new MySQL();
		return $db->SQLValue($value,$dataType);
	}

	public function password_hash_fn($randomstring,$password) {
		$hashkey = $randomstring;
		return md5($hashkey.$password);
	}

	public function generate_newpassword() {
		$alphabet 	= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$numbers 	= "0123456789";
		$symbol		= "!@#$%&*_";

		$alphabetshuffle 	= substr( str_shuffle( $alphabet ), 0, 8 );
		$numbersshuffle 	= substr( str_shuffle( $numbers ), 0, 2 );
		$symbolshuffle 		= substr( str_shuffle( $symbol ), 0, 2 );

		$shuffledpassword = str_shuffle($alphabetshuffle.$numbersshuffle.$symbolshuffle); // Shuffling string

	    $characters = 'HkdJ6Av5Bphk2f4s6lJeRt67Cki7Rv7X8fy7bY2QSw6dh2IXz7zdc9SQ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	 	$length = 57;
	    for ($i = 0; $i < $length; $i++) {
	    	// echo "testing";
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    $hashed_val = $this->password_hash_fn($randomString,$shuffledpassword);
	    $response = array(
			'shuffledpassword'	=> $shuffledpassword,
			'password' 			=> $hashed_val,
			'hash_key' 			=> $randomString
	    );
	    return $response;
 	}

 	public function generateRandomString($password) {
	    $characters = 'HkdJ6Av5Bphk2f4s6lJeRt67Cki7Rv7X8fy7bY2QSw6dh2IXz7zdc9SQ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	 	$length = 57;
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    $hashed_val = $this->password_hash_fn($randomString,$password);
	    $response = array(
			'hash_key' => $randomString,
			'password' => $hashed_val
	    );
	    return $response;
 	}
}


?>