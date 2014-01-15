<?php

class Plugin4sq_ModuleOauth4sq extends Plugin4sq_ModuleOauth {

	protected $sOAuthId = "4sq";
	
	public function Init() {
		
	}
	
	public function getAuthLink(){
		define('CLIENT_ID', 'KK1XWIRIO2EDOFU0D2FAVFC3NHHNM4DUWL55OZSPWAXXEEB1');
		define('CLIENT_SECRET', 'HXNSBB5IFCEDKLQU4KCX0NQ55IIDSPHVHXDAX0AFU1KS0D3S');
		
		// build $url
		$url = 'https://foursquare.com/oauth2/authenticate';
		$url .= '?client_id='.CLIENT_ID;
		$url .= '&response_type=code';
		$url .= '&redirect_uri='.$this->getCallBackLink();
		
		return $url;
	}
	
}
?>
