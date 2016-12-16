<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
?>
<? //s($arResult); ?>

<div class="projects_top">
	<img src="<?=$arResult['PREVIEW_PICTURE']["SRC"];?>" title="<?=$arResult['NAME'];?>" alt="<?=$arResult['NAME'];?>" />
	<div class="projects_info">
		<p class="projects_info_title"><?=GetMessage("KR_OP");?></p>
		<?if(!empty($arResult['PROPERTIES']["CLIENT"]["VALUE"])):?><p><?=GetMessage("CLIENT");?> <span><?=$arResult['PROPERTIES']["CLIENT"]["VALUE"];?></span></p><?endif;?>
		<?if(!empty($arResult['PROPERTIES']["REPAIR"]["VALUE"])):?><p><?=GetMessage("REM");?> <span><?=$arResult['PROPERTIES']["REPAIR"]["VALUE"];?></span></p><?endif;?>
		<?if(!empty($arResult['PROPERTIES']["AREA"]["VALUE"])):?><p><?=GetMessage("AREA");?> <span><?=$arResult['PROPERTIES']["AREA"]["VALUE"];?></span></p><?endif;?>
		<?if(!empty($arResult['PROPERTIES']["TERMS"]["VALUE"])):?><p><?=GetMessage("DATE");?> <span><?=$arResult['PROPERTIES']["TERMS"]["VALUE"];?></span></p><?endif;?>
		<?if(!empty($arResult['PROPERTIES']["APARTMENT_PROJECT"]["VALUE"])):?><p><?=GetMessage("PROJECT");?> <span><?=$arResult['PROPERTIES']["APARTMENT_PROJECT"]["VALUE"];?></span></p><?endif;?>
		<?if(!empty($arResult['PROPERTIES']["APARTMENT_PROJECT_TEXT"]["VALUE"])):?><p class="apartment_project_text"><?=$arResult['PROPERTIES']["APARTMENT_PROJECT_TEXT"]["VALUE"];?></p><?endif;?>
	</div>
</div>

<?if(!empty($arResult['PROPERTIES']["GALLERY"]["VALUE"])):?>
<h2><?=GetMessage("FOTO_PROJECT");?></h2>
<div class="projects_photo">
	<?
	$projects_img = CIBlockElement::GetList(Array(), array("ID"=>$arResult['ID']), false, array(), array("PROPERTY_GALLERY"));
	while($img = $projects_img->GetNext(false,false))
	{
		$img = CFile::GetFileArray($img["PROPERTY_GALLERY_VALUE"]);
	?>	
		<a href="<?=$img["SRC"]?>" rel="catalog_img" class="animation_img">
			<span class="overlay"></span>
			<img src="<?=$img["SRC"]?>" title="<?=$arResult['NAME'];?>" alt="<?=$arResult['NAME'];?>" />
			<span class="link"><i class="fa fa-link"></i></span>
		</a>
	<?}?>
</div>
<?endif;?>
<?if(!empty($arResult['DETAIL_TEXT'])):?>
<h3><?=GetMessage("OP");?></h3>
<div class="projects_detail_text">
<?=$arResult['DETAIL_TEXT'];?>
</div>
<?endif;?>

<h2><?=GetMessage("INTERES");?></h2>
<div class="projects_interesting">
	<?
	$projects_interesting = CIBlockElement::GetList(Array("rand"=>"DESC"), array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y"), false, array("nTopCount"=>"4"), 
	array("PREVIEW_PICTURE", "NAME", "DETAIL_PAGE_URL"));
	while($interesting = $projects_interesting->GetNext(false,false))
	{
		$img = CFile::GetFileArray($interesting["PREVIEW_PICTURE"]);
		$img = CFile::ResizeImageGet(
			$img,
			array("width"=>"400","height"=>"150"),
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			false,  $arFilters = Array()
		);
	?>	
	<div class="projects_interesting_element">
		<a href="<?=$interesting['DETAIL_PAGE_URL'];?>" class="animation_img">
			<span class="overlay"></span>
			<img src="<?=$img["src"]?>" title="<?=$interesting['NAME'];?>" alt="<?=$interesting['NAME'];?>" />
			<span class="link"><i class="fa fa-link"></i></span>
		</a>
		<p><a href="<?=$interesting['DETAIL_PAGE_URL'];?>"><?=$interesting['NAME'];?></a></p>
	</div>
	<?}?>
</div>