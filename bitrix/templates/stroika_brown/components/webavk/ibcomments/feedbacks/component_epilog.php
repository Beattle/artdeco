<?
if ($arResult['ALLOW_ADD'] || ($arParams['ALLOW_EDIT'] && in_array($USER->GetID(), $arResult['IDS']))) {
	CJSCore::Init();
}
if ($arParams['ALLOW_EDIT']) {
	if (in_array($USER->GetID(), $arResult['IDS'])) {
		?>
		<script type="text/javascript">
			<!--
		<?
		foreach ($arResult['IDS'] as $id => $uid) {
			if ($uid == $USER->GetID()) {
				?>
							itemComment=BX.findChildren(BX.findChildren(document.body, {className: 'webavk_ibcomments_item_<?= $id ?>'}, true)[0],{className: 'webavk_ibcomments_user'},true);
							if (itemComment.length>0)
							{
								itemComment[0].appendChild(BX.create('A', {
									props: {className: 'webavk_ibcomments_item_itemlink'},
									attrs: {href: '?commentEdit=<?= $id ?>'},
								//	html: '[<?= GetMessage("WEBAVK_IBCOMMENTS_USER_EDIT") ?>]'
								}));
							}
																							
				<?
			}
		}
		?>
			-->
		</script>
		<?
	}
}
?>