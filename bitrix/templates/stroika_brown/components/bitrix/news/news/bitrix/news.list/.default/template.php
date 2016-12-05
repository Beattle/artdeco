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
?>
<div class="news_section_block">
	<? $count = 0;
	foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$picture = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width"=>"700","height"=>"400"),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		false,  $arFilters = Array()
	);
	?>
	<?//s($arItem);?>
	<?if($count % 3 == 0) echo "<div class='three_block'>"; $count += 1;?>
		<article class="news_section_item" itemscope itemtype="http://schema.org/Article">
			<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="animation_img">
				<span class="overlay"></span>
				<img src="<?=$picture["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" itemprop="image" />
				<span class="link"><i class="fa fa-link"></i></span>
			</a>
			<div class="description">
				<h2>
					<a rel="bookmark" href="<?=$arItem["DETAIL_PAGE_URL"]?>" itemprop="name"><?=$arItem["NAME"]?></a>
				</h2>
				<div itemprop="description">
					<?=$arItem["PREVIEW_TEXT"];?>
				</div>
			</div>
			<p><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" itemprop="url">Читать далее</a></p>
		</article>
	<?if($count % 3 == 0) echo "</div>";?>
	<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>