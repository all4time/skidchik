<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
$arItemFilter = CIncorp2::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams, false);
$arSubSectionFilter = CIncorp2::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, false);
$itemsCnt = CCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSubSections = CCache::CIBlockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID"));
$isAjax = 'N';
?>
<?

//\Bitrix\Main\Diag\Debug:: writeToFile($GLOBALS,'Var','/test.log');
//$GLOBALS[$arParams["FILTER_NAME"]]=array("SECTION_ID" => CATEGORY_MSK);
//$GLOBALS['arFi']=array("SECTION_ID" => CATEGORY_MSK);
//printr($GLOBALS[$arParams["FILTER_NAME"]]);
//printr($arParams["FILTER_NAME"]);
//printr($GLOBALS['arrFilter']);
//printr($arItemFilter);
// $page = $APPLICATION->GetCurPage();
// echo strtoupper(str_replace('/', '', $page));
?>
<?
	//$arOrder = Array($by=>$order);
	$arSelect = Array ('UF_*');
	$arOrder = Array('NAME'=>'ASC'); // NAME, ID, SORT ....
    $arFFilter = Array('IBLOCK_ID'=>33,
					'GLOBAL_ACTIVE'=>'Y',
					"DEPTH_LEVEL" => "2", // - глубина вложенности (начинается с 1);
					//'CODE'=>['moskva','all'],
					//'UF_TEST'=>'Поле для Спб'
					);
    $db_list = CIBlockSection::GetList($arOrder, $arFFilter, true, $arSelect, false);
    while($ar_result = $db_list->GetNext())
    {
        echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
		//printr($ar_result);
    }

?>

<?/*$db_list = CIBlockSection::GetList(
    false,//arOrder
    Array("IBLOCK_ID" => 33, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", "DEPTH_LEVEL" => "1", 'UF_TEST'=>'Поле для Спб'),//arFilter
    true,// количество элементов показывает' 
    Array("UF_*"),//arSelect
    false
);
while($ar_result = $db_list->GetNext())
    {
        echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
		printr($ar_result);
    }
*/?>
<?

//$GLOBALS['arFi'] = ['ACTIVE' => 'N'];
//printr($arItem);

?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"catalog_section_list",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		//"FILTER_NAME" => "arFi",
		"USE_FILTER" => "Y",
		"PROPERTY_CODE" => array("","UF_TEST",""),
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"SHOW_CHILD_SECTIONS" => 'Y',
		"DEPTH_LEVEL" => 1,
	),
	$component
);?>
