<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" id="request_call_form">
<?
$frame = $this->createFrame("request_call_form", false)->begin();
?>
	<input type="hidden" name="sessid" id="sessid_form_3" value="" />
	<script>
		BX.ready(function(){
			var value = BX.bitrix_sessid();
			document.getElementById("sessid_form_3").value = value;
		})
	</script>
	<label>
		<span><?=GetMessage("MFT_NAME");?></span>
		<input placeholder="<?=GetMessage("DEMO_NAME");?>" type="text" name="name" required="required" class="form-input" />
	</label>
	<label>
		<span><?=GetMessage("MFT_PHONE");?></span>
		<input placeholder="+7(945) 849-01-76" type="tel" name="phone" required="required" class="form-input" />
	</label>	
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" value="<?=GetMessage("SEND");?>" />
	<?$frame->end();?>
</form>
<script>
$("#request_call_form input[type='submit']").click(function(e){
		var name = $.trim($("#request_call_form input[name='name']").val());
		var phone = $.trim($("#request_call_form input[name='phone']").val());
		var dopusk = false;//если false, то разрешаем отправку данных
		var mailTo = false;//если false, то phone корректный
		
		if(name == ''){ $("#request_call_form input[name='name']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#request_call_form input[name='name']").css({'border': '1px solid #cccccc'});} 
		if(phone == ''){ $("#request_call_form input[name='phone']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#request_call_form input[name='phone']").css({'border': '1px solid #cccccc'});} 
		if((dopusk == false) && (mailTo == false)){
			$.post('/ajax_script/sendMail.php', {action: "send", name: name, phone: phone, event_message_id: 7}, function(data){
				$("#request_call").css("display","none");
				$('.dialog').css("display","block").removeClass("dialog-close").addClass("dialog-open");
				$(".background").css("display","block");
				$("#request_call_form").trigger('reset');
			}, 'html');
		}
		e.preventDefault();
	});
	
	$("#request_call_form input[name='name']").focus(function(e){ $("#request_call_form input[name='name']").css({'border': '1px solid #cccccc'}); })
	$("#request_call_form input[name='name']").focusout(function(e){ if($.trim($("#request_call_form input[name='name']").val()) == ''){ $("#request_call_form input[name='name']").css({'border': '1px solid #ff0000'});} else{ $("#request_call_form input[name='name']").css({'border': '1px solid #cccccc'});} });
	
	$("#request_call_form input[name='phone']").focus(function(e){ $("#request_call_form input[name='phone']").css({'border': '1px solid #cccccc'}); })
	$("#request_call_form input[name='phone']").focusout(function(e){ if($.trim($("#request_call_form input[name='phone']").val()) == ''){ $("#request_call_form input[name='phone']").css({'border': '1px solid #ff0000'});} else{ $("#request_call_form input[name='phone']").css({'border': '1px solid #cccccc'});}});
</script>