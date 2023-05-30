<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $arTheme;?>
<?$bActiveTheme = ($arTheme["THEME_SWITCHER"]["VALUE"] == 'Y');?>
<?if($isIndex = CSite::inDir(SITE_DIR."index.php")):?>
<?$indexType = $arTheme["INDEX_TYPE"]["VALUE"];?>
<?$catalogType = "catalog_section_home_".$arTheme["CATALOG_TYPE"]["VALUE"];?>
<?$servicesType = "services_home_".$arTheme["SERVICES_TYPE"]["VALUE"];?>
<?$bBigBannersIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["BIG_BANNER_INDEX"]["VALUE"] == 'Y');?>
<?$bTeasersIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TEASERS_INDEX"]["VALUE"] == 'Y');?>
<?$bServicesIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["SERVICES_INDEX"]["VALUE"] == 'Y');?>
<?$bStandartProjectIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["STANDART_PROJECT_INDEX"]["VALUE"] == 'Y');?>
<?$bCatalogIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["POPULAR_INDEX"]["VALUE"] == 'Y');?>
<?$bBlogIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["BLOG_INDEX"]["VALUE"] == 'Y');?>
<?$bCompanyIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["COMPANY_INDEX"]["VALUE"] == 'Y');?>
<?$bAdvantagesIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["ADVATAGES_INDEX"]["VALUE"] == 'Y');?>
<?$bNewsIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["NEWS_INDEX"]["VALUE"] == 'Y');?>
<?$bPartnersIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["PARTNERS_INDEX"]["VALUE"] == 'Y');?>
<?$bMapIndex = ($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["MAP_INDEX"]["VALUE"] == 'Y');?>
<?$bMapTypeGoogleIndex = $arTheme["GOOGLE_MAPS"]["VALUE"];?>
<?$bNewsHide = $arTheme["NEWS_BLOCK_INDEX"]["VALUE"];?>

<?endif;?>


<?global $arMainPageOrder; //global array for order blocks?>
<?if($arMainPageOrder && is_array($arMainPageOrder)):?>
<?foreach($arMainPageOrder as $key => $optionCode):?>
<?//BIG_BANNER_INDEX?>
<?if($optionCode == "BIG_BANNER_INDEX"):?>
<?if($bBigBannersIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"banner_home", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_advtbig"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "BANNERTYPE",
			1 => "TEXTCOLOR",
			2 => "BUTTON1TEXT",
			3 => "BUTTON1LINK",
			4 => "BUTTON2TEXT",
			5 => "BUTTON2LINK",
			6 => "FORMS",
			7 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "banner_home"
	),
	false
);?>
<?endif;?>
<?endif;?>
<?//TEASERS_INDEX?>
<?if($optionCode == "TEASERS_INDEX"):?>
<?if($bTeasersIndex):?>
<? 
$GLOBALS['arFilterTizer'] = array("!PROPERTY_VIEW_HOME"=>false); 
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"tizer", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "arFilterTizer",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_advtsmall"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "FAICON",
			1 => "LINK",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "tizer"
	),
	false
);?>
<?endif;?>
<?endif;?>

<?//SERVICES_INDEX?>
<?if($optionCode == "SERVICES_INDEX"):?>
<?if($bServicesIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	$servicesType, 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_services"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => $servicesType,
		"TITLE" => "Наши услуги",
		"ALL_LINK" => "/services/",
		"LINK_NAME" => "Все услуги"
	),
	false
);?>
<?endif;?>
<?endif;?>

<?//CATALOG_SECTION_INDEX?>
<?if($optionCode == "STANDART_PROJECT_INDEX"):?>
<?if($bStandartProjectIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	$catalogType, 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALL_LINK" => "/catalog/",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TITLE" => "Каталог товаров",
		"COMPONENT_TEMPLATE" => $catalogType,
		"SHOW_CHILD_SECTIONS" => "Y",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PREVIEW_TRUNCATE_LEN" => "",
		"LINK_NAME" => "Все товары",
		"DEPTH_LEVEL" => "1",
		"SHOW_CHILD_SECTIONS" => "Y"
	),
	false
);?>
<?endif;?>
<?endif;?>
<?//POPULAR_INDEX?>
<?if($optionCode == "POPULAR_INDEX"):?>
<?if($bCatalogIndex):?>
<div class="popular">
	<div class="inner work clearfix">
		<h2 class="title_block">Популярные товары </h2>
		<div class="tabs">
			<ul class="tabs_caption">
				<li class="active">Акция</li>
				<li>Хит продаж</li>
				<li>Рекомендуем</li>
			</ul>
			
			<div class="tabs_content active">
				<? 
				$GLOBALS['arFilterCat'] = array("PROPERTY_PLASHKA_VALUE"=>'Акция'); 
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"index_item", 
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "arFilterCat",
						"USE_FILTER" => "Y",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
						"IBLOCK_TYPE" => "vbf_incorp2_catalog",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "4",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "PRICE",
							1 => "",
							2 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "index_item",
					),
					false
				);?>
			</div>
			<div class="tabs_content">
				<? 
				$GLOBALS['arFilterCat'] = array("PROPERTY_PLASHKA_VALUE"=>'Хит продаж'); 
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"index_item", 
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "arFilterCat",
						"USE_FILTER" => "Y",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
						"IBLOCK_TYPE" => "vbf_incorp2_catalog",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "4",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "PRICE",
							1 => "",
							2 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "index_item",
					),
					false
				);?>
			</div>
			<div class="tabs_content">
				<? 
				$GLOBALS['arFilterCat'] = array("PROPERTY_PLASHKA_VALUE"=>'Рекомендуем'); 
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"index_item", 
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "arFilterCat",
						"USE_FILTER" => "Y",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
						"IBLOCK_TYPE" => "vbf_incorp2_catalog",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "4",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "PRICE",
							1 => "",
							2 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "index_item",
					),
					false
				);?>
			</div>
		</div>
	</div>
</div>
<?endif;?>
<?endif;?>
<?//BLOG_INDEX?>
<?if($optionCode == "BLOG_INDEX"):?>
<?if($bBlogIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"index_blog", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_blog"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "index_blog",
		"TITLE" => "Блог",
		"ALL_LINK" => "/blog/",
		"LINK_NAME" => "Все статьи"
	),
	false
);?>

<?endif;?>
<?endif;?>
<?//ABOUT_INDEX?>
<?if($optionCode == "COMPANY_INDEX"):?>
<?if($bCompanyIndex):?>
<div class="info_block">
	<div class="inner work clearfix">
		<div class="left" <?if($bNewsHide == "Y"):?>style="width: 100%;padding-right: 0px;"<?endif;?>>
			<div class="about">
				<h2 class="title_block">О компании</h2>
				<div class="pic">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/pic.jpg" alt="О компании"/>
				</div>
				<?
				$APPLICATION->IncludeFile(SITE_DIR."include/index-company.php", array(), array(
					"MODE" => "html",
					"NAME" => "Company",
				)
			);
			?>
		</div>
	</div>
	<div class="right">
		<?if($bNewsHide !== "Y"):?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"index_news", 
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_news"][0],
				"IBLOCK_TYPE" => "vbf_incorp2_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "index_news",
				"TITLE" => "Новости",
				"ALL_LINK" => "/info/news/",
				"LINK_NAME" => "Все новости"
			),
			false
		);?>
	<?endif;?>
	</div>
</div>
</div>
<?endif;?>
<?endif;?>
<?//FORM?>
<?if($optionCode == "ADVATAGES_INDEX"):?>
<?if($bAdvantagesIndex):?>
<div>
	<div class="inner work">
		<div class="ques clearfix">
			<div class="left clearfix">
				<div class="sign"><span>?</span></div>
				<div class="description">
					<span class="title"><?$APPLICATION->IncludeFile(SITE_DIR."include/index_form_name.php", array(), array(
									"MODE" => "php",
									"NAME" => "Заголовок формы",
									)
								);
								?></span>
					<p><?$APPLICATION->IncludeFile(SITE_DIR."include/index_form_desc.php", array(), array(
									"MODE" => "php",
									"NAME" => "Описание формы",
									)
								);
								?></p>
				</div>
			</div>
			<div class="right">
				<a class="btn btn_main" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_question");?>" data-name="question"><?$APPLICATION->IncludeFile(SITE_DIR."include/index_form_button.php", array(), array(
									"MODE" => "php",
									"NAME" => "Текст кнопки",
									)
								);
								?></a>
			</div>
		</div>
	</div>
</div>
<?endif;?>
<?endif;?>

<?//REVIEWS_INDEX?>
<?if($optionCode == "NEWS_INDEX"):?>
<?if($bNewsIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"index_reviews", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_reviews"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "AUTHOR",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "index_reviews",
		"TITLE" => "Отзывы"
	),
	false
);?>
<?endif;?>
<?endif;?>
<?//MAP_INDEX?>
<?if($optionCode == "MAP_INDEX"):?>
<?if($bMapIndex):?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("front-contacts-map");?>
<div class="map_main">        
				<?if($bMapTypeGoogleIndex == "Y"):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:map.google.view", 
						".default", 
						array(
							"API_KEY" => "",
							"CONTROLS" => array(
								0 => "SMALL_ZOOM_CONTROL",
								1 => "TYPECONTROL",
								2 => "SCALELINE",
							),
							"INIT_MAP_TYPE" => "ROADMAP",
							"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.756194712815315;s:10:\"google_lon\";d:37.59444286116094;s:12:\"google_scale\";i:13;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:25:\"Мы находимся тут!###RN###\";s:3:\"LON\";d:37.592618959030816;s:3:\"LAT\";d:55.75534344663125;}}}",
							"MAP_HEIGHT" => "500",
							"MAP_ID" => "MAPS",
							"MAP_WIDTH" => "100%",
							"OPTIONS" => array(
								0 => "ENABLE_DBLCLICK_ZOOM",
								1 => "ENABLE_DRAGGING",
								2 => "ENABLE_KEYBOARD",
							),
							"COMPONENT_TEMPLATE" => ".default"
						),
						false
					);?>
				<?else:?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:map.yandex.view", 
		".default", 
		array(
			"CONTROLS" => array(
				0 => "ZOOM",
				1 => "MINIMAP",
				2 => "TYPECONTROL",
				3 => "SCALELINE",
			),
			"INIT_MAP_TYPE" => "MAP",
			"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.74227149199072;s:10:\"yandex_lon\";d:37.58186296065696;s:12:\"yandex_scale\";i:11;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.5964962711639;s:3:\"LAT\";d:55.73820639728646;s:4:\"TEXT\";s:17:\"Мы находимся тут!\";}}}",
			"MAP_HEIGHT" => "600",
			"MAP_ID" => "",
			"MAP_WIDTH" => "100%",
			"OPTIONS" => array(
				0 => "ENABLE_DBLCLICK_ZOOM",
				1 => "ENABLE_DRAGGING",
			),
			"COMPONENT_TEMPLATE" => ".default",
			"API_KEY" => ""
		),
		false
	);?>
<?endif;?>
	<div class="container">
		<div class="inner work">
			<div class="chisel">
				<h2>Контакты</h2>
				<div class="place">
					<span><?
					$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", array(), array(
						"MODE" => "php",
						"NAME" => "Adress",
					)
				);
				?></span>
			</div>
			<div class="mail">
				<?
				$APPLICATION->IncludeFile(SITE_DIR."include/site-email.php", array(), array(
					"MODE" => "php",
					"NAME" => "Email",
				)
			);
			?>
		</div>
		<div class="phone">
			<?
			$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
				"MODE" => "php",
				"NAME" => "Phone",
			)
		);
		?>
	</div>
</div>
</div>
</div>
</div>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("front-contacts-map", "");?>
<?endif;?>
<?endif;?>

<?//PARTNERS_INDEX?>
<?if($optionCode == "PARTNERS_INDEX"):?>
<?if($bPartnersIndex):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"index_partners", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" =>  CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_partners"][0],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "index_partners",
		"TITLE" => "Партнеры",
	),
	false
);?>
<?endif;?>
<?endif;?>

<?endforeach;?>
<?endif;?>