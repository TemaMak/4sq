<?php

class Plugin4sq_ModuleShortmessages_MapperShortmessages extends Mapper
{

	public function SaveShortMesssage($oMsg){
				$sql = "INSERT INTO 
							".Config::Get('db.table.adm')." (user_id,add_date,address,name)
						VALUES (?d,NOW(),?,?)
						ON DUPLICATE KEY UPDATE
							address = ?,
							name = ?
				";
				
		return ($iId=$this->oDb->query(
				$sql,
				$oUser->getId(),
				$oAdmProfile->getAddress(),
				$oAdmProfile->getName(),
				$oAdmProfile->getAddress(),
				$oAdmProfile->getName()				
			));				
				
	}
		
}

?>
