<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("� ��������");
$APPLICATION->SetPageProperty("tags", "��������");
$APPLICATION->SetPageProperty("keywords", "��������, �����, ������, �����");
$APPLICATION->SetPageProperty("description", "�������� ������ �����");
?>
<?$APPLICATION->IncludeFile(SITE_DIR."include/company.php", Array(), Array("MODE" => "html","NAME" => ""));?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>