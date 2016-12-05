<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Узнаем общее количество элементов в разделе
foreach($arResult["SECTIONS"] as $key => $arSection)
{
	$projects_element = CIBlockElement::GetList(false, array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arSection["ID"]), false, false, false);
	$all_count[$arSection["ID"]]=$projects_element->SelectedRowsCount();
}

if(isset($arParams["AJAX_ARRAY"]) && $arParams["AJAX_ARRAY"] != "")
{
	$arParams["AJAX_ARRAY"] = str_replace("'", "\"", $arParams["AJAX_ARRAY"]);
	$arTemp = object_to_array(json_decode($arParams["AJAX_ARRAY"]));
	foreach($arTemp as $key => $arSection)
	{		
		if($key == $arParams["GET_SECTION_ID"]){
			$arTemp[$key] += 4;
		}
	}
	foreach($arResult["SECTIONS"] as $key => $arSection)
	{
		$projects_element = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"SECTION_ID" => $arSection["ID"]), false, Array('nTopCount' => $arTemp[$arSection["ID"]]), 
		array("PREVIEW_PICTURE","NAME","PREVIEW_TEXT", "DETAIL_PAGE_URL"));
		while($projects_element_next = $projects_element -> GetNext()){
			$projects_element_next["PREVIEW_PICTURE"] = CFile::GetFileArray($projects_element_next["PREVIEW_PICTURE"]);
			$arResult["SECTIONS"][$key]["arTemp"] = $arTemp;
			$arResult["SECTIONS"][$key]["all_count"] = $all_count;
			$arResult["SECTIONS"][$key]["ELEMENTS"][] = $projects_element_next;
		}
	}
}
else
{
	foreach($arResult["SECTIONS"] as $key => $arSection)
	{
		$arTemp[$arSection["ID"]] = 4;
		$projects_element = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"SECTION_ID" => $arSection["ID"]), false, Array('nTopCount' => $arTemp[$arSection["ID"]]), 
		array("PREVIEW_PICTURE","NAME","PREVIEW_TEXT", "DETAIL_PAGE_URL"));
		while($projects_element_next = $projects_element -> GetNext()){
			$projects_element_next["PREVIEW_PICTURE"] = CFile::GetFileArray($projects_element_next["PREVIEW_PICTURE"]);
			$arResult["SECTIONS"][$key]["arTemp"] = $arTemp;
			$arResult["SECTIONS"][$key]["all_count"] = $all_count;
			$arResult["SECTIONS"][$key]["ELEMENTS"][] = $projects_element_next;
		}
	}
}

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

//s($arResult);
?>