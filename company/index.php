<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
$APPLICATION->SetPageProperty("tags", "Компания");
$APPLICATION->SetPageProperty("keywords", "Ключевые, слова, вашего, сайта");
$APPLICATION->SetPageProperty("description", "Описание вашего сайта");
?>
<?$APPLICATION->IncludeFile(SITE_DIR."include/company.php", Array(), Array("MODE" => "html","NAME" => ""));?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>