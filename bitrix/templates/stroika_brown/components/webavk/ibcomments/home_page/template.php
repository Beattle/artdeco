<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="webavk_ibcomments">
	<?
	foreach ($arResult['ITEMS'] as $arItem) {?>
		<div class="webavk_ibcomments_item com_box <?= (($arResult['IS_MODERATOR'] || $arResult['IS_ADMIN']) && $arItem['ACTIVE'] != "Y" ? " webavk_ibcomments_item_nomoderate" : "") ?> webavk_ibcomments_item_<?= $arItem['ID'] ?>">


					<div class="webavk_ibcomments_user">
                        <span class="date">
                            <?= $arItem['FORMAT_DATE_CREATE'] ?>
                        </span>
						<span class="user-name">
                            <?= $arItem["PROPERTIES"]['AUTHOR_NAME']['VALUE'] ?>
                        </span>
					</div>



						<?
						if ($arParams['USE_FEATURE_ADVANTAGES'] && strlen($arItem['PROPERTIES']['ADVANTAGES']['~VALUE']['TEXT']) > 0) {
							?>
							<div class="webavk_ibcomments_text_area webavk_ibcomments_address">
								<div class="webavk_ibcomments_text_area_content webavk_ibcomments_address">
									<?
									if ($arItem['PROPERTIES']['ADVANTAGES']['VALUE']['TYPE'] == "TEXT") {
										echo nl2br($arItem['PROPERTIES']['ADVANTAGES']['VALUE']['TEXT']);
									} else {
										echo $arItem['PROPERTIES']['ADVANTAGES']['~VALUE']['TEXT'];
									}
									?>
								</div>
							</div>
							<?
						}
						if ($arParams['USE_FEATURE_CONS'] && strlen($arItem['PROPERTIES']['CONS']['~VALUE']['TEXT']) > 0) {
							?>
							<div class="webavk_ibcomments_text_area webavk_ibcomments_cons">
								<h3><?= GetMessage("WEBAVK_COMP_CONS") ?></h3>
								<div class="webavk_ibcomments_text_area_content webavk_ibcomments_cons_content">
									<?
									if ($arItem['PROPERTIES']['CONS']['~VALUE']['TYPE'] == "TEXT") {
										echo nl2br($arItem['PROPERTIES']['CONS']['VALUE']['TEXT']);
									} else {
										echo $arItem['PROPERTIES']['CONS']['~VALUE']['TEXT'];
									}
									?>
								</div>
							</div>
							<?
						}
						if ($arParams['USE_FEATURE_REVIEW'] && strlen($arItem['PROPERTIES']['REVIEW']['~VALUE']['TEXT']) > 0) {
							?>
							<div class="webavk_ibcomments_text_area webavk_ibcomments_review">
								<div class="webavk_ibcomments_text_area_content webavk_ibcomments_review_content">
									<?
									if ($arItem['PROPERTIES']['REVIEW']['~VALUE']['TYPE'] == "TEXT") {
										echo nl2br($arItem['PROPERTIES']['REVIEW']['VALUE']['TEXT']);
									} else {
										echo $arItem['PROPERTIES']['REVIEW']['~VALUE']['TEXT'];
									}
									?>
								</div>
							</div>
							<?
						}
						?>



		</div>
		<?
	}

	?>
</div>