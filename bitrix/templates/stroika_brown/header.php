<?
IncludeTemplateLangFile(__FILE__);
$context = \Bitrix\Main\Application::getInstance()->getContext();

function bclass() {
    global $APPLICATION;
    $DirExp = explode('/', $APPLICATION->GetCurDir());
    $class ='';
    if ($DirExp[1] !== '')
        $class = ' class="'.$DirExp[1].'"';
    return $class;
}
?>
<!DOCTYPE HTML>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle(false);?></title>
	<meta property="og:site_name" content="Ваш сайт" />
	<meta property="og:locale" content="ru_RU" />
	<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>" />
	<meta property="og:image" content="<?=SITE_TEMPLATE_PATH;?>/images/logo.png" />
	<link rel="index" title="Ваш сайт" href="/" />
	<meta name="application-name" content="Ваш сайт" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
<!--	<script type="text/javascript" src="<?/*=SITE_TEMPLATE_PATH;*/?>/javascript/jquery-1.10.2.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery.bxslider.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery.slides.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery.bxslider.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/device.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/fancybox.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/jquery.easing.1.3.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/javascript/script.js" type="text/javascript"></script>
	<link href="<?=SITE_TEMPLATE_PATH;?>/font-awesome.min.css" type="text/css" rel="stylesheet" />
	<link href="<?=SITE_TEMPLATE_PATH;?>/fancybox.css" type="text/css" rel="stylesheet" />
	<link href="<?=SITE_TEMPLATE_PATH;?>/bxslider.css" type="text/css" rel="stylesheet" />
	<link href="<?=SITE_TEMPLATE_PATH;?>/css/themes/styles.css" type="text/css" rel="stylesheet" data-color="true" />
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?$APPLICATION->ShowHead();?>
</head>
<body <?=bclass()?> itemscope itemtype="http://schema.org/WebPage">
<div class="wrapper">
<?
$APPLICATION->ShowPanel();
CModule::IncludeModule("iblock");
?>
<div class="background"></div>
<div class="dialog">
	<p><?=GetMessage("SENT_MASSAGE");?></p>
	<button><?=GetMessage("CLOSE");?></button>
</div>
<div id="leave_application" class="order_form">
	<p class="exit_form"></p>
	<p class="big_text_form"><?=GetMessage("ADD_APL");?></p>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.feedback", 
		"leave_application", 
		array(
			"COMPONENT_TEMPLATE" => "leave_application",
			"USE_CAPTCHA" => "N",
			"OK_TEXT" => "Спасибо, ваше сообщение принято.",
			"EMAIL_TO" => COption::GetOptionString("main", "email_from"),
			"REQUIRED_FIELDS" => array(
			),
			"EVENT_MESSAGE_ID" => array(
				0 => "7",
			)
		),
		false
	);?>
</div>
<div id="request_call" class="order_form">
	<p class="exit_form"></p>
	<p class="big_text_form"><?=GetMessage("ADD_PHONE");?></p>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.feedback", 
		"request_call", 
		array(
			"COMPONENT_TEMPLATE" => "request_call",
			"USE_CAPTCHA" => "N",
			"OK_TEXT" => "Спасибо, ваше сообщение принято.",
			"EMAIL_TO" => COption::GetOptionString("main", "email_from"),
			"REQUIRED_FIELDS" => array(
			),
			"EVENT_MESSAGE_ID" => array(
				0 => "7",
			)
		),
		false
	);?>
</div>
<header>
	<div class="header_wrapper">
		<div class="header_center">
			<div class="header_top">
				<div class="logo">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/header/logo.php", Array(), Array("MODE" => "html","NAME" => "ваш логотип"));?>
				</div>
				<div class="header_slogan">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/header/slogan.php", Array(), Array("MODE" => "html","NAME" => "ваш PR слоган"));?>

				</div>
				<div class="header_contact">
					<div class="header_phone">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/header/phone.php", Array(), Array("MODE" => "html","NAME" => "ваш номер телефона"));?>
					</div>
                    <div class="req_btn">
					    <button><?=GetMessage("ADD_APL");?></button>
                    </div>
                    <div class="header_address">
                        <?$APPLICATION->IncludeFile(SITE_DIR."include/header/address.php", Array(), Array("MODE" => "html","NAME" => "ваш адрес"));?>
                    </div>
				</div>
			</div>
			<!--<div class="mobile_header_search">
			<?/*$APPLICATION->IncludeComponent("bitrix:search.form", "search", Array(
				"COMPONENT_TEMPLATE" => "flat",
					"PAGE" => "#SITE_DIR#search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
					"USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
				),
				false
			);*/?>
			</div>-->
		</div>
	</div>
    <div class="nav_wrapper default">
	    <nav id="top_menu" class="default">
		<a href="#" id="mobile_menu"><?=GetMessage("MENU");?></a>
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_menu", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "main_menu",
		"MENU_THEME" => "site"
	),
	false
);?>
	</nav>
    </div>
</header>
<?if ($APPLICATION->GetCurPage(false) == SITE_DIR){?>
<div id="slider-cont">
    <div id="slides">
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"COMPONENT_TEMPLATE" => "slider",
		"IBLOCK_TYPE" => "slider",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "SLIDER_URL",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Услуги",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
    </div>

</div>
<?}?>


<?if ($APPLICATION->GetCurPage(false)!=SITE_DIR){ ?>
    <div class="wrapper_center">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
		"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => "s2",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
	),
	false
);?>
<h1><?$APPLICATION->ShowTitle();?></h1>
<?}?>