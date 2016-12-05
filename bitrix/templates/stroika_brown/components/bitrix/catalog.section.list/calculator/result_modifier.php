<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach($arResult["SECTIONS"] as $key => $arSection)
{
	$projects_element = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"SECTION_ID" => $arSection["ID"]), false, false,array("ID","NAME","PROPERTY_PRICE", "PROPERTY_SYMBOL"));
	
	while($projects_element_next = $projects_element -> GetNext(false,false)){
		$arResult["SECTIONS"][$key]["ELEMENTS"][] = $projects_element_next;
	}
}

//s($arResult);
?>