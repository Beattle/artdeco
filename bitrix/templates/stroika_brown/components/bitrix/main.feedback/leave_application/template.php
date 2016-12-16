<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" id="leave_application_form">
<?
$frame = $this->createFrame("leave_application_form", false)->begin();
?>
	<input type="hidden" name="sessid" id="sessid_form_2" value="" />
	<script>
		BX.ready(function(){
			var value = BX.bitrix_sessid();
			document.getElementById("sessid_form_2").value = value;
		})
	</script>
	<label>
		<span><?=GetMessage("MFT_NAME");?></span>
		<input placeholder="<?/*=GetMessage("NAME_DEMO");*/?>" type="text" name="name" required="required" class="form-input" />
	</label>
	<label>
		<span><?=GetMessage("MFT_PHONE");?></span>
		<input placeholder="" type="tel" name="phone" required="required" class="form-input" />
	</label>	
	<label>	
		<span><?=GetMessage("MFT_EMAIL");?></span>
		<input placeholder="" type="email" name="email" required="required" class="form-input" />
	</label>
    <label>
        <span><?=GetMessage("MFT_MESSAGE")?></span>
        <textarea name="message" class="form-input"></textarea>
    </label>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" value="<?=GetMessage("SEND");?>" />
	<?$frame->end();?>
</form>
<script>
$("#leave_application_form input[type='submit']").click(function(e){
		var name = $.trim($("#leave_application_form input[name='name']").val());
		var phone = $.trim($("#leave_application_form input[name='phone']").val());
		var email = $.trim($("#leave_application_form input[name='email']").val());
		var dopusk = false;//если false, то разрешаем отправку данных
		var mailTo = false;//если false, то phone корректный
		
		if(name == ''){ $("#leave_application_form input[name='name']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#leave_application_form input[name='name']").css({'border': '1px solid #cccccc'});} 
		if(phone == ''){ $("#leave_application_form input[name='phone']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#leave_application_form input[name='phone']").css({'border': '1px solid #cccccc'});} 
		if(email == ''){ $("#leave_application_form input[name='email']").css({'border': '1px solid #ff0000'}); dopusk = true;} else{ $("#leave_application_form input[name='email']").css({'border': '1px solid #cccccc'}); if(!validate(email)){mailTo = true;}}
		if((dopusk == false) && (mailTo == false)){
			$.post('/ajax_script/sendMail.php', {action: "send", name: name, phone: phone, email: email, event_message_id: 8}, function(data){
				$("#leave_application").css("display","none");
				$('.dialog').css("display","block").removeClass("dialog-close").addClass("dialog-open");
				$(".background").css("display","block");
				$("#leave_application_form").trigger('reset');
			}, 'html');
		}
		e.preventDefault();
	});
	
	$("#leave_application_form input[name='email']").focus(function(e){ $("#leave_application_form input[name='email']").css({'border': '1px solid #cccccc'}); })
	$("#leave_application_form input[name='email']").focusout(function(e){ if($.trim($("#leave_application_form input[name='email']").val()) == ''){ $("#leave_application_form input[name='email']").css({'border': '1px solid #ff0000'});} else{ $("#leave_application_form input[name='email']").css({'border': '1px solid #cccccc'});}});
	
	$("#leave_application_form input[name='name']").focus(function(e){ $("#leave_application_form input[name='name']").css({'border': '1px solid #cccccc'}); })
	$("#leave_application_form input[name='name']").focusout(function(e){ if($.trim($("#leave_application_form input[name='name']").val()) == ''){ $("#leave_application_form input[name='name']").css({'border': '1px solid #ff0000'});} else{ $("#leave_application_form input[name='name']").css({'border': '1px solid #cccccc'});} });
	
	$("#leave_application_form input[name='phone']").focus(function(e){ $("#leave_application_form input[name='phone']").css({'border': '1px solid #cccccc'}); })
	$("#leave_application_form input[name='phone']").focusout(function(e){ if($.trim($("#leave_application_form input[name='phone']").val()) == ''){ $("#leave_application_form input[name='phone']").css({'border': '1px solid #ff0000'});} else{ $("#leave_application_form input[name='phone']").css({'border': '1px solid #cccccc'});}});

	function validate(email)
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(email) == false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
</script>