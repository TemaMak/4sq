<?php

class Plugin4sq_ModuleOauth extends Module {

	protected $sOAuthId;
	protected $aLoadedModules = array();
	protected $oMapper;
	
	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
	}

	public function getOAuthByIds($sId){
		$className = "Plugin4sq_Oauth".$sId;
		$obj = Engine::getInstance()->GetModuleObject($className);
		return $obj;
	}
	
	public function getCallBackLink(){
		$url = "http://www.demo.32spokes.ru/oauth/save_token/oauth".$this->sOAuthId;
		return $url;
	}
	
	public function saveTokenInStorage($sOAuthId,$sToken){
		$this->oMapper->saveToken(
				$this->User_GetUserCurrent(),
				$sOAuthId,
				$sToken
		);
	}
	
	public function getAuthLink(){
		return NULL;
	}
	
	public function getImgPath(){
		$sPath = Config::Get('path.root.web').'/plugins/4sq/templates/skin/default/images/'.$this->sOAuthId.'.png';
		return $sPath;
	}
	
}
?>
