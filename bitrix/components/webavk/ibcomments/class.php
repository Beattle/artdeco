<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

class CWebAVKIBCommentsComponent extends CBitrixComponent {

	var $arNavParams = array();
	var $arNavigation = array();
	var $isAdministration = false;
	var $isModerator = false;
	var $isGuest = true;
	var $NAV_STRING = false;
	var $NAV_CACHED_DATA = false;
	var $NAV_RESULT = false;
	var $arErrors = array();
	var $isAllowAddComment = false;
	var $arPostResult = array();
	var $isEditMode = false;
	var $arDbFields = array();
	var $editCommentID = false;
	var $arAnswerResult = array();
	var $allIgnoredParams = array("action", "commentid", "addok", "addmodok", "findCommentId", "answerok");
	var $arPropertyInfoCache = false;

	public function onPrepareComponentParams($arParams) {
		global $USER;
		$result = array(
			"IBLOCK_TYPE" => trim($arParams["IBLOCK_TYPE"]),
			"IBLOCK_ID" => intval($arParams["IBLOCK_ID"]),
			"LINK_ELEMENT_ID" => intval($arParams["LINK_ELEMENT_ID"]),
			"SHOW_COMMENT_ID" => intval($_REQUEST['findCommentId']),
			"PAGE_ELEMENT_COUNT" => intval($arParams["PAGE_ELEMENT_COUNT"]) <= 0 ? 10 : intval($arParams["PAGE_ELEMENT_COUNT"]),
			"SORT_BY" => trim($arParams["SORT_BY"]),
			"SORT_ORDER" => strtoupper($arParams["SORT_ORDER"]) == "ASC" ? "ASC" : "DESC",
			"USE_FEATURE_ADVANTAGES" => $arParams["USE_FEATURE_ADVANTAGES"] == "Y",
			"USE_FEATURE_CONS" => $arParams["USE_FEATURE_CONS"] == "Y",
			"USE_FEATURE_REVIEW" => $arParams["USE_FEATURE_REVIEW"] == "Y",
			"USE_FEATURE_VOTE_CONV" => $arParams["USE_FEATURE_VOTE_CONV"] == "Y",
			"USE_FEATURE_VOTE_FUNC" => $arParams["USE_FEATURE_VOTE_FUNC"] == "Y",
			"USE_FEATURE_VOTE_DESIGN" => $arParams["USE_FEATURE_VOTE_DESIGN"] == "Y",
			"USE_FEATURE_VOTE_WORK" => $arParams["USE_FEATURE_VOTE_WORK"] == "Y",
			"USE_FEATURE_VOTE_PRICE" => $arParams["USE_FEATURE_VOTE_PRICE"] == "Y",
			"USE_FEATURE_ADMIN_ANSWER" => $arParams["USE_FEATURE_ADMIN_ANSWER"] == "Y",
			"USE_FEATURE_HELPFUL" => $arParams["USE_FEATURE_HELPFUL"] == "Y",
			"ALLOW_GUEST_COMMENTS" => $arParams["ALLOW_GUEST_COMMENTS"] == "Y",
			"USE_CAPTCHA" => $arParams["USE_CAPTCHA"] == "Y",
			"PREMODERATION" => $arParams["PREMODERATION"] == "Y",
			"ALLOW_EDIT" => $arParams["ALLOW_EDIT"] == "Y",
			"GROUP_MODERATORS" => $arParams["GROUP_MODERATORS"],
			"GROUP_ADMINISTRATION" => $arParams["GROUP_ADMINISTRATION"],
			"SEND_EMAIL_NEW_COMMENTS" => $arParams["SEND_EMAIL_NEW_COMMENTS"] == "Y",
			"SEND_EMAIL_MODERATE_COMMENTS" => $arParams["SEND_EMAIL_MODERATE_COMMENTS"] == "Y",
			"SEND_EMAIL_ADMIN_ANSWER" => $arParams["SEND_EMAIL_ADMIN_ANSWER"] == "Y",
			"HIDE_COMMENT_NEGATIVE_RATING" => $arParams["HIDE_COMMENT_NEGATIVE_RATING"] == "Y",
			"ALLOW_SORT" => $arParams["ALLOW_SORT"] == "Y",
			"ALLOW_SORT_VARIANTS" => $arParams["ALLOW_SORT_VARIANTS"],
			"DATE_FORMAT" => $arParams["DATE_FORMAT"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000,
			"DISPLAY_TOP_PAGER" => $arParams['DISPLAY_TOP_PAGER'],
			"DISPLAY_BOTTOM_PAGER" => $arParams['DISPLAY_BOTTOM_PAGER'],
			"PAGER_TITLE" => trim($arParams['PAGER_TITLE']),
			"PAGER_SHOW_ALWAYS" => $arParams['PAGER_SHOW_ALWAYS'] != "N",
			"PAGER_TEMPLATE" => trim($arParams['PAGER_TEMPLATE']),
			"PAGER_DESC_NUMBERING" => $arParams['PAGER_DESC_NUMBERING'] == "Y",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => intval($arParams['PAGER_DESC_NUMBERING_CACHE_TIME']),
			"PAGER_SHOW_ALL" => $arParams['PAGER_SHOW_ALL'] != "N",
			"SAVE_VOTES2ELEMENT" => $arParams['SAVE_VOTES2ELEMENT'] == "Y",
			"MAX_VOTE" => intval($arParams["MAX_VOTE"]) <= 0 ? 5 : intval($arParams["MAX_VOTE"]),
			"SHOW_AVATARS" => $arParams['SHOW_AVATARS'] == "Y",
			"USE_GRAVATARS" => $arParams['USE_GRAVATARS'] == "Y",
			"EMAIL_EVENT_TYPE_NEW_COMMENT" => (strlen($arParams['EMAIL_EVENT_TYPE_NEW_COMMENT']) > 0 ? $arParams['EMAIL_EVENT_TYPE_NEW_COMMENT'] : "WEBAVK_IBCOMMENTS_NEW_COMMENT"),
			"EMAIL_EVENT_TYPE_EDIT_COMMENT" => (strlen($arParams['EMAIL_EVENT_TYPE_EDIT_COMMENT']) > 0 ? $arParams['EMAIL_EVENT_TYPE_EDIT_COMMENT'] : "WEBAVK_IBCOMMENTS_EDIT_COMMENT"),
			"EMAIL_EVENT_TYPE_USER_MODERATE_COMMENT" => (strlen($arParams['EMAIL_EVENT_TYPE_USER_MODERATE_COMMENT']) > 0 ? $arParams['EMAIL_EVENT_TYPE_USER_MODERATE_COMMENT'] : "WEBAVK_IBCOMMENTS_USER_MODERATE_COMMENT"),
			"EMAIL_EVENT_TYPE_USER_ADMINANSWER_COMMENT" => (strlen($arParams['EMAIL_EVENT_TYPE_USER_ADMINANSWER_COMMENT']) > 0 ? $arParams['EMAIL_EVENT_TYPE_USER_ADMINANSWER_COMMENT'] : "WEBAVK_IBCOMMENTS_USER_ADMINANSWER_COMMENT")
		);
		if (!is_array($result['GROUP_MODERATORS']))
			$result['GROUP_MODERATORS'] = array($result['GROUP_MODERATORS']);
		if (!is_array($result['GROUP_ADMINISTRATION']))
			$result['GROUP_ADMINISTRATION'] = array($result['GROUP_ADMINISTRATION']);

		if (strlen($_REQUEST['commentsort']) > 0) {
			$result['CURRENT_SORT'] = $_REQUEST['commentsort'];
			if ($result['CURRENT_SORT'] == "RATING_DESC") {
				$result['SORT_BY'] = "PROPERTY_HELPFUL_TOTAL";
				$result['SORT_ORDER'] = "DESC";
			} elseif ($result['CURRENT_SORT'] == "RATING_ASC") {
				$result['SORT_BY'] = "PROPERTY_HELPFUL_TOTAL";
				$result['SORT_ORDER'] = "ASC";
			} elseif ($result['CURRENT_SORT'] == "CREATE_DATE_DESC") {
				$result['SORT_BY'] = "CREATE_DATE";
				$result['SORT_ORDER'] = "DESC";
			} elseif ($result['CURRENT_SORT'] == "CREATE_DATE_ASC") {
				$result['SORT_BY'] = "CREATE_DATE";
				$result['SORT_ORDER'] = "ASC";
			}
		}
		$this->arNavParams = array(
			"nPageSize" => $result["PAGE_ELEMENT_COUNT"],
			"bDescPageNumbering" => $result["PAGER_DESC_NUMBERING"],
			"bShowAll" => $result["PAGER_SHOW_ALL"],
		);

		$this->arNavigation = CDBResult::GetNavParams($this->arNavParams);
		if ($USER->IsAuthorized()) {
			$this->isGuest = false;
			$this->isAllowAddComment = true;
			$arGroup = $USER->GetUserGroupArray();
			foreach ($result['GROUP_MODERATORS'] as $g) {
				if ($g > 0 && in_array($g, $arGroup))
					$this->isModerator = true;
			}
			foreach ($result['GROUP_ADMINISTRATION'] as $g) {
				if ($g > 0 && in_array($g, $arGroup))
					$this->isAdministration = true;
			}
			if (intval($_REQUEST['commentEdit']) > 0) {
				$arFilter = array(
					"ID" => intval($_REQUEST['commentEdit']),
					"IBLOCK_ID" => $result['IBLOCK_ID'],
					"ACTIVE" => "Y",
					"IBLOCK_LID" => SITE_ID,
					"IBLOCK_ACTIVE" => "Y",
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
					"MIN_PERMISSION" => "R",
					"PROPERTY_LINKED_ELEMENT" => $result["LINK_ELEMENT_ID"]
				);
				if ($this->isAdministration || $this->isModerator) {
					unset($arFilter['ACTIVE']);
				} else {
					$arFilter['CREATED_BY'] = $USER->GetID();
				}
				$arSelect = array(
					"ID",
					"NAME",
					"CODE",
					"DATE_CREATE",
					"ACTIVE_FROM",
					"ACTIVE_TO",
					"ACTIVE",
					"CREATED_BY",
					"IBLOCK_ID",
					"DETAIL_PAGE_URL",
					"DETAIL_TEXT",
					"DETAIL_TEXT_TYPE",
					"DETAIL_PICTURE",
					"PREVIEW_TEXT",
					"PREVIEW_TEXT_TYPE",
					"PREVIEW_PICTURE",
					"TAGS",
					"PROPERTY_*",
				);
				$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
				if ($obElement = $rsElements->GetNextElement()) {
					$arItem = $obElement->GetFields();
					$arItem["PROPERTIES"] = $obElement->GetProperties();
					$this->editCommentID = $arItem['ID'];
					$arFields = array(
						"ID" => $arItem['ID']
					);
					if ($result['USE_FEATURE_ADVANTAGES'])
						$arFields['ADVANTAGES'] = $arItem["PROPERTIES"]['ADVANTAGES']['~VALUE']['TEXT'];
					if ($result['USE_FEATURE_CONS'])
						$arFields['CONS'] = $arItem["PROPERTIES"]['CONS']['~VALUE']['TEXT'];
					if ($result['USE_FEATURE_REVIEW'])
						$arFields['REVIEW'] = $arItem["PROPERTIES"]['REVIEW']['~VALUE']['TEXT'];
					if ($result['USE_FEATURE_VOTE_CONV'])
						$arFields['VOTE_CONV'] = $arItem["PROPERTIES"]['VOTE_CONV']['~VALUE'];
					if ($result['USE_FEATURE_VOTE_FUNC'])
						$arFields['VOTE_FUNC'] = $arItem["PROPERTIES"]['VOTE_FUNC']['~VALUE'];
					if ($result['USE_FEATURE_VOTE_DESIGN'])
						$arFields['VOTE_DESIGN'] = $arItem["PROPERTIES"]['VOTE_DESIGN']['~VALUE'];
					if ($result['USE_FEATURE_VOTE_WORK'])
						$arFields['VOTE_WORK'] = $arItem["PROPERTIES"]['VOTE_WORK']['~VALUE'];
					if ($result['USE_FEATURE_VOTE_PRICE'])
						$arFields['VOTE_PRICE'] = $arItem["PROPERTIES"]['VOTE_PRICE']['~VALUE'];
					$this->isEditMode = true;
					$this->arDbFields = $arFields;
				}
			}
		} elseif ($result['ALLOW_GUEST_COMMENTS']) {
			$this->isAllowAddComment = true;
		}

		return $result;
	}

	public function ClearCurrentElementCache() {
		$c = new CPHPCache;
		$c->CleanDir("/webavk/ibcomments/" . $this->arParams['LINK_ELEMENT_ID'] . "/");
	}

	public function executeComponent() {
		global $APPLICATION, $USER;
		$commentID = intval($_REQUEST['commentid']);
		if ($this->isModerator && $commentID > 0) {
			if ($_REQUEST['action'] == "hidecomment") {
				$arFilter = array(
					"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
					"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
					"ID" => $commentID
				);
				$rElement = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "ACTIVE"));
				if ($arElement = $rElement->Fetch()) {
					if ($arElement['ACTIVE'] == "Y") {
						$ibe = new CIBlockElement();
						$ibe->Update($arElement['ID'], array("ACTIVE" => "N"));
						$this->doRecheckRatingsIfAllow();
						$this->ClearCurrentElementCache();
						LocalRedirect($APPLICATION->GetCurPageParam("", $this->allIgnoredParams) . "#comment" . $commentID);
					}
				}
			} elseif ($_REQUEST['action'] == "showcomment") {
				$arFilter = array(
					"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
					"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
					"ID" => $commentID
				);
				$rElement = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "ACTIVE"));
				if ($arElement = $rElement->Fetch()) {
					if ($arElement['ACTIVE'] == "N") {
						$ibe = new CIBlockElement();
						$ibe->Update($arElement['ID'], array("ACTIVE" => "Y"));
						$this->doSendUserModerateOk($arElement['ID']);
						$this->doRecheckRatingsIfAllow();
						$this->ClearCurrentElementCache();
						LocalRedirect($APPLICATION->GetCurPageParam("", $this->allIgnoredParams) . "#comment" . $commentID);
					}
				}
			} elseif ($_REQUEST['action'] == "deletecomment") {
				$arFilter = array(
					"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
					"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
					"ID" => $commentID
				);
				$rElement = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "ACTIVE"));
				if ($arElement = $rElement->Fetch()) {
					$ibe = new CIBlockElement();
					$ibe->Delete($arElement['ID']);
					$this->doRecheckRatingsIfAllow();
					$this->ClearCurrentElementCache();
					LocalRedirect($APPLICATION->GetCurPageParam("", $this->allIgnoredParams) . "#comment" . $commentID);
				}
			}
		}
		if ($commentID > 0) {
			if ($_REQUEST['action'] == "helpfulplus") {
				if (!in_array($commentID, $_SESSION["WEBAVK_IBCOMMENTS_HELPFUL"])) {
					$arFilter = array(
						"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
						"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
						"ID" => $commentID
					);
					$rElement = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "PROPERTY_HELPFUL_PLUS", "PROPERTY_HELPFUL_MINUS", "PROPERTY_HELPFUL_TOTAL"));
					if ($arElement = $rElement->Fetch()) {
						CIBlockElement::SetPropertyValueCode($arElement['ID'], "HELPFUL_PLUS", $arElement['PROPERTY_HELPFUL_PLUS_VALUE'] + 1);
						CIBlockElement::SetPropertyValueCode($arElement['ID'], "HELPFUL_TOTAL", $arElement['PROPERTY_HELPFUL_PLUS_VALUE'] - $arElement['PROPERTY_HELPFUL_MINUS_VALUE'] + 1);
						$_SESSION["WEBAVK_IBCOMMENTS_HELPFUL"][] = $commentID;
						$this->ClearCurrentElementCache();
						LocalRedirect($APPLICATION->GetCurPageParam("", $this->allIgnoredParams) . "#comment" . $commentID);
					}
				} else {
					$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_HELPFULL_ERROR_DUBLICATE");
				}
			} elseif ($_REQUEST['action'] == "helpfulminus") {
				if (!in_array($commentID, $_SESSION["WEBAVK_IBCOMMENTS_HELPFUL"])) {
					$arFilter = array(
						"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
						"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
						"ID" => $commentID
					);
					$rElement = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "PROPERTY_HELPFUL_PLUS", "PROPERTY_HELPFUL_MINUS", "PROPERTY_HELPFUL_TOTAL"));
					if ($arElement = $rElement->Fetch()) {
						CIBlockElement::SetPropertyValueCode($arElement['ID'], "HELPFUL_MINUS", $arElement['PROPERTY_HELPFUL_MINUS_VALUE'] + 1);
						CIBlockElement::SetPropertyValueCode($arElement['ID'], "HELPFUL_TOTAL", $arElement['PROPERTY_HELPFUL_PLUS_VALUE'] - $arElement['PROPERTY_HELPFUL_MINUS_VALUE'] - 1);
						$_SESSION["WEBAVK_IBCOMMENTS_HELPFUL"][] = $commentID;
						$this->ClearCurrentElementCache();
						LocalRedirect($APPLICATION->GetCurPageParam("", $this->allIgnoredParams) . "#comment" . $commentID);
					}
				} else {
					$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_HELPFULL_ERROR_DUBLICATE");
				}
			}
		}

		if ($_SERVER['REQUEST_METHOD'] == "POST" && check_bitrix_sessid() && strlen($_REQUEST['send']) > 0 && $_REQUEST['COMMENT']['IID'] == $this->arParams['IBLOCK_ID'] && $_REQUEST['COMMENT']['EID'] == $this->arParams['LINK_ELEMENT_ID'] && $this->isAllowAddComment && $this->arParams['LINK_ELEMENT_ID'] > 0) {
			$this->arPostResult = $_REQUEST['COMMENT'];
			$arFields = array(
				"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
				//"NAME" => "",
				"ACTIVE" => "Y",
				"PROPERTY_VALUES" => array(
					"LINKED_ELEMENT" => $this->arParams['LINK_ELEMENT_ID']
				)
			);
			if ($this->arParams['PREMODERATION'] && !$this->isModerator && !$this->isAdministration) {
				$arFields['ACTIVE'] = "N";
			}
			if ($this->isGuest) {
				if (strlen(trim($this->arPostResult['GUEST_NAME'])) < 3) {
					$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_GUEST_ERROR_NAME");
				} else {
					$arFields['PROPERTY_VALUES']['AUTHOR_NAME'] = trim($this->arPostResult['GUEST_NAME']);
				}
				if (strlen(trim($this->arPostResult['GUEST_EMAIL'])) < 3 || !check_email(trim($this->arPostResult['GUEST_EMAIL']))) {
					$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_GUEST_ERROR_EMAIL");
				} else {
					$arFields['PROPERTY_VALUES']['AUTHOR_EMAIL'] = trim($this->arPostResult['GUEST_EMAIL']);
				}
				if ($this->arParams['USE_CAPTCHA'] && !$APPLICATION->CaptchaCheckCode($this->arPostResult["captcha_word"], $this->arPostResult["captcha_sid"])) {
					$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_GUEST_ERROR_CAPTCHA");
				}
			}
			$arFields = $this->checkPostErrors($arFields);
			if (strlen(trim(implode("", $this->arErrors))) < 1) {
				$rEl = CIBlockElement::GetList(array(), array("ID" => $this->arParams['LINK_ELEMENT_ID']), false, false, array("ID", "NAME"));
				if ($arEl = $rEl->Fetch()) {
					$arFields['NAME'] = 'Re: ' . $arEl['NAME'];
				}
				$ibe = new CIBlockElement();
				if ($this->isEditMode && $this->editCommentID > 0) {
					unset($arFields['IBLOCK_ID']);
					$arProp = $arFields['PROPERTY_VALUES'];
					unset($arFields['PROPERTY_VALUES']);
					if (!$ibe->Update($this->editCommentID, $arFields)) {
						$this->arErrors[] = $ibe->LAST_ERROR;
					}
					foreach ($arProp as $k => $v) {
						CIBlockElement::SetPropertyValueCode($this->editCommentID, $k, $v);
					}
					$this->doSendAdminEditComment($this->editCommentID);
					$this->doRecheckRatingsIfAllow();
					$this->ClearCurrentElementCache();
					LocalRedirect($APPLICATION->GetCurPageParam(($arFields['ACTIVE'] == "Y" ? "editok=Y" : "editmodok=Y"), array("editok", "editmodok", "commentEdit")) . "#comment" . $this->editCommentID);
				} else {
					$NEW_ID = $ibe->Add($arFields);
					if ($NEW_ID > 0) {
						$this->doSendAdminNewComment($NEW_ID);
						$this->doRecheckRatingsIfAllow();
						$this->ClearCurrentElementCache();
						LocalRedirect($APPLICATION->GetCurPageParam(($arFields['ACTIVE'] == "Y" ? "addok=Y" : "addmodok=Y"), array("addok", "addmodok")) . "#comment" . $NEW_ID);
					} else {
						$this->arErrors[] = $ibe->LAST_ERROR;
					}
				}
			}
		} elseif ($this->isEditMode && is_array($this->arDbFields) && count($this->arDbFields) > 0) {
			$this->arPostResult = $this->arDbFields;
		}
		if ($_SERVER['REQUEST_METHOD'] == "POST" && check_bitrix_sessid() && strlen($_REQUEST['sendadminanswer']) > 0 && $_REQUEST['ANSWER']['IID'] == $this->arParams['IBLOCK_ID'] && $_REQUEST['ANSWER']['EID'] == $this->arParams['LINK_ELEMENT_ID'] && $this->isAdministration && $this->arParams['USE_FEATURE_ADMIN_ANSWER'] && $this->arParams['LINK_ELEMENT_ID'] > 0) {
			$this->arAnswerResult = $_REQUEST['ANSWER'];
			if ($this->arAnswerResult['COMMENT_ID'] > 0) {
				CIBlockElement::SetPropertyValueCode(intval($this->arAnswerResult['COMMENT_ID']), "ADMIN_ANSWER", array("VALUE" => array("TYPE" => "TEXT", "TEXT" => $_REQUEST['ANSWER']['TEXT'])));
				CIBlockElement::SetPropertyValueCode(intval($this->arAnswerResult['COMMENT_ID']), "ADMIN_ANSWER_DATE", ConvertTimeStamp(false, "FULL"));
				if (strlen(trim($_REQUEST['ANSWER']['TEXT'])) > 0) {
					$this->doSendUserAnswerAdmin(intval($this->arAnswerResult['COMMENT_ID']));
				}
				$this->ClearCurrentElementCache();
				LocalRedirect($APPLICATION->GetCurPageParam("answerok=Y", $this->allIgnoredParams) . "#comment" . intval($this->arAnswerResult['COMMENT_ID']));
			}
		}
		if ($this->arParams['SHOW_COMMENT_ID'] > 0) {
			$arFilter = array(
				"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
				"ACTIVE" => "Y",
				"IBLOCK_LID" => SITE_ID,
				"IBLOCK_ACTIVE" => "Y",
				"ACTIVE" => "Y",
				"CHECK_PERMISSIONS" => "Y",
				"MIN_PERMISSION" => "R",
				"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"]
			);
			if ($this->isAdministration || $this->isModerator)
				unset($arFilter['ACTIVE']);
			$arSelect = array(
				"ID",
				"NAME",
				"CODE",
				"DATE_CREATE",
				"ACTIVE_FROM",
				"ACTIVE_TO",
				"ACTIVE",
				"CREATED_BY",
				"IBLOCK_ID",
				"DETAIL_PAGE_URL",
				"DETAIL_TEXT",
				"DETAIL_TEXT_TYPE",
				"DETAIL_PICTURE",
				"PREVIEW_TEXT",
				"PREVIEW_TEXT_TYPE",
				"PREVIEW_PICTURE",
				"TAGS",
				"PROPERTY_*",
			);
			$arSort = array(
				$this->arParams["SORT_BY"] => $this->arParams["SORT_ORDER"],
				"ID" => "DESC",
			);
			// :((((((((((((((((((((((((((((((((
			$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, false, array("ID"));
			$n = 0;
			while ($ar = $rsElements->Fetch()) {
				if ($this->arParams['SHOW_COMMENT_ID'] == $ar['ID']) {
					$page = intval($n / $this->arNavParams['nPageSize']) + 1;
					LocalRedirect($APPLICATION->GetCurPageParam("PAGEN_" . $this->arNavigation['PAGEN'] . "=" . $page, array("findCommentId", "PAGEN_" . $this->arNavigation['PAGEN'])) . "#comment" . $ar['ID']);
				}
				$n++;
			}
		}

		return parent::executeComponent();
	}

	function isPropertyRequired($propertyCode) {
		if ($this->arPropertyInfoCache === false) {
			$this->arPropertyInfoCache = array();
			$rProp = CIBlockProperty::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y"));
			while ($arProp = $rProp->Fetch()) {
				$this->arPropertyInfoCache[$arProp['CODE']] = $arProp;
			}
		}
		return ($this->arPropertyInfoCache[$propertyCode]['IS_REQUIRED'] == "Y");
	}

	public function checkPostErrors($arFields) {
		if ($this->arParams['USE_FEATURE_ADVANTAGES']) {
			if ($this->isPropertyRequired("ADVANTAGES") && strlen(trim($this->arPostResult['ADVANTAGES'])) <= 3) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_ADVANTAGES");
			} else {
				$arFields['PROPERTY_VALUES']['ADVANTAGES']['VALUE'] = array(
					"TYPE" => "TEXT",
					"TEXT" => trim($this->arPostResult['ADVANTAGES'])
				);
			}
		}
		if ($this->arParams['USE_FEATURE_CONS']) {
			if ($this->isPropertyRequired("CONS") && strlen(trim($this->arPostResult['CONS'])) <= 3) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_CONS");
			} else {
				$arFields['PROPERTY_VALUES']['CONS']['VALUE'] = array(
					"TYPE" => "TEXT",
					"TEXT" => trim($this->arPostResult['CONS'])
				);
			}
		}
		if ($this->arParams['USE_FEATURE_REVIEW']) {
			if ($this->isPropertyRequired("REVIEW") && strlen(trim($this->arPostResult['REVIEW'])) <= 3) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_REVIEW");
			} else {
				$arFields['PROPERTY_VALUES']['REVIEW']['VALUE'] = array(
					"TYPE" => "TEXT",
					"TEXT" => trim($this->arPostResult['REVIEW'])
				);
			}
		}
		if ($this->arParams['USE_FEATURE_VOTE_CONV']) {
			if ($this->isPropertyRequired("VOTE_CONV") && intval($this->arPostResult['VOTE_CONV']) <= 0) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_VOTE_CONV");
			} else {
				if (intval($this->arPostResult['VOTE_CONV']) > $this->arParams['MAX_VOTE'])
					$this->arPostResult['VOTE_CONV'] = $this->arParams['MAX_VOTE'];
				$arFields['PROPERTY_VALUES']['VOTE_CONV'] = intval($this->arPostResult['VOTE_CONV']);
			}
		}
		if ($this->arParams['USE_FEATURE_VOTE_FUNC']) {
			if ($this->isPropertyRequired("VOTE_FUNC") && intval($this->arPostResult['VOTE_FUNC']) <= 0) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_VOTE_FUNC");
			} else {
				if (intval($this->arPostResult['VOTE_FUNC']) > $this->arParams['MAX_VOTE'])
					$this->arPostResult['VOTE_FUNC'] = $this->arParams['MAX_VOTE'];
				$arFields['PROPERTY_VALUES']['VOTE_FUNC'] = intval($this->arPostResult['VOTE_FUNC']);
			}
		}
		if ($this->arParams['USE_FEATURE_VOTE_DESIGN']) {
			if ($this->isPropertyRequired("VOTE_DESIGN") && intval($this->arPostResult['VOTE_DESIGN']) <= 0) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_VOTE_DESIGN");
			} else {
				if (intval($this->arPostResult['VOTE_DESIGN']) > $this->arParams['MAX_VOTE'])
					$this->arPostResult['VOTE_DESIGN'] = $this->arParams['MAX_VOTE'];
				$arFields['PROPERTY_VALUES']['VOTE_DESIGN'] = intval($this->arPostResult['VOTE_DESIGN']);
			}
		}
		if ($this->arParams['USE_FEATURE_VOTE_WORK']) {
			if ($this->isPropertyRequired("VOTE_WORK") && intval($this->arPostResult['VOTE_WORK']) <= 0) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_VOTE_WORK");
			} else {
				if (intval($this->arPostResult['VOTE_WORK']) > $this->arParams['MAX_VOTE'])
					$this->arPostResult['VOTE_WORK'] = $this->arParams['MAX_VOTE'];
				$arFields['PROPERTY_VALUES']['VOTE_WORK'] = intval($this->arPostResult['VOTE_WORK']);
			}
		}
		if ($this->arParams['USE_FEATURE_VOTE_PRICE']) {
			if ($this->isPropertyRequired("VOTE_PRICE") && intval($this->arPostResult['VOTE_PRICE']) <= 0) {
				$this->arErrors[] = GetMessage("WEBAVK_IBCOMMENTS_FIELD_ERROR_VOTE_PRICE");
			} else {
				if (intval($this->arPostResult['VOTE_PRICE']) > $this->arParams['MAX_VOTE'])
					$this->arPostResult['VOTE_PRICE'] = $this->arParams['MAX_VOTE'];
				$arFields['PROPERTY_VALUES']['VOTE_PRICE'] = intval($this->arPostResult['VOTE_PRICE']);
			}
		}
		return $arFields;
	}

	public function getResultItems() {
		global $APPLICATION;
		$arResult = array();
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
			"ACTIVE" => "Y",
			"IBLOCK_LID" => SITE_ID,
			"IBLOCK_ACTIVE" => "Y",
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
			"MIN_PERMISSION" => "R",
			"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"]
		);
		if ($this->isAdministration || $this->isModerator)
			unset($arFilter['ACTIVE']);
		$arSelect = array(
			"ID",
			"NAME",
			"CODE",
			"DATE_CREATE",
			"ACTIVE_FROM",
			"ACTIVE_TO",
			"ACTIVE",
			"CREATED_BY",
			"IBLOCK_ID",
			"DETAIL_PAGE_URL",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"DETAIL_PICTURE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"PREVIEW_PICTURE",
			"TAGS",
			"PROPERTY_*",
		);
		$arSort = array(
			$this->arParams["SORT_BY"] => $this->arParams["SORT_ORDER"],
			"ID" => "DESC",
		);
		$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, $this->arNavParams, $arSelect);
		while ($obElement = $rsElements->GetNextElement()) {
			$arItem = $obElement->GetFields();
			$arItem['FORMAT_DATE_CREATE'] = CIBlockFormatProperties::DateFormat($this->arParams["DATE_FORMAT"], MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));
			//myPrint($arItem);
			$arItem["PROPERTIES"] = $obElement->GetProperties();
			if ($arItem['CREATED_BY'] > 0) {
				$rUser = CUser::GetByID($arItem['CREATED_BY']);
				if ($arUser = $rUser->GetNext()) {
					if ($arUser['PERSONAL_PHOTO'] > 0) {
						$arUser['PERSONAL_PHOTO'] = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
					}
					$arItem['USER'] = $arUser;
					if (strlen($arItem["PROPERTIES"]['AUTHOR_NAME']['VALUE']) <= 0) {
						$arItem["PROPERTIES"]['AUTHOR_NAME']['VALUE'] = CUser::FormatName("#NAME# #LAST_NAME#", $arItem['USER']);
					}
				}
			}
			if (empty($arItem['USER']) || strlen($arItem['USER']['EMAIL']) < 1) {
				$arItem['GRAVATAR_SRC'] = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($arItem["PROPERTIES"]['AUTHOR_EMAIL']['VALUE']))) . '?s=50&d=mm';
			} else {
				$arItem['GRAVATAR_SRC'] = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($arItem['USER']['EMAIL']))) . '?s=50&d=mm';
			}
			if ($this->arParams['HIDE_COMMENT_NEGATIVE_RATING'] && $this->arParams['USE_FEATURE_HELPFUL'] && $arItem["PROPERTIES"]['HELPFUL_TOTAL']['VALUE'] < 0) {
				$arItem['IS_HIDE'] = true;
			}
			if (strlen($arItem["PROPERTIES"]['ADMIN_ANSWER_DATE']['VALUE']) > 0) {
				$arItem["PROPERTIES"]['ADMIN_ANSWER_DATE']['FROMAT_VALUE'] = CIBlockFormatProperties::DateFormat($this->arParams["DATE_FORMAT"], MakeTimeStamp($arItem["PROPERTIES"]['ADMIN_ANSWER_DATE']['VALUE'], CSite::GetDateFormat()));
			}
			$arResult[] = $arItem;
		}
		$this->NAV_STRING = $rsElements->GetPageNavStringEx($navComponentObject, $this->arParams["PAGER_TITLE"], $this->arParams["PAGER_TEMPLATE"], $this->arParams["PAGER_SHOW_ALWAYS"]);
		$this->NAV_CACHED_DATA = $navComponentObject->GetTemplateCachedData();
		$this->NAV_RESULT = $rsElements;
		return $arResult;
	}

	function getCaptcha() {
		global $APPLICATION;
		return htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
	}

	function doRecheckRatingsIfAllow() {
		if ($this->arParams['SAVE_VOTES2ELEMENT']) {
			$arFilter = array(
				"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
				"ACTIVE" => "Y",
				"IBLOCK_LID" => SITE_ID,
				"IBLOCK_ACTIVE" => "Y",
				"ACTIVE" => "Y",
				"CHECK_PERMISSIONS" => "Y",
				"MIN_PERMISSION" => "R",
				"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"]
			);
			$arGroup = array("ACTIVE");
			$totalVoteFeatures = 0;
			if ($this->arParams['USE_FEATURE_VOTE_CONV']) {
				$arGroup[] = "PROPERTY_VOTE_CONV";
				$totalVoteFeatures++;
			}
			if ($this->arParams['USE_FEATURE_VOTE_FUNC']) {
				$arGroup[] = "PROPERTY_VOTE_FUNC";
				$totalVoteFeatures++;
			}
			if ($this->arParams['USE_FEATURE_VOTE_DESIGN']) {
				$arGroup[] = "PROPERTY_VOTE_DESIGN";
				$totalVoteFeatures++;
			}
			if ($this->arParams['USE_FEATURE_VOTE_WORK']) {
				$arGroup[] = "PROPERTY_VOTE_WORK";
				$totalVoteFeatures++;
			}
			if ($this->arParams['USE_FEATURE_VOTE_PRICE']) {
				$arGroup[] = "PROPERTY_VOTE_PRICE";
				$totalVoteFeatures++;
			}
			if ($this->arParams['USE_FEATURE_HELPFUL']) {
				$arGroup[] = "PROPERTY_HELPFUL_TOTAL";
				$totalVoteFeatures++;
			}
			$rElements = CIBlockElement::GetList(array(), $arFilter, $arGroup, false, false);
			$total = 0;
			$voteConv = 0;
			$voteFunc = 0;
			$voteDesign = 0;
			$voteWork = 0;
			$votePrice = 0;
			$helpFulTotal = 0;
			while ($arElement = $rElements->Fetch()) {
				$total+=$arElement['CNT'];
				$voteConv+=$arElement['PROPERTY_VOTE_CONV_VALUE'] * $arElement['CNT'];
				$voteFunc+=$arElement['PROPERTY_VOTE_FUNC_VALUE'] * $arElement['CNT'];
				$voteDesign+=$arElement['PROPERTY_VOTE_DESIGN_VALUE'] * $arElement['CNT'];
				$voteWork+=$arElement['PROPERTY_VOTE_WORK_VALUE'] * $arElement['CNT'];
				$votePrice+=$arElement['PROPERTY_VOTE_PRICE_VALUE'] * $arElement['CNT'];
				$helpFulTotal+=$arElement['PROPERTY_HELPFUL_TOTAL_VALUE'] * $arElement['CNT'];
			}
			$voteConv = round($voteConv / $total, 2);
			$voteFunc = round($voteFunc / $total, 2);
			$voteDesign = round($voteDesign / $total, 2);
			$voteWork = round($voteWork / $total, 2);
			$votePrice = round($votePrice / $total, 2);
			$mixedVote = $voteConv + $voteFunc + $voteDesign + $voteWork + $votePrice;
			if ($totalVoteFeatures > 0) {
				$mixedVote = round($mixedVote / $totalVoteFeatures, 2);
			}
			//Check properties
			$arCheckProps = array(
				"comments_total" => GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_TOTAL")
			);
			if ($this->arParams['USE_FEATURE_VOTE_CONV']) {
				$arCheckProps["comments_vote_conv"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_CONV");
			}
			if ($this->arParams['USE_FEATURE_VOTE_FUNC']) {
				$arCheckProps["comments_vote_func"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_FUNC");
			}
			if ($this->arParams['USE_FEATURE_VOTE_DESIGN']) {
				$arCheckProps["comments_vote_design"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_DESIGN");
			}
			if ($this->arParams['USE_FEATURE_VOTE_WORK']) {
				$arCheckProps["comments_vote_work"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_WORK");
			}
			if ($this->arParams['USE_FEATURE_VOTE_PRICE']) {
				$arCheckProps["comments_vote_price"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_PRICE");
			}
			if ($this->arParams['USE_FEATURE_HELPFUL']) {
				$arCheckProps["comments_helpful"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_HELPFUL");
			}
			if ($totalVoteFeatures > 0) {
				$arCheckProps["comments_vote_avg"] = GetMessage("WEBAVK_IBCOMMENTS_MAINELEMENT_NAME_VOTE_AVG");
			}
			$this->doCheckPropertiesExists($arCheckProps);

			$this->doSaveRatingsPropValues("comments_total", $total);
			if ($this->arParams['USE_FEATURE_VOTE_CONV']) {
				$this->doSaveRatingsPropValues("comments_vote_conv", $voteConv);
			}
			if ($this->arParams['USE_FEATURE_VOTE_FUNC']) {
				$this->doSaveRatingsPropValues("comments_vote_func", $voteFunc);
			}
			if ($this->arParams['USE_FEATURE_VOTE_DESIGN']) {
				$this->doSaveRatingsPropValues("comments_vote_design", $voteDesign);
			}
			if ($this->arParams['USE_FEATURE_VOTE_WORK']) {
				$this->doSaveRatingsPropValues("comments_vote_work", $voteWork);
			}
			if ($this->arParams['USE_FEATURE_VOTE_PRICE']) {
				$this->doSaveRatingsPropValues("comments_vote_price", $votePrice);
			}
			if ($this->arParams['USE_FEATURE_HELPFUL']) {
				$this->doSaveRatingsPropValues("comments_helpful", $helpFulTotal);
			}
			if ($totalVoteFeatures > 0) {
				$this->doSaveRatingsPropValues("comments_vote_avg", $mixedVote);
			}
		}
	}

	function doCheckPropertiesExists($arProp) {
		if ($this->arParams['LINK_ELEMENT_ID'] > 0) {
			$ibid = 0;
			$rEl = CIBlockElement::GetList(array(), array("ID" => intval($this->arParams['LINK_ELEMENT_ID'])), false, false, array("ID", "IBLOCK_ID"));
			if ($arEl = $rEl->Fetch()) {
				$ibid = $arEl['IBLOCK_ID'];
			}
			if ($ibid>0)
			{
				foreach ($arProp as $prop => $name) {
					$rProp = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $ibid, "CODE" => $prop));
					if ($arP = $rProp->Fetch()) {
					} else {
						$ibp = new CIBlockProperty();
						$ibp->Add(array(
							"NAME" => $name,
							"CODE" => $prop,
							"PROPERTY_TYPE" => "N",
							"SORT" => 100000,
							"ACTIVE" => "Y",
							"IBLOCK_ID" => $ibid
						));
					}
				}
			}
		}
	}

	function doSaveRatingsPropValues($propertyCode, $propertyValue) {
		CIBlockElement::SetPropertyValueCode($this->arParams['LINK_ELEMENT_ID'], $propertyCode, $propertyValue);
	}

	function doSendAdminNewComment($commentId) {
		if ($this->arParams['SEND_EMAIL_NEW_COMMENTS']) {
			$arComment = $this->doGetCommentInfo($commentId);
			$arEvent = array(
				"COMMENT_LINK" => $arComment['LINK']
			);
			CEvent::Send($this->arParams['EMAIL_EVENT_TYPE_NEW_COMMENT'], SITE_ID, $arEvent);
		}
	}

	function doSendAdminEditComment($commentId) {
		if ($this->arParams['SEND_EMAIL_NEW_COMMENTS']) {
			$arComment = $this->doGetCommentInfo($commentId);
			$arEvent = array(
				"COMMENT_LINK" => $arComment['LINK']
			);
			CEvent::Send($this->arParams['EMAIL_EVENT_TYPE_EDIT_COMMENT'], SITE_ID, $arEvent);
		}
	}

	function doSendUserModerateOk($commentId) {
		if ($this->arParams['SEND_EMAIL_MODERATE_COMMENTS']) {
			$arComment = $this->doGetCommentInfo($commentId);
			$arEvent = array(
				"COMMENT_LINK" => $arComment['LINK'],
				"EMAIL" => $arComment['USER_EMAIL'],
			);
			CEvent::Send($this->arParams['EMAIL_EVENT_TYPE_USER_MODERATE_COMMENT'], SITE_ID, $arEvent);
		}
	}

	function doSendUserAnswerAdmin($commentId) {
		if ($this->arParams['SEND_EMAIL_ADMIN_ANSWER']) {
			$arComment = $this->doGetCommentInfo($commentId);
			$arEvent = array(
				"COMMENT_LINK" => $arComment['LINK'],
				"EMAIL" => $arComment['USER_EMAIL'],
			);
			CEvent::Send($this->arParams['EMAIL_EVENT_TYPE_USER_ADMINANSWER_COMMENT'], SITE_ID, $arEvent);
		}
	}

	function doGetCommentInfo($ID) {
		global $APPLICATION;
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
			"PROPERTY_LINKED_ELEMENT" => $this->arParams["LINK_ELEMENT_ID"],
			"ID" => $ID
		);
		$arSelect = array(
			"ID",
			"NAME",
			"CODE",
			"DATE_CREATE",
			"ACTIVE_FROM",
			"ACTIVE_TO",
			"ACTIVE",
			"CREATED_BY",
			"IBLOCK_ID",
			"TAGS",
			"PROPERTY_AUTHOR_NAME",
			"PROPERTY_AUTHOR_EMAIL",
		);
		$arSort = array();
		$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		if ($arElement = $rsElements->Fetch()) {
			if ($arElement['CREATED_BY'] > 0) {
				$rUser = CUser::GetByID($arElement['CREATED_BY']);
				if ($arUser = $rUser->GetNext()) {
					$arElement['USER'] = $arUser;
					if (strlen($arElement['PROPERTY_AUTHOR_NAME_VALUE']) <= 0) {
						$arElement["PROPERTY_AUTHOR_NAME_VALUE"] = CUser::FormatName("#NAME# #LAST_NAME#", $arElement['USER']);
					}
					if (strlen($arElement['PROPERTY_AUTHOR_EMAIL_VALUE']) <= 0) {
						$arElement["PROPERTY_AUTHOR_EMAIL_VALUE"] = $arElement['USER']['EMAIL'];
					}
				}
			}
			return array(
				"LINK" => 'http://' . $_SERVER['HTTP_HOST'] . $APPLICATION->GetCurPage() . "?findCommentId=" . $ID,
				"USER_EMAIL" => $arElement["PROPERTY_AUTHOR_EMAIL_VALUE"],
				"USER_NAME" => $arElement["PROPERTY_AUTHOR_NAME_VALUE"],
			);
		}
		return array();
	}

}

?>