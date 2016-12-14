<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//s($arResult);

$picture = CFile::ResizeImageGet(
	$arResult["PREVIEW_PICTURE"],
	array("width"=>"350", "height"=>"250"),
	BX_RESIZE_IMAGE_PROPORTIONAL, 
	false,  $arFilters = Array()
);
?>
<div class="services_detail">
	<article class="services_detail_item" itemscope itemtype="http://schema.org/Article">
<!--		<img src="<?/*=$picture["src"]*/?>" alt="<?/*=$arResult["NAME"]*/?>" title="<?/*=$arResult["NAME"]*/?>" itemprop="image" />-->
		<div itemprop="description">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>
	</article>
</div>