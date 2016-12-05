<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$img_last_work = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width"=>"500","height"=>"200"),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		false,  $arFilters = Array()
	);
	?>
	<div class="last_work_element">
		<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="animation_img">
			<span class="overlay"></span>
			<img src="<?=$img_last_work["src"];?>" alt="<?=$arItem["NAME"];?>" />
			<span class="link"><i class="fa fa-link"></i></span>
		</a>
		<p><a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["NAME"];?></a></p>
		<span><?=$arItem["PREVIEW_TEXT"];?></span>
	</div>
<?endforeach;?>