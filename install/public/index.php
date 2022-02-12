<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("calendar");
$APPLICATION->IncludeComponent(
    "demirofl:calendar", ".default", [], null, []
)
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
