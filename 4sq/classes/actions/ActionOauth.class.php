<?php

class Plugin4sq_ActionOauth extends ActionPlugin {


	protected $oUserCurrent=null;


	public function Init() {		
		if (!$this->User_IsAuthorization()) {
			return parent::EventNotFound();
		}
		$this->oUserCurrent=$this->User_GetUserCurrent();
		$this->SetDefaultEvent('profile');
	}

	protected function RegisterEvent() {
		$this->AddEvent('auth','EventAuth');
		$this->AddEvent('save_token','EventSaveToken');
	}

	protected function EventAuth(){				
		$aOAuthIDs = Config::Get('4sq.modules');
		
		$aOAuths = array();
		foreach ($aOAuthIDs as $sOAuthID){
			$oOAuth = $this->Plugin4sq_Oauth_getOAuthByIds($sOAuthID);
			$aOAuths[] = array(
				'link' => $oOAuth->getAuthLink(),
				'img' => $oOAuth->getImgPath(),
			);
		}
						
		$this->Viewer_Assign('aOAuths',$aOAuths);		
	}

	protected function EventSaveToken(){
		$sOAuthID = $this->getOAuthId();
		$oOAuth = $this->Plugin4sq_Oauth_getOAuthByIds($sOAuthID);
		$oOAuth->saveToken();
		
		$sUrl = Router::GetPath('oauth').'auth';
		Router::Location($sUrl);
	}	
	
	protected function getOAuthId(){
		$sOAuthID = null;
		foreach ($this->GetParams() as $sParam) {
			if (preg_match('/^oauth(.+)?$/i', $sParam, $matches)) {
				if (isset($matches[1])) {
					$sOAuthID = $matches[1];
				}
			}
		}
		
		return $sOAuthID;
	}
	
	protected function EventProfile() {
		if (!($this->oUserCurrent)){
			return parent::EventNotFound();
		}
		
		if (isPost('submit_adm_profile')) {
			$oNewAdmProfile = Engine::GetEntity('PluginAdm_Admprofile');			
			$oNewAdmProfile->setAddress(getRequest('adm_profile_addr'));
			$oNewAdmProfile->setName(getRequest('adm_profile_name'));
			
			$this->PluginAdm_Admprofile_SetAdmProfile($this->oUserCurrent,$oNewAdmProfile);
		}
		
		if (isPost('submit_i_am_send_gift')) {
			$this->PluginAdm_Admprofile_setGiftSend($this->oUserCurrent);
		}
		
		if (isPost('submit_i_am_recive_gift')) {
			$this->PluginAdm_Admprofile_setGiftRecive($this->oUserCurrent);
		}		
		
		$oAdmProfile = $this->PluginAdm_Admprofile_GetAdmProfile($this->oUserCurrent);		
		
		
		if ($oAdmProfile){
			$this->Viewer_Assign('sAdmName',$oAdmProfile->getName());
			$this->Viewer_Assign('sAdmAddress',$oAdmProfile->getAddress());
			
			if($oAdmProfile->getReciverUserId()){
				$oReciverUser = $this->User_GetUserById($oAdmProfile->getReciverUserId());
				$this->Viewer_Assign('oAdmReciverProfile',$this->PluginAdm_Admprofile_GetAdmProfile($oReciverUser));				
			}
		} else {
			$this->Viewer_Assign('sAdmName','');
			$this->Viewer_Assign('sAdmAddress','');			
		}

		$this->Viewer_Assign('oAdmProfile',$oAdmProfile);
		
	}

	
	
}
?>
