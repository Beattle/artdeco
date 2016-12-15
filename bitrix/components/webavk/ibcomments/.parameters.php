<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
if (!CModule::IncludeModule("iblock"))
	return;
$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];

$arProperty = array();
$arProperty_LS = array();
$arProperty_N = array();
$arProperty_X = array();
if (0 < intval($arCurrentValues["IBLOCK_ID"])) {
	$rsProp = CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"], "ACTIVE" => "Y"));
	while ($arr = $rsProp->Fetch()) {
		if ($arr["PROPERTY_TYPE"] != "F")
			$arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];

		if ($arr["PROPERTY_TYPE"] == "L" || $arr["PROPERTY_TYPE"] == "S")
			$arProperty_LS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];

		if ($arr["PROPERTY_TYPE"] == "N")
			$arProperty_N[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];

		if ($arr["PROPERTY_TYPE"] != "F") {
			if ($arr["MULTIPLE"] == "Y")
				$arProperty_X[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
			elseif ($arr["PROPERTY_TYPE"] == "L")
				$arProperty_X[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
			elseif ($arr["PROPERTY_TYPE"] == "E" && $arr["LINK_IBLOCK_ID"] > 0)
				$arProperty_X[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
		}
	}
}
$arGroups = array();
$rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", Array("ACTIVE" => "Y"));
while ($arGroup = $rsGroups->Fetch()) {
	$arGroups[$arGroup["ID"]] = $arGroup["NAME"];
}
$arAscDesc = array(
	"asc" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_ASC"),
	"desc" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_DESC"),
);
$arSortVariants = array(
	"CREATE_DATE_ASC" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT_VARIANT_CREATE_DATE_ASC"),
	"CREATE_DATE_DESC" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT_VARIANT_CREATE_DATE_DESC"),
	"RATING_ASC" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT_VARIANT_RATING_ASC"),
	"RATING_DESC" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT_VARIANT_RATING_DESC"),
);
$arSortFields = Array(
	"ID" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_FIELD_ID"),
	"CREATED_DATE" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_FIELD_CREATED_DATE"),
	"SORT" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_FIELD_SORT"),
	"TIMESTAMP_X" => GetMessage("WEBAVK_IBCOMMENTS_COMMENTS_SORT_FIELD_TIMESTAMP_X")
);
$arComponentParameters = array(
	"GROUPS" => array(
		"VISUAL" => array(
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_GROUP_VISUAL"),
		),
		"SETTINGS" => array(
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_GROUP_SETTINGS"),
		),
		"FEATURES" => array(
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_GROUP_FEATURES"),
		),
		"UNAUTH_USERS" => array(
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_GROUP_UNAUTH_USERS"),
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_IBLOCK_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"LINK_ELEMENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_LINK_ELEMENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
		),
		"PAGE_ELEMENT_COUNT" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_PAGE_ELEMENT_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "10",
		),
		"SORT_BY" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SORT_BY"),
			"TYPE" => "LIST",
			"DEFAULT" => "CREATED_DATE",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SORT_ORDER"),
			"TYPE" => "LIST",
			"DEFAULT" => "desc",
			"VALUES" => $arAscDesc,
			"ADDITIONAL_VALUES" => "Y",
		),
		"USE_FEATURE_ADVANTAGES" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_ADVANTAGES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_CONS" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_CONS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_REVIEW" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_REVIEW"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_VOTE_CONV" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_VOTE_CONV"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_VOTE_FUNC" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_VOTE_FUNC"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_VOTE_DESIGN" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_VOTE_DESIGN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_VOTE_WORK" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_VOTE_WORK"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_VOTE_PRICE" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_VOTE_PRICE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_ADMIN_ANSWER" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_ADMIN_ANSWER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FEATURE_HELPFUL" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_FEATURE_HELPFUL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ALLOW_GUEST_COMMENTS" => array(
			"PARENT" => "UNAUTH_USERS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_GUEST_COMMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_CAPTCHA" => array(
			"PARENT" => "UNAUTH_USERS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"PREMODERATION" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_PREMODERATION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ALLOW_EDIT" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_EDIT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"GROUP_MODERATORS" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USER_GROUP_MODERATORS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arGroups,
			"DEFAULT" => "1"
		),
		"GROUP_ADMINISTRATION" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USER_GROUP_ADMINISTRATION"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arGroups,
			"DEFAULT" => "1"
		),
		"SEND_EMAIL_NEW_COMMENTS" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SEND_EMAIL_NEW_COMMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SEND_EMAIL_MODERATE_COMMENTS" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SEND_EMAIL_MODERATE_COMMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SEND_EMAIL_ADMIN_ANSWER" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SEND_EMAIL_ADMIN_ANSWER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"HIDE_COMMENT_NEGATIVE_RATING" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_HIDE_COMMENT_NEGATIVE_RATING"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ALLOW_SORT" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ALLOW_SORT_VARIANTS" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_ALLOW_SORT_VARIANTS"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arSortVariants,
			"MULTIPLE" => "Y",
		),
		"MAX_VOTE" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_MAX_VOTE"),
			"TYPE" => "STRING",
			"DEFAULT" => "5",
		),
		"SAVE_VOTES2ELEMENT" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SAVE_VOTES2ELEMENT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SHOW_AVATARS" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_SHOW_AVATARS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_GRAVATARS" => array(
			"PARENT" => "FEATURES",
			"NAME" => GetMessage("WEBAVK_IBCOMMENTS_USE_GRAVATARS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("WEBAVK_IBCOMMENTS_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),
		"CACHE_TIME" => Array("DEFAULT" => 360000),
	)
);
CIBlockParameters::AddPagerSettings($arComponentParameters, GetMessage("WEBAVK_IBCOMMENTS_PAGER"), true, true);
?>