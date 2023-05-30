<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"S_ORDER_SERVISE" => Array(
		"NAME" => GetMessage("S_ORDER_SERVISE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"S_ASK_QUESTION" => Array(
		"NAME" => GetMessage("S_ASK_QUESTION"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
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
	"DETAIL_FORM_TEXT" => Array(
		"NAME" => GetMessage("DETAIL_FORM_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("DETAIL_FORM_TEXT_DEF"),
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