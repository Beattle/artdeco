<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<div class="slides_container">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		//s($arItem);
		$slider = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width"=>"2000","height"=>"550"),
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			false,  $arFilters = Array()
		);
		?>
		<div>
			<img class="slides_images" src="<?=$slider["src"];?>" alt="<?=$arItem["NAME"];?>" />
<!--			<div class='slide_text'>
				<div class="center_slide_text">
					<div class='title'><?=$arItem["NAME"];?></div>
					<div class='description'><?=$arItem["PREVIEW_TEXT"];?></div>
					<div class='more'><a href="<?=$arItem["PROPERTIES"]["SLIDER_URL"]["VALUE"];?>"><?=GetMessage("MORE");?></a></div>
				</div>
			</div> -->
			<div class="slider_background_black"></div>
		</div>
	<?endforeach;?>
</div>
<a href="#" class="prev"></a>
<a href="#" class="next"></a>