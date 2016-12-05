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
<div class="load_bg"></div>
<?
foreach($arResult["SECTIONS"] as $key => $arSection){
	$arTemp = $arSection["arTemp"];
}

$block_count = 5;

foreach($arResult["SECTIONS"] as $key => $arSection)
{
	$clear = 1;
?>

<h2><?=$arSection["NAME"]?></h2>
<div class='projects_block'>
<div>
<?
	foreach($arSection["ELEMENTS"] as $arElement){
		$picture = CFile::ResizeImageGet(
			$arElement["PREVIEW_PICTURE"],
			array("width"=>"500","height"=>"300"),
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			false,  $arFilters = Array()
		);
		if($clear % $block_count == 0) echo "</div>";
		if($clear % $block_count == 0) echo "<div>";
		$clear += 1;
	?>	
	<div class="projects_elemetnt">
		<a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="animation_img">
			<span class="overlay"></span>
			<img src="<?=$picture["src"];?>" alt="<?=$arElement["NAME"];?>" />
			<span class="link"><i class="fa fa-link"></i></span>
		</a>
		<p><a href="<?=$arElement["DETAIL_PAGE_URL"];?>"><?=$arElement["NAME"];?></a></p>
		<span><?=$arElement["PREVIEW_TEXT"];?></span>
	</div>
	<?	
	}
	echo "</div>";
	if($arSection["all_count"][$arSection["ID"]] > $arTemp[$arSection["ID"]]){
		$data_all_count = str_replace("\"", "'", json_encode($arTemp));
	?>
	<button data-all-count="<?print_r($data_all_count)?>" data-section-id="<?=$arSection["ID"]?>" data-site-id="<?=SITE_DIR?>"><?=GetMessage("MORE");?></button>
<?	
	}
echo "</div>";
}
?>