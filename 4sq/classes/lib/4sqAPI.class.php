<?php 

define('CLIENT_ID', 'KK1XWIRIO2EDOFU0D2FAVFC3NHHNM4DUWL55OZSPWAXXEEB1');
define('CLIENT_SECRET', 'HXNSBB5IFCEDKLQU4KCX0NQ55IIDSPHVHXDAX0AFU1KS0D3S');

class 4sqAPI{
	
	protected $clientId;
	protected $password;
	
	static public function login($clientId,$password){
		$url = 'https://foursquare.com/oauth2/authenticate';
		$url .= '?client_id='.CLIENT_ID;
		$url .= '&response_type=code';
		$url .= '&redirect_uri=http://www.32spokes.ru/plugins/4sq/classes/cron/getData.php'; // change to your 4sq callback
		
		// redirect
		curl( 'Location: '.$url ) ;		
	}
	
	public function callback(){
		//require_once('secrets.php'); // defines CLIENT_ID & CLIENT_SECRET
		
		// get $code from QUERY_STRING
		parse_str($_SERVER['QUERY_STRING'], $query);
		$code = $query['code'];
		
		// build url
		$url = 'https://foursquare.com/oauth2/access_token';
		$url .= '?client_id='.CLIENT_ID;
		$url .= '&client_secret='.CLIENT_SECRET;
		$url .= '&grant_type=authorization_code';
		$url .= '&redirect_uri=http://localhost/scripts/4sq_Callback.php'; //change to your 4sq callback
		$url .= '&code='.$code;
		
		// call to https://foursquare.com/oauth2/access_token with $code
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);
		
		// $result value is json {access_token: ACCESS_TOKEN}
		$values = json_decode($result, true);
		$token = $values['access_token'];
		
		// set access_token cookie (if you wish)
		$expire = time()+2592000; // 30 days from now
		setcookie("foursquare_token", $token, $expire, '/');
		
		// crosswindow scripting to pass back $token
		echo('<script type="text/javascript">');
		echo('opener.set4sqKey("'.$token.'");');
		echo('self.close();'); // close self
		echo('</script>');
	}
}

?>