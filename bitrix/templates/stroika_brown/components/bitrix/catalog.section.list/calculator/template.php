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
<div class="calculator">
	<div class="total_price">
		<div style="padding:15px;">
			<?=GetMessage("ITOG");?>
			<p><span>0</span> <?=GetMessage("RUB");?></p>
		</div>
	</div>
	<table>
		<thead>
			<tr>
				<td class="column_1"><?=GetMessage("COL_1");?></td>
				<td class="column_2 name"><?=GetMessage("COL_2");?></td> 
				<td class="column_3"><?=GetMessage("COL_3");?></td>
				<td colspan='3' class="column_4"><?=GetMessage("COL_4");?></td>
			</tr> 
		</thead>
		<tbody>
		<?
		foreach($arResult["SECTIONS"] as $key => $arSection)
		{
			$id_price = 0;
		?>
		<tr><td colspan='6' class='table_title'><h2 id="<?=$arSection["ID"];?>"><?=$arSection["NAME"];?></h2></td></tr>
		<?
			foreach($arSection["ELEMENTS"] as $arElement){
				$id_price+=1;
		?>	
			<tr>
				<td class="column_1"><?=$id_price;?></td>
				<td class="column_2 name"><?=$arElement["NAME"];?></td> 
				<td class="column_3"><?=$arElement["PROPERTY_SYMBOL_VALUE"];?></td>
				<td class="column_4 price"><?=$arElement["PROPERTY_PRICE_VALUE"];?> <?=GetMessage("RUB");?></td>
				<td class="column_5"><input id-element="<?=$arElement["ID"]?>" data-price="<?=$arElement["PROPERTY_PRICE_VALUE"];?>" type="text" /></td>
				<td class="column_6"><?=GetMessage("ITOG_2");?> <span></span></td>
			</tr>
		<?}}?>
		</tbody>
	</table>
</div>
<div class="total_price_bottom">
		<?=GetMessage("ITOG");?> 
		<span>0</span> <?=GetMessage("RUB");?>
</div>
<div class="calculator_wrapper">
	<div class="print_csv">
		<a href="calculator.csv" download><?=GetMessage("PRINT");?></a>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".column_5 input").keyup(function(){
			var price;
			price = new Array();
			$(".column_5 input").each(function(indx, element){
				if($(".column_5 input").eq(indx).val()>0)
				{
					price[$(".column_5 input").eq(indx).attr("id-element")] = $(".column_5 input").eq(indx).val();
				}
			});
			$.ajax({ //обновляем корзину в шапке
				type: "POST",
				url: "<?=SITE_DIR?>calculator/csv.php",
				data: {price:price},
				dataType: "html",
				success: function(data)
				{
					
				}
			});
		});
	});
</script>