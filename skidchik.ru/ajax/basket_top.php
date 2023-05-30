<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
	"vebfabrika:basket.incorp2", 
	"top", 
	array(
		"COMPONENT_TEMPLATE" => "top",
	),
	false
);
?>