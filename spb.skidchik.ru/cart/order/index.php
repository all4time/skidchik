<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"vebfabrika:basket.incorp2",
	"order",
	Array(
		"COMPONENT_TEMPLATE" => "order",
		"PATH_TO_CATALOG" => '/catalog/',
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>