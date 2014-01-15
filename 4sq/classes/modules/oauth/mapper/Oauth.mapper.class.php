<?php

class Plugin4sq_ModuleOauth_MapperOauth extends Mapper
{

	public function saveToken($oUser,$sOAuthId,$sToken){
				$sql = "INSERT INTO 
							".Config::Get('db.table.oauth_token')."
						VALUES (?d,?,?)
						ON DUPLICATE KEY UPDATE
							token_value = ?

				";
				
		return ($iId=$this->oDb->query(
				$sql,
				$oUser->getId(),
				$sOAuthId,	
				$sToken,
				$sToken
			));				
				
	}
		
	
}

?>
