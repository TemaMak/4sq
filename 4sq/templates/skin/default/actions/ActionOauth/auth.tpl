{assign var="sidebarPosition" value='left'}
{include file='header.tpl'}
<h2 class="page-header">{$aLang.plugin.4sq.auth_page_header}</h2>

<table>
	{foreach from=$aOAuths item=aOAuth}
		<tr>
			<td>
				<img src="{$aOAuth['img']}" height="36" />
			</td>
			<td>
			</td>
			<td>
				<a class="w8-button red w8-button-100" href="{$aOAuth['link']}">{$aLang.plugin.4sq.auth_btn}</a>
			</td>						
		</tr>
	{/foreach}
</table>
{include file='footer.tpl'}