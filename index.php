<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ремонт под ключ в уфе");
$APPLICATION->SetPageProperty("tags", "Главная");
$APPLICATION->SetPageProperty("keywords", "Ключевые, слова, вашего, сайта");
$APPLICATION->SetPageProperty("description", "Описание вашего сайта");
?><div class="pros">
	<div class="wrapper_center">
		<div class="box">
 <i class="icon smeta"></i>
			<p class="f_name">
				 <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/index/froze.php",
                    Array(),
                    Array(
                        "MODE" => "html",
                        "NAME" => "Надпись"
                    )
                );?>
			</p>
		</div>
		<div class="box">
 <i class="icon exp"></i>
			<p class="f_name">
				 <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/index/experience.php",
                    Array(),
                    Array(
                        "MODE" => "html",
                        "NAME" => "Надпись"
                    )
                );?>
			</p>
		</div>
		<div class="box">
 <i class="icon warr"></i>
			<p class="f_name">
				 <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/index/protection.php",
                    Array(),
                    Array(
                        "MODE" => "html",
                        "NAME" => "Надпись"
                    )
                );?>
			</p>
		</div>
		<div class="box">
 <i class="icon limits"></i>
			<p class="f_name">
				 <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/index/time.php",
                    Array(),
                    Array(
                        "MODE" => "html",
                        "NAME" => "Надпись"
                    )
                );?>
			</p>
		</div>
	</div>
</div>
<div class="wrapper_center">
	<div class="services">
		<h1><?$APPLICATION->ShowTitle();?></h1>
		<div class="services_center">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"services_list",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "services_list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "services",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Услуги",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
		</div>
	</div>
</div>
<div class="about_company">
	<div class="about_company_center">
		<h2> <span>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/index/about_company.php", Array(), Array("MODE" => "html","NAME" => ""));?> </span> </h2>
		<div>
			 <?$APPLICATION->IncludeFile(SITE_DIR."include/index/about_company_text.php", Array(), Array("MODE" => "html","NAME" => ""));?>
		</div>
 <button class="see_more">Посмотреть весь текст</button>
	</div>
</div>
<div class="wrapper_center">
	<div class="last_work">
		<div class="last_work_center">
			<h2>
			<?$APPLICATION->IncludeFile(SITE_DIR."include/index/last_work.php", Array(), Array("MODE" => "html","NAME" => ""));?> </h2>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"last_work",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "last_work",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "portfolio",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Последние работы",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC"
	)
);?>
		</div>
	</div>
</div>
<div class="customer_reviews">
	<div class="wrapper_center">
		<h2>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/index/customer_reviews.php", Array(), Array("MODE" => "html","NAME" => ""));?> </h2>
        <?$APPLICATION->IncludeComponent(
            "webavk:ibcomments",
            "home_page",
            array(
                "ALLOW_EDIT" => "Y",
                "ALLOW_GUEST_COMMENTS" => "Y",
                "ALLOW_SORT" => "Y",
                "ALLOW_SORT_VARIANTS" => array(
                ),
                "CACHE_TIME" => "360000",
                "CACHE_TYPE" => "A",
                "DATE_FORMAT" => "d.m.Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "GROUP_ADMINISTRATION" => array(
                    0 => "1",
                ),
                "GROUP_MODERATORS" => array(
                    0 => "1",
                ),
                "HIDE_COMMENT_NEGATIVE_RATING" => "Y",
                "IBLOCK_ID" => "12",
                "IBLOCK_TYPE" => "comments",
                "LINK_ELEMENT_ID" => "82",
                "MAX_VOTE" => "5",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Комментарии",
                "PAGE_ELEMENT_COUNT" => "10",
                "PREMODERATION" => "Y",
                "SAVE_VOTES2ELEMENT" => "N",
                "SEND_EMAIL_ADMIN_ANSWER" => "Y",
                "SEND_EMAIL_MODERATE_COMMENTS" => "Y",
                "SEND_EMAIL_NEW_COMMENTS" => "Y",
                "SHOW_AVATARS" => "N",
                "SORT_BY" => "CREATED_DATE",
                "SORT_ORDER" => "desc",
                "USE_CAPTCHA" => "Y",
                "USE_FEATURE_ADMIN_ANSWER" => "N",
                "USE_FEATURE_ADVANTAGES" => "Y",
                "USE_FEATURE_CONS" => "N",
                "USE_FEATURE_HELPFUL" => "N",
                "USE_FEATURE_REVIEW" => "Y",
                "USE_FEATURE_VOTE_CONV" => "N",
                "USE_FEATURE_VOTE_DESIGN" => "N",
                "USE_FEATURE_VOTE_FUNC" => "N",
                "USE_FEATURE_VOTE_PRICE" => "N",
                "USE_FEATURE_VOTE_WORK" => "N",
                "USE_GRAVATARS" => "N",
                "COMPONENT_TEMPLATE" => "home_page"
            ),
            false
        );?>
	</div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>