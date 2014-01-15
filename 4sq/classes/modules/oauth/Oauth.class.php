<?php

class Plugin4sq_ModuleOauth extends Module {

	protected $sOAuthId;
	protected $aLoadedModules = array();
	
	public function Init() {
	
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
	
	public function InitProvider($sId){
		$this->aLoadedModules[] = $sId;
	}
	
	public function GetLoadedProvider(){
		return $this->aLoadedModules;
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
