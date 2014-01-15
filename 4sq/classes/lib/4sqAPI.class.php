<?php 

class foursquareAPI{

	protected $api;
	protected $token;
	
	public function __construct($clientId,$secret,$token){
		$this->api = new EpiFoursquare($clientId,$secret,$token);
		$this->token = $token;
	}
	
	public function getCheckins(){
		$data = $this->api->get("/users/self/checkins?oauth_token=".$this->token);
		$resp = json_decode($data->getResponse());
		var_dump($resp->response->checkins->items[15]);
		
		$oCheckin = $resp->response->checkins->items[15];
		
		$sType = 'common'; //TODO get type by checkin comment
		
		$oShortMessage = Engine::GetEntity('Plugin4sq_Shortmessages');
		$oShortMessage->setSource('4sq');
		$oShortMessage->setMessageId($oCheckin->id);
		//$oShortMessage->setUserId(); //TODO get userId from internalScript OR by token
		$oShortMessage->setType($sType);
		
		var_dump($oShortMessage);
	}
	
}

?>