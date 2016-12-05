<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=POST_FORM_ACTION_URI?>" method="post" id="contact_phone">
<?
$frame = $this->createFrame("contact_phone", false)->begin();
?>
	<input type="hidden" name="sessid" id="sessid_form_1" value="" />
	<script>
		BX.ready(function(){
			var value = BX.bitrix_sessid();
			document.getElementById("sessid_form_1").value = value;
		})
	</script>
	<label><?=GetMessage("MFT_NAME");?><span class="required_star">*</span>
		<p>
			<input name="name" type="text" required="required" />
			<span class="fa icon_user"></span>
		</p>
	</label>
	<label><?=GetMessage("MFT_PHONE");?><span class="required_star">*</span>
		<p>
			<input name="phone" type="tel" required="required" />
			<span class="fa icon_phone"></span>
		</p>
	</label>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" value="<?=GetMessage("SEND");?>" />
	<?$frame->end();?>
</form>
<script>
$("#contact_phone input[type='submit']").click(function(e){
		var name = $.trim($("#contact_phone input[name='name']").val());
		var phone = $.trim($("#contact_phone input[name='phone']").val());
		var dopusk = false;//если false, то разрешаем отправку данных
		var mailTo = false;//если false, то phone корректный
		
		if(name == ''){ $("#contact_phone input[name='name']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#contact_phone input[name='name']").css({'border': '1px solid #cccccc'});} 
		if(phone == ''){ $("#contact_phone input[name='phone']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#contact_phone input[name='phone']").css({'border': '1px solid #cccccc'});} 
		if((dopusk == false) && (mailTo == false)){
			$.post('/ajax_script/sendMail.php', {action: "send", name: name, phone: phone, event_message_id: 7}, function(data){
				$('.dialog').css("display","block").removeClass("dialog-close").addClass("dialog-open");
				$(".background").css("display","block");
				$("#contact_phone").trigger('reset');
			}, 'html');
		}
		e.preventDefault();
	});
	
	$("#contact_phone input[name='name']").focus(function(e){ $("#contact_phone input[name='name']").css({'border': '1px solid #cccccc'}); })
	$("#contact_phone input[name='name']").focusout(function(e){ if($.trim($("#contact_phone input[name='name']").val()) == ''){ $("#contact_phone input[name='name']").css({'border': '1px solid #ff0000'});} else{ $("#contact_phone input[name='name']").css({'border': '1px solid #cccccc'});} });
	
	$("#contact_phone input[name='phone']").focus(function(e){ $("#contact_phone input[name='phone']").css({'border': '1px solid #cccccc'}); })
	$("#contact_phone input[name='phone']").focusout(function(e){ if($.trim($("#contact_phone input[name='phone']").val()) == ''){ $("#contact_phone input[name='phone']").css({'border': '1px solid #ff0000'});} else{ $("#contact_phone input[name='phone']").css({'border': '1px solid #cccccc'});}});
</script>