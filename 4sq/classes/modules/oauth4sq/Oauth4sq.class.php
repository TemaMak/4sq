<?php

class Plugin4sq_ModuleOauth4sq extends Plugin4sq_ModuleOauth {

	protected $sOAuthId = "4sq";
	
	
	public function Init() {
		
	}
	
	public function getAuthLink(){
		$url = 'https://foursquare.com/oauth2/authenticate';
		$url .= '?client_id='.Config::Get('oauth.4sq.client_id');
		$url .= '&response_type=code';
		$url .= '&redirect_uri='.$this->getCallBackLink();
		
		return $url;
	}
	
	public function saveToken(){
		parse_str($_SERVER['QUERY_STRING'], $query);
		$code = $query['code'];
		
		$url = 'https://foursquare.com/oauth2/access_token';
		$url .= '?client_id='.Config::Get('oauth.4sq.client_id');
		$url .= '&client_secret='.Config::Get('oauth.4sq.secret');
		$url .= '&grant_type=authorization_code';
		$url .= '&redirect_uri='.$this->getCallBackLink(); //change to your 4sq callback
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
		if ($token){
			$this->Plugin4sq_Oauth_saveTokenInStorage($this->sOAuthId,$token);
		}
	}
	
}
?>
