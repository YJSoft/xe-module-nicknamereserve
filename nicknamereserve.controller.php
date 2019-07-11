<?php
class nicknamereserveController extends nicknamereserve
{
	function init()
	{
	}

	function triggerMemberDelete($obj)
	{
		$oMemberModel = getModel('member');

		$columnList = array('nick_name');
		$memberInfo = $oMemberModel->getMemberInfoByMemberSrl($obj->member_srl, 0, $columnList);

		$args = new stdClass();
		$args->member_srl = $obj->member_srl;
		$args->nick_name = $memberInfo->nick_name;

		// Insert nickname history record
		$output = executeQuery('nicknamereserve.insertNickhistoryRecord', $args);
		if(!$output->toBool())
		{
			$oDB->rollback();
			return $output;
		}
	}

	function triggerMemberInsert($obj) {
		$oNicknamereserveModel = getModel('nicknamereserve');
		$nick_name = htmlspecialchars($obj->nick_name, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);

		if($oNicknamereserveModel->isReservedNickName($nick_name)) return new BaseObject(-1, "err_reserved_nickname");
		else return new BaseObject(0, "success");
	}
}
