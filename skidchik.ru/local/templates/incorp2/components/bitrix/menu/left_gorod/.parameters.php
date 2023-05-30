<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"VIEW_TITLE" => Array(
		"NAME" => GetMessage("T_VIEW_TITLE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	'TITLE' => array(
		'NAME' => GetMessage('T_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('V_TITLE'),
	),
);
?>