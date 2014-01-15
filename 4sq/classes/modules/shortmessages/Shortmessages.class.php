<?php 
class Plugin4sq_ModuleShortmessages extends Module
{

	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
	}
	    
	public function SaveShortMesssage($oMsg){
		return $this->oMapper->SaveShortMesssage($oMsg);
	}
		
}