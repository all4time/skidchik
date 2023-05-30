<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	".default", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DEFAULT_SORT" => "rank",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGE_RESULT_COUNT" => "50",
		"RESTART" => "N",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "N",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "N",
		"USE_TITLE_RANK" => "Y",
		"arrFILTER" => array(
			0 => "main",
			1 => "iblock_vbf_incorp2_catalog",
			2 => "iblock_vbf_incorp2_content",
		),
		"arrFILTER_iblock_vbf_incorp2_catalog" => array(
			0 => "all",
		),
		"arrFILTER_iblock_vbf_incorp2_content" => array(
			0 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_projects"][0],
			1 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_news"][0],
			2 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_sale"][0],
			3 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_blog"][0],
		),
		"arrFILTER_main" => array(
		),
		"arrWHERE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>