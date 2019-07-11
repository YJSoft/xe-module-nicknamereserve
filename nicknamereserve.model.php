<?php
class nicknamereserveModel extends nicknamereserve
{
	function init()
	{
	}

	/**
	 * @return Object config object
	 * @notice this function saves config object to private value $config.
	 */
	function getConfig()
	{
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('nicknamereserve');

		return $config;
	}

	/**
	 * @brief Verify if nick name is denied
	 */
	function isReservedNickName($nickName)
	{
		$config = $this->getConfig();
		$logged_info = Context::get('logged_info');
		if($logged_info->is_admin !== 'Y')
		{
			$args = new stdClass();
			$args->nick_name = $nickName;
			$args->last_used = time() - 86400 * $config->reserve_time;
			$output = executeQuery('nicknamereserve.chkNickhistoryList', $args);
			if(!$output->toBool() || isset($output->data)) return true;
		}

		return false;
	}
}
