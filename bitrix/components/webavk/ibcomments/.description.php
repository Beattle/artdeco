<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("WEBAVK_IBCOMMENTS_NAME"),
	"DESCRIPTION" => GetMessage("WEBAVK_IBCOMMENTS_DESCRIPTION"),
	"ICON" => "/images/component.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 100,
	"PATH" => array(
		"ID" => "webavk",
		"NAME" => GetMessage("WEBAVK_DESC_COMPONENTS"),
		"SORT" => 100,
		"CHILD" => array(
			"ID" => "talk",
			"NAME" => GetMessage("WEBAVK_DESC_COMPONENTS_TALK"),
			"SORT" => 100,
			"CHILD" => array(
				"ID" => "webavk_ibcomments",
			),
		),
	),
);

?>