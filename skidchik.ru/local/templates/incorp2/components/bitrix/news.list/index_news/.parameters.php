<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	'TITLE' => array(
		'NAME' => GetMessage('T_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('V_TITLE'),
	),
	'ALL_LINK' => array(
		'NAME' => GetMessage('T_ALL_LINK'),
		'TYPE' => 'STRING',
		'DEFAULT' => '/info/news/',
	),
	'LINK_NAME' => array(
		'NAME' => GetMessage('T_LINK_NAME'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('V_LINK_NAME'),
	),
);
?>
