<?php
class nicknamereserveAdminView extends nicknamereserve
{
	function init()
	{
		$this->setTemplatePath($this->module_path.'tpl');
		$this->setTemplateFile(strtolower(str_replace('dispNicknamereserveAdmin', '', $this->act)));
	}

	function dispNicknamereserveAdminConfig()
	{
		$oNicknamereserveModel = getModel('nicknamereserve');
		$module_config = $oNicknamereserveModel->getConfig();
		Context::set('config', $module_config);
	}

	function dispNicknamereserveAdminReservedList()
	{
		//tab
	}
}
