<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="webavk_ibcomments">
	<?
	$isStars = false;
	if ($arParams['USE_FEATURE_VOTE_CONV'] || $arParams['USE_FEATURE_VOTE_FUNC'] || $arParams['USE_FEATURE_VOTE_DESIGN'] || $arParams['USE_FEATURE_VOTE_WORK'] || $arParams['USE_FEATURE_VOTE_PRICE'])
		$isStars = true;
	?>

	<?
	if ($arResult['ALLOW_ADD']) {
		?>
		<div class="webavk_ibcomments_add_area">
			<div class="webavk_ibcomments_add_form" id="webavk_ibcomments_add_form">
				<form action="<?= POST_FORM_ACTION_URI ?>" method="post">
					<fieldset>
                        <h2><?=GetMessage("WEBAVK_COMP_HEADER") ?></h2>
						<?
						if ($arResult['EDIT_MODE'] && $arResult['COMMENT_ID'] > 0) {
							?>
							<input type="hidden" name="commentEdit" value="<?= $arResult['COMMENT_ID'] ?>"/>
							<?
						}
						?>
						<input type="hidden" name="COMMENT[IID]" value="<?= $arParams['IBLOCK_ID'] ?>"/>
						<input type="hidden" name="COMMENT[EID]" value="<?= $arParams['LINK_ELEMENT_ID'] ?>"/>
						<?= bitrix_sessid_post() ?>
						<table>
							<?
                            if ($arResult['IS_GUEST']) {
                                ?>
                                <tr>
                                    <th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_GUEST_NAME") ?>:<span class="required">*</span></th>
                                    <td>
                                        <input class="form-input" type="text" name="COMMENT[GUEST_NAME]" value="<?= htmlspecialchars($arResult['POST_COMMENT']['GUEST_NAME']) ?>" size="50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_GUEST_EMAIL") ?>:<span class="required">*</span></th>
                                    <td>
                                        <input class="form-input" type="text" name="COMMENT[GUEST_EMAIL]" value="<?= htmlspecialchars($arResult['POST_COMMENT']['GUEST_EMAIL']) ?>" size="50"/>
                                    </td>
                                </tr>
                                <?
                                if ($arParams['USE_CAPTCHA']) {
                                    ?>
                                    <tr>
                                        <td colspan="2"><b><?= GetMessage("WEBAVK_COMP_FORM_FIELD_CAPTCHA_TITLE") ?></b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="COMMENT[captcha_sid]" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
                                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?= GetMessage("WEBAVK_COMP_FORM_FIELD_GUEST_CAPTCHA") ?>:<span class="required">*</span></td>
                                        <td><input class="form-input" type="text" name="COMMENT[captcha_word]" maxlength="50" value="" /></td>
                                    </tr>
                                    <?
                                }
                            }
                            if ($arParams['USE_FEATURE_ADVANTAGES']) {
                                ?>
                                <tr>
                                    <th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_ADVANTAGES") ?>:<? if ($arResult['REQUIRED']["ADVANTAGES"]) { ?><span class="required">*</span><? } ?></th>
                                    <td><input class="form-input" name="COMMENT[ADVANTAGES]" rows="5" cols="60"><?= htmlspecialchars($arResult['POST_COMMENT']['ADVANTAGES']) ?></td>
                                </tr>
                                <?
                            }

							if ($arParams['USE_FEATURE_CONS']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_CONS") ?>:<? if ($arResult['REQUIRED']["CONS"]) { ?><span class="required">*</span><? } ?></th>
									<td><textarea name="COMMENT[CONS]" rows="5" cols="60"><?= htmlspecialchars($arResult['POST_COMMENT']['CONS']) ?></textarea></td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_REVIEW']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_REVIEW") ?>:<? if ($arResult['REQUIRED']["REVIEW"]) { ?><span class="required">*</span><? } ?></th>
									<td><textarea class="form-input" name="COMMENT[REVIEW]" rows="5" cols="60"><?= htmlspecialchars($arResult['POST_COMMENT']['REVIEW']) ?></textarea></td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_CONV']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_VOTE_CONV") ?>:<? if ($arResult['REQUIRED']["VOTE_CONV"]) { ?><span class="required">*</span><? } ?></th>
									<td>
										<?
										for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
											?>
											<a href="javascript:void(0)" onclick="doSetCommentVote('VOTE_CONV','<?= $i ?>')" onmouseover="doCommentVoteMouseOver('VOTE_CONV','<?= $i ?>')" onmouseout="doCommentVoteMouseOut('VOTE_CONV')" rel="VOTE_CONV" class="webavk_ibcomments_star<? if ($i <= $arResult['POST_COMMENT']['VOTE_CONV']) { ?> webavk_ibcomments_star_active<? } ?>"></a>
											<?
										}
										?>
										<input type="hidden" name="COMMENT[VOTE_CONV]" value="<?= $arResult['POST_COMMENT']['VOTE_CONV'] ?>"/>
									</td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_FUNC']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_VOTE_FUNC") ?>:<? if ($arResult['REQUIRED']["VOTE_FUNC"]) { ?><span class="required">*</span><? } ?></th>
									<td>
										<?
										for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
											?>
											<a href="javascript:void(0)" onclick="doSetCommentVote('VOTE_FUNC','<?= $i ?>')" onmouseover="doCommentVoteMouseOver('VOTE_FUNC','<?= $i ?>')" onmouseout="doCommentVoteMouseOut('VOTE_FUNC')" rel="VOTE_FUNC" class="webavk_ibcomments_star<? if ($i <= $arResult['POST_COMMENT']['VOTE_FUNC']) { ?> webavk_ibcomments_star_active<? } ?>"></a>
											<?
										}
										?>
										<input type="hidden" name="COMMENT[VOTE_FUNC]" value="<?= $arResult['POST_COMMENT']['VOTE_FUNC'] ?>"/>
									</td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_DESIGN']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_VOTE_DESIGN") ?>:<? if ($arResult['REQUIRED']["VOTE_DESIGN"]) { ?><span class="required">*</span><? } ?></th>
									<td>
										<?
										for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
											?>
											<a href="javascript:void(0)" onclick="doSetCommentVote('VOTE_DESIGN','<?= $i ?>')" onmouseover="doCommentVoteMouseOver('VOTE_DESIGN','<?= $i ?>')" onmouseout="doCommentVoteMouseOut('VOTE_DESIGN')" rel="VOTE_DESIGN" class="webavk_ibcomments_star<? if ($i <= $arResult['POST_COMMENT']['VOTE_DESIGN']) { ?> webavk_ibcomments_star_active<? } ?>"></a>
											<?
										}
										?>
										<input type="hidden" name="COMMENT[VOTE_DESIGN]" value="<?= $arResult['POST_COMMENT']['VOTE_DESIGN'] ?>"/>
									</td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_WORK']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_VOTE_WORK") ?>:<? if ($arResult['REQUIRED']["VOTE_WORK"]) { ?><span class="required">*</span><? } ?></th>
									<td>
										<?
										for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
											?>
											<a href="javascript:void(0)" onclick="doSetCommentVote('VOTE_WORK','<?= $i ?>')" onmouseover="doCommentVoteMouseOver('VOTE_WORK','<?= $i ?>')" onmouseout="doCommentVoteMouseOut('VOTE_WORK')" rel="VOTE_WORK" class="webavk_ibcomments_star<? if ($i <= $arResult['POST_COMMENT']['VOTE_WORK']) { ?> webavk_ibcomments_star_active<? } ?>"></a>
											<?
										}
										?>
										<input type="hidden" name="COMMENT[VOTE_WORK]" value="<?= $arResult['POST_COMMENT']['VOTE_WORK'] ?>"/>
									</td>
								</tr>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_PRICE']) {
								?>
								<tr>
									<th><?= GetMessage("WEBAVK_COMP_FORM_FIELD_VOTE_PRICE") ?>:<? if ($arResult['REQUIRED']["VOTE_PRICE"]) { ?><span class="required">*</span><? } ?></th>
									<td>
										<?
										for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
											?>
											<a href="javascript:void(0)" onclick="doSetCommentVote('VOTE_PRICE','<?= $i ?>')" onmouseover="doCommentVoteMouseOver('VOTE_PRICE','<?= $i ?>')" onmouseout="doCommentVoteMouseOut('VOTE_PRICE')" rel="VOTE_PRICE" class="webavk_ibcomments_star<? if ($i <= $arResult['POST_COMMENT']['VOTE_PRICE']) { ?> webavk_ibcomments_star_active<? } ?>"></a>
											<?
										}
										?>
										<input type="hidden" name="COMMENT[VOTE_PRICE]" value="<?= $arResult['POST_COMMENT']['VOTE_PRICE'] ?>"/>
									</td>
								</tr>
								<?
							}

							?>
							<tr>
<!--								<td>

								</td>-->
								<td colspan="2" class="webavk_ibcomments_add_form_note">
                                    <div class="center">
                                       <input type="submit" name="send" value="<?= GetMessage("WEBAVK_COMP_FORM_SUBMIT") ?>"/>
                                    </div>
									<?/*= GetMessage("WEBAVK_COMP_FORM_FIELD_NOTE") */?>
								</td>
							</tr>
						</table>
					</fieldset>
				</form>
			</div>
		</div>
		<?
	}
	if ($arResult['IS_ADMIN'] && $arParams['USE_FEATURE_ADMIN_ANSWER']) {
		?>
		<div class="webavk_ibcomments_answer_area" id="webavk_ibcomments_answer_area" style="display: <? if (count($arResult['POST_ANSWER']) > 0) echo "block"; else echo "none"; ?>;">
			<h3><?= GetMessage("WEBAVK_COMP_ADMIN_ANSWER") ?></h3>
			<form action="<?= POST_FORM_ACTION_URI ?>" method="post">
				<fieldset>
					<input type="hidden" name="ANSWER[COMMENT_ID]" value="<?= $arResult['POST_ANSWER']['COMMENT_ID'] ?>"/>
					<input type="hidden" name="ANSWER[IID]" value="<?= $arParams['IBLOCK_ID'] ?>"/>
					<input type="hidden" name="ANSWER[EID]" value="<?= $arParams['LINK_ELEMENT_ID'] ?>"/>
					<?= bitrix_sessid_post() ?>
					<table>
						<tr>
							<td><textarea name="ANSWER[TEXT]" rows="5" cols="60"><?= htmlspecialchars($arResult['POST_ANSWER']['TEXT']) ?></textarea></td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="sendadminanswer" value="<?= GetMessage("WEBAVK_COMP_FORM_SUBMIT_ANSWER") ?>"/>
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
		</div>
		<?
	}
	if ($arParams['ALLOW_SORT']) {
		?>
		<script type="text/javascript">
			<!--
			function doWebAvkCommentsSortTypeChange(el)
			{
				document.location='<?
	$page = $APPLICATION->GetCurPageParam("", array("commentsort"));
	$ar = parse_url($page);
	if (strlen($ar['query']) > 0) {
		echo $page . "&";
	} else {
		echo $page . "?";
	}
	?>commentsort='+el.value;
		}
		-->
		</script>
		<?
	}
	if ($arParams['DISPLAY_TOP_PAGER'] == "Y") {
		?>
		<table class="webavk_ibcomments_item_pager_sort">
			<tr>
				<td><?= $arResult['NAV_STRING']; ?></td>
				<td class="webavk_ibcomments_item_sort_area">
					<?
					if ($arParams['ALLOW_SORT']) {
						?>
						<select onchange="doWebAvkCommentsSortTypeChange(this)">
							<option value=""><?= GetMessage("WEBAVK_COMP_COMMENTS_SORT_DEFAULT") ?></option>
							<?
							foreach ($arParams['ALLOW_SORT_VARIANTS'] as $variantSort) {
								?>
								<option value="<?= $variantSort ?>"<? if ($arParams['CURRENT_SORT'] == $variantSort) { ?> selected="selected"<? } ?>><?= GetMessage("WEBAVK_COMP_COMMENTS_SORT_" . $variantSort) ?></option>
								<?
							}
							?>
						</select>
						<?
					}
					?>
				</td>
			</tr>
		</table>
		<?
	}

	foreach ($arResult['ITEMS'] as $arItem) {
		?>
		<div class="webavk_ibcomments_item<?= (($arResult['IS_MODERATOR'] || $arResult['IS_ADMIN']) && $arItem['ACTIVE'] != "Y" ? " webavk_ibcomments_item_nomoderate" : "") ?> webavk_ibcomments_item_<?= $arItem['ID'] ?>">
			<table width="100%">
				<tr>
					<td class="webavk_ibcomments_user">
						<a name="comment<?= $arItem['ID'] ?>"></a>
						<?
						if ($arParams['SHOW_AVATARS']) {
							if (strlen($arItem['PERSONAL_PHOTO']['SRC']) > 0) {
								echo CFile::ShowImage($arItem['PERSONAL_PHOTO']['SRC'], 50, 50);
							} elseif ($arParams['USE_GRAVATARS']) {
								?>
								<img src="<?= $arItem['GRAVATAR_SRC'] ?>" />
								<?
							}
						} elseif ($arParams['USE_GRAVATARS']) {
							?>
							<img src="<?= $arItem['GRAVATAR_SRC'] ?>" />
							<?
						}
						?>
						<?= $arItem["PROPERTIES"]['AUTHOR_NAME']['VALUE'] ?> <span class="date">(<?= $arItem['FORMAT_DATE_CREATE'] ?>)</span>
					</td>
					<td class="webavk_ibcomments_helpful_area">
						<?
						if ($arResult['IS_MODERATOR']) {
							?>
							<div class="webavk_ibcomments_item_moderatearea" title="<?= GetMessage("WEBAVK_COMP_MODERATOR_PANEL") ?>">
								<?
								if ($arItem['ACTIVE'] == "Y") {
									?>
									<a href="<?= $APPLICATION->GetCurPageParam("action=hidecomment&commentid=" . $arItem['ID'], array("action", "commentid")) ?>" title="<?= GetMessage("WEBAVK_COMP_MODERATOR_HIDE_COMMENT") ?>" class="webavk_ibcomments_item_moderatearea_modfalse"><span><?= GetMessage("WEBAVK_COMP_MODERATOR_HIDE_COMMENT") ?></span></a>
									<?
								} else {
									?>
									<a href="<?= $APPLICATION->GetCurPageParam("action=showcomment&commentid=" . $arItem['ID'], array("action", "commentid")) ?>" title="<?= GetMessage("WEBAVK_COMP_MODERATOR_SHOW_COMMENT") ?>" class="webavk_ibcomments_item_moderatearea_modok"><span><?= GetMessage("WEBAVK_COMP_MODERATOR_SHOW_COMMENT") ?></span></a>
									<?
								}
								?>
								<a href="<?= $APPLICATION->GetCurPageParam("commentEdit=" . $arItem['ID'], array("action", "commentid", "commentEdit")) ?>" title="<?= GetMessage("WEBAVK_COMP_MODERATOR_EDIT_COMMENT") ?>" class="webavk_ibcomments_item_moderatearea_modedit"><span><?= GetMessage("WEBAVK_COMP_MODERATOR_EDIT_COMMENT") ?></span></a>
								<a href="javascript:if (confirm('<?= GetMessage("WEBAVK_COMP_MODERATOR_DELETE_COMMENT_CONFIRM") ?>')){window.location='<?= $APPLICATION->GetCurPageParam("action=deletecomment&commentid=" . $arItem['ID'], array("action", "commentid")) ?>';}" title="<?= GetMessage("WEBAVK_COMP_MODERATOR_DELETE_COMMENT") ?>" class="webavk_ibcomments_item_moderatearea_moddel"><span><?= GetMessage("WEBAVK_COMP_MODERATOR_DELETE_COMMENT") ?></span></a>
							</div>
							<?
						}
						if ($arParams['USE_FEATURE_HELPFUL']) {
							?>
					<noindex>
						<span class="webavk_ibcomments_helpul_plus_cnt"><?= intval($arItem['PROPERTIES']['HELPFUL_PLUS']['VALUE']) ?></span>&nbsp;<a href="<?= $APPLICATION->GetCurPageParam("action=helpfulplus&commentid=" . $arItem['ID'], array("action", "commentid")) ?>" class="webavk_ibcomments_helpul_plus_link" rel="nofollow" title="<?= GetMessage("WEBAVK_COMP_HELPFUL_PLUS") ?>"><span><?= GetMessage("WEBAVK_COMP_HELPFUL_PLUS") ?></span></a> / <span class="webavk_ibcomments_helpul_minus_cnt"><?= intval($arItem['PROPERTIES']['HELPFUL_MINUS']['VALUE']) ?></span>&nbsp;<a href="<?= $APPLICATION->GetCurPageParam("action=helpfulminus&commentid=" . $arItem['ID'], array("action", "commentid")) ?>" class="webavk_ibcomments_helpul_minus_link" rel="nofollow" title="<?= GetMessage("WEBAVK_COMP_HELPFUL_MINUS") ?>"><span><?= GetMessage("WEBAVK_COMP_HELPFUL_MINUS") ?></span></a>
					</noindex>
				<? } ?>
				</td>
				</tr>
				<tr<? if ($arItem['IS_HIDE']) { ?> class="webavk_ibcomments_helpul_rating_hide_<?= $arItem['ID'] ?>" style="display:none;"<? } ?>>
					<td<? if (!$isStars) { ?> colspan="2"<? } ?>>
						<?
						//myPrint($arItem['PROPERTIES']['ADVANTAGES']['~VALUE']['TEXT']);
						if ($arParams['USE_FEATURE_ADVANTAGES'] && strlen($arItem['PROPERTIES']['ADVANTAGES']['~VALUE']['TEXT']) > 0) {
							?>
							<div class="webavk_ibcomments_text_area webavk_ibcomments_advantage">
								<!--<h3><?/*= GetMessage("WEBAVK_COMP_ADVANTAGES") */?></h3>-->
								<div class="webavk_ibcomments_text_area_content webavk_ibcomments_advantage_content">
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
								<h3><?= GetMessage("WEBAVK_COMP_REVIEW") ?></h3>
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
					</td>
					<? if ($isStars) { ?>
						<td class="webavk_ibcomments_stars_area">
							<?
							if ($arParams['USE_FEATURE_VOTE_CONV']) {
								?>
								<div class="webavk_ibcomments_stars_block">
									<h3><?= GetMessage("WEBAVK_COMP_FEATURE_VOTE_CONV") ?>:</h3>
									<?
									for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
										if ($i <= $arItem['PROPERTIES']['VOTE_CONV']['VALUE']) {
											?>
											<span class="webavk_ibcomments_star webavk_ibcomments_star_active"></span>
											<?
										} else {
											?>
											<span class="webavk_ibcomments_star"></span>
											<?
										}
									}
									?>
								</div>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_FUNC']) {
								?>
								<div class="webavk_ibcomments_stars_block">
									<h3><?= GetMessage("WEBAVK_COMP_FEATURE_VOTE_FUNC") ?>:</h3>
									<?
									for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
										if ($i <= $arItem['PROPERTIES']['VOTE_FUNC']['VALUE']) {
											?>
											<span class="webavk_ibcomments_star webavk_ibcomments_star_active"></span>
											<?
										} else {
											?>
											<span class="webavk_ibcomments_star"></span>
											<?
										}
									}
									?>
								</div>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_DESIGN']) {
								?>
								<div class="webavk_ibcomments_stars_block">
									<h3><?= GetMessage("WEBAVK_COMP_FEATURE_VOTE_DESIGN") ?>:</h3>
									<?
									for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
										if ($i <= $arItem['PROPERTIES']['VOTE_DESIGN']['VALUE']) {
											?>
											<span class="webavk_ibcomments_star webavk_ibcomments_star_active"></span>
											<?
										} else {
											?>
											<span class="webavk_ibcomments_star"></span>
											<?
										}
									}
									?>
								</div>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_WORK']) {
								?>
								<div class="webavk_ibcomments_stars_block">
									<h3><?= GetMessage("WEBAVK_COMP_FEATURE_VOTE_WORK") ?>:</h3>
									<?
									for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
										if ($i <= $arItem['PROPERTIES']['VOTE_WORK']['VALUE']) {
											?>
											<span class="webavk_ibcomments_star webavk_ibcomments_star_active"></span>
											<?
										} else {
											?>
											<span class="webavk_ibcomments_star"></span>
											<?
										}
									}
									?>
								</div>
								<?
							}
							if ($arParams['USE_FEATURE_VOTE_PRICE']) {
								?>
								<div class="webavk_ibcomments_stars_block">
									<h3><?= GetMessage("WEBAVK_COMP_FEATURE_VOTE_PRICE") ?>:</h3>
									<?
									for ($i = 1; $i <= $arParams['MAX_VOTE']; $i++) {
										if ($i <= $arItem['PROPERTIES']['VOTE_PRICE']['VALUE']) {
											?>
											<span class="webavk_ibcomments_star webavk_ibcomments_star_active"></span>
											<?
										} else {
											?>
											<span class="webavk_ibcomments_star"></span>
											<?
										}
									}
									?>
								</div>
								<?
							}
							?>
						</td>
					<? } ?>
				</tr>
				<tr<? if ($arItem['IS_HIDE']) { ?> class="webavk_ibcomments_helpul_rating_hide_<?= $arItem['ID'] ?>" style="display:none;"<? } ?>>
					<td colspan="2" class="webavk_ibcomments_admin_answer_<?= $arItem['ID'] ?>">
						<?
						if ($arParams['USE_FEATURE_ADMIN_ANSWER'] && strlen($arItem['PROPERTIES']['ADMIN_ANSWER']['~VALUE']['TEXT']) > 0) {
							?>
							<div class="webavk_ibcomments_admin_answer">
								<h3><?= GetMessage("WEBAVK_COMP_ADMIN_ANSWER") ?> <!--<span>(<?/*= $arItem["PROPERTIES"]['ADMIN_ANSWER_DATE']['FROMAT_VALUE'] */?>)</span>--></h3>
								<div class="webavk_ibcomments_admin_answer_content">
									<?
									if ($arItem['PROPERTIES']['ADMIN_ANSWER']['~VALUE']['TYPE'] == "TEXT") {
										echo nl2br($arItem['PROPERTIES']['ADMIN_ANSWER']['VALUE']['TEXT']);
									} else {
										echo $arItem['PROPERTIES']['ADMIN_ANSWER']['~VALUE']['TEXT'];
									}
									?>
								</div>
							</div>
							<?
							if ($arResult['IS_ADMIN'] && $arParams['USE_FEATURE_ADMIN_ANSWER']) {
								?>
								<input type="hidden" name="adminAnswer<?= $arItem['ID'] ?>" value="<?= htmlspecialchars($arItem['PROPERTIES']['ADMIN_ANSWER']['~VALUE']['TEXT']) ?>"/>
								<div class="webavk_ibcomments_item_add_answer">
									<a href="javascript:void(0)" onclick="doShowAdminAnswerForm(<?= $arItem['ID'] ?>)"><?= GetMessage("WEBAVK_COMP_ADD_ANSWER_EDIT") ?></a>
								</div>
								<?
							}
						} elseif ($arResult['IS_ADMIN'] && $arParams['USE_FEATURE_ADMIN_ANSWER']) {
							?>
							<div class="webavk_ibcomments_item_add_answer">
								<a href="javascript:void(0)" onclick="doShowAdminAnswerForm(<?= $arItem['ID'] ?>)"><?= GetMessage("WEBAVK_COMP_ADD_ANSWER") ?></a>
							</div>
							<?
						}
						?>
					</td>
				</tr>
				<?
				if ($arItem['IS_HIDE']) {
					?>
					<tr class="webavk_ibcomments_helpul_rating_hide_<?= $arItem['ID'] ?>" style="display:table-row;">
						<td colspan="2">
							<?= GetMessage("WEBAVK_COMP_COMMENT_IS_HIDE") ?>
						</td>
					</tr>
					<tr class="webavk_ibcomments_helpul_rating_hide_link">
						<td colspan="2">
							<a href="javascript:void(0)" onclick="doToggleHelpfulMinusRating(<?= $arItem['ID'] ?>)"><span><?= GetMessage("WEBAVK_COMP_COMMENT_IS_HIDE_TOGLE_LINK") ?></span></a>
						</td>
					</tr>
				<? }
				?>
			</table>
		</div>
		<?
	}

	if ($arParams['DISPLAY_BOTTOM_PAGER'] == "Y") {
		?>
		<table class="webavk_ibcomments_item_pager_sort">
			<tr>
				<td><?= $arResult['NAV_STRING']; ?></td>
				<td class="webavk_ibcomments_item_sort_area">
					<?
					if ($arParams['ALLOW_SORT']) {
						?>
						<select onchange="doWebAvkCommentsSortTypeChange(this)">
							<option value=""><?= GetMessage("WEBAVK_COMP_COMMENTS_SORT_DEFAULT") ?></option>
							<?
							foreach ($arParams['ALLOW_SORT_VARIANTS'] as $variantSort) {
								?>
								<option value="<?= $variantSort ?>"<? if ($arParams['CURRENT_SORT'] == $variantSort) { ?> selected="selected"<? } ?>><?= GetMessage("WEBAVK_COMP_COMMENTS_SORT_" . $variantSort) ?></option>
								<?
							}
							?>
						</select>
						<?
					}
					?>
				</td>
			</tr>
		</table>
		<?
	}
	?>
</div>