<?php 

$sDirRoot=dirname(dirname(dirname(__FILE__)));
set_include_path(get_include_path().PATH_SEPARATOR.$sDirRoot);
set_include_path($sDirRoot . '/classes/lib/'.PATH_SEPARATOR.get_include_path());
chdir($sDirRoot);

require_once($sDirRoot."/../../config/loader.php");
require_once($sDirRoot."/../../engine/classes/Cron.class.php");

require_once("EpiCurl.php");
require_once("EpiOAuth.php");
require_once("EpiFoursquare.php");
require_once("4sqAPI.class.php");

$token = "ISV4V30R2SG1N5LJIJXRPZ44OYAKF3WFTRHW4Q03HN3NJOPG";

$o4sq = new foursquareAPI(
	"KK1XWIRIO2EDOFU0D2FAVFC3NHHNM4DUWL55OZSPWAXXEEB1",
	"HXNSBB5IFCEDKLQU4KCX0NQ55IIDSPHVHXDAX0AFU1KS0D3S",
	$token
);

$o4sq->getCheckins();

?>