<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<?$APPLICATION->IncludeComponent(
	"vebfabrika:basket.incorp2", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH_TO_CATALOG" => "/catalog/"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>