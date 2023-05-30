<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DETAIL_FORM_ID" => Array(
		"NAME" => GetMessage("DETAIL_FORM_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_FORM_BUTTON" => Array(
		"NAME" => GetMessage("DETAIL_FORM_BUTTON"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("DETAIL_FORM_BUTTON_TEXT"),
	),
	"USE_SHARE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"VALUE" => "Y",
		"DEFAULT" =>"N",
		"REFRESH"=> "Y",
	),
);

?>