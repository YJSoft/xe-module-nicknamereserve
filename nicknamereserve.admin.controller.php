<?php
class nicknamereserveAdminController extends nicknamereserve
{
	function init()
	{
	}

	function procNicknamereserveAdminInsertConfig()
	{
		$vars = Context::getRequestVars();

		$oModuleController = getController('module');
		$oModuleController->updateModuleConfig('nicknamereserve', $vars);
		if(!in_array(Context::getRequestMethod(),array('XMLRPC','JSON')))
		{
			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispNicknamereserveAdminConfig');
			header('location: ' . $returnUrl);
			return;
		}
	}
}
