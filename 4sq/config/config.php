<?php
/**
 * Конфиг
 */

$config = array();
Config::Set('router.page.oauth', 'Plugin4sq_ActionOauth');

Config::Set('db.table.oauth_token','___db.table.prefix___oauth_token');

Config::Set('4sq.modules',array('4sq'));
//Config::Set('oauth.4sq.secret','');
//Config::Set('oauth.4sq.callback','http://www.demo.32spokes.ru/plugins/4sq/save_token.php');

return $config;