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
<div class="price">
	<table>
	<thead>
	<tr>
		<td class="column_1"><?=GetMessage("COL_1");?></td>
		<td class="column_2 name"><?=GetMessage("COL_2");?></td>
		<td class="column_3"><?=GetMessage("COL_3");?></td>
		<td class="column_4"><?=GetMessage("COL_4");?></td>
	</tr>
	</thead>
	<tbody>
		<?
		foreach($arResult["SECTIONS"] as $key => $arSection)
		{
			$id_price = 0;
		?>
		<tr><td colspan='4' class='table_title'><h2><?=$arSection["NAME"];?></h2></td></tr>
		<?
			foreach($arSection["ELEMENTS"] as $arElement){
				$id_price+=1;
		?>	
			<tr>
				<td class="column_1"><?=$id_price;?></td>
				<td class="column_2 name"><?=$arElement["NAME"];?></td> 
				<td class="column_3"><?=$arElement["PROPERTY_SYMBOL_VALUE"];?></td>
				<td class="column_4 price"><?=$arElement["PROPERTY_PRICE_VALUE"];?> <?=GetMessage("RUB");?></td>
			</tr>
		<?}}?>
		</tbody>
	</table>
</div>