<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
	"vebfabrika:basket.incorp2", 
	"fly", 
	array(
		"COMPONENT_TEMPLATE" => "fly",
	),
	false
);
?>