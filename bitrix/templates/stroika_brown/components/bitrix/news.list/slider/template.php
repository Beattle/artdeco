<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$slider = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width"=>"1600","height"=>"450"),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false,  $arFilters = Array()
		);
		// echo '<pre>'.print_r($arItem,true).'</pre>';
		?>

        <a href="<?=$arItem['PROPERTIES']['SLIDER_URL']['VALUE']?>" class="sl_link">
			<img class="slides_images" src="<?=$slider["src"];?>" alt="<?=$arItem["NAME"];?>" />
        </a>
	<?endforeach;?>
<a href="#" class="prev slidesjs-previous slidesjs-navigation"></a>
<a href="#" class="next slidesjs-next slidesjs-navigation"></a>
