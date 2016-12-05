<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	//s($arItem);
	$img_services = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width"=>"600","height"=>"350"),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		false,  $arFilters = Array()
	);
	?>
	<div class="services_element">
		<div>
			<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="animation_img">
				<span class="overlay"></span>
				<img src="<?=$img_services["src"];?>" alt="<?=$arItem["NAME"];?>" />
				<span class="link"><i class="fa fa-link"></i></span>
			</a>
			<p><a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["NAME"];?></a></p>
		</div>
	</div>
<?endforeach;?>