<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule("webavk.ibcomments")) {
	ShowError(GetMessage("WEBAVK_IBCOMMENTS_MODULE_NOT_INSTALLED"));
	return;
}
if (!CModule::IncludeModule("iblock")) {
	ShowError(GetMessage("WEBAVK_IBCOMMENTS_IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}
if ($arParams['LINK_ELEMENT_ID'] < 1) {
	ShowError(GetMessage("WEBAVK_IBCOMMENTS_ELEMENT_NOT_FIND"));
	return;
}

$strError = implode("<br />", $this->arErrors);

if (strlen($strError) > 0) {
	ShowError($strError);
	//return;
}
if ($_REQUEST['addok'] == "Y") {
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ADDOK")));
} elseif ($_REQUEST['addmodok'] == "Y") {
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ADDMODOK")));
} elseif ($_REQUEST['editdok'] == "Y") {
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_EDITOK")));
} elseif ($_REQUEST['editmodok'] == "Y") {
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_EDITMODOK")));
} elseif ($_REQUEST['answerok'] == "Y") {
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ANSWEROK")));
}

if ($this->StartResultCache(false, array($USER->GetGroups(), $this->arNavigation, $this->isAdministration, $this->isModerator, $this->isGuest, $this->isAllowAddComment, $this->isEditMode, $this->editCommentID), "/webavk/ibcomments/" . $arParams['LINK_ELEMENT_ID'] . "/")) {
	$arResult['ITEMS'] = $this->getResultItems();
	$arResult['NAV_STRING'] = $this->NAV_STRING;
	$arResult['NAV_CACHED_DATA'] = $this->NAV_CACHED_DATA;
	$arResult['NAV_RESULT'] = $this->NAV_RESULT;
	$arResult['IS_ADMIN'] = $this->isAdministration;
	$arResult['IS_MODERATOR'] = $this->isModerator;
	$arResult['IS_GUEST'] = $this->isGuest;
	$arResult['ALLOW_ADD'] = $this->isAllowAddComment;
	$arResult['EDIT_MODE'] = $this->isEditMode;
	if ($arResult['EDIT_MODE'] && $arResult['COMMENT_ID'])
		$this->abortResultCache();
	$arResult['COMMENT_ID'] = $this->editCommentID;
	if ($arResult['ALLOW_ADD'] && $arResult['IS_GUEST'] && $arParams['USE_CAPTCHA']) {
		$arResult['CAPTCHA_CODE'] = $this->getCaptcha();
	}
	foreach ($arResult['ITEMS'] as $arItem) {
		$arResult['IDS'][$arItem['ID']] = $arItem['CREATED_BY'];
	}
	$arResult['REQUIRED'] = array(
		"ADVANTAGES" => $this->isPropertyRequired("ADVANTAGES"),
		"CONS" => $this->isPropertyRequired("CONS"),
		"REVIEW" => $this->isPropertyRequired("REVIEW"),
		"VOTE_CONV" => $this->isPropertyRequired("VOTE_CONV"),
		"VOTE_FUNC" => $this->isPropertyRequired("VOTE_FUNC"),
		"VOTE_DESIGN" => $this->isPropertyRequired("VOTE_DESIGN"),
		"VOTE_WORK" => $this->isPropertyRequired("VOTE_WORK"),
		"VOTE_PRICE" => $this->isPropertyRequired("VOTE_PRICE"),
	);
	$arResult['POST_COMMENT'] = $this->arPostResult;
	$this->SetResultCacheKeys(array(
		"ALLOW_ADD",
		"IDS"
	));
	$this->IncludeComponentTemplate();
}
?>