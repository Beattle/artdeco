<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
$APPLICATION->SetPageProperty("tags", "Отзывы");
$APPLICATION->SetPageProperty("keywords", "Ключевые, слова, вашего, сайта");
$APPLICATION->SetPageProperty("description", "Описание вашего сайта");
?>


<?$APPLICATION->IncludeComponent(
    "webavk:ibcomments",
    "feedbacks",
    array(
        "ALLOW_EDIT" => "Y",
        "ALLOW_GUEST_COMMENTS" => "Y",
        "ALLOW_SORT" => "Y",
        "ALLOW_SORT_VARIANTS" => array(
        ),
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "A",
        "DATE_FORMAT" => "d.m.Y",
        "DISPLAY_BOTTOM_PAGER" => "N",
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
        "USE_FEATURE_ADMIN_ANSWER" => "Y",
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>