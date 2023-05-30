<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<?
echo $_SERVER['HTTP_REFERER'];
echo '<br>';
echo $_SERVER['HTTP_USER_AGENT'];
echo '<br>';
echo $_SERVER['REMOTE_ADDR'];
echo '<br>';


echo \Bitrix\Main\Engine\CurrentUser::get()->getId();
echo \Bitrix\Main\Engine\CurrentUser::get()->getLogin();

$res22 = CIBlock::GetList(
    Array(), 
    Array(
        'TYPE'=>'vbf_incorp2_catalog', 
        'SITE_ID'=>SITE_ID, 
        'ACTIVE'=>'Y', 
        //"!CODE"=>'my_products'
    ), false // рекомендуется убрать необязательный параметр bIncCnt (если он не используется), чтобы избежать проблем с производительностью. или false
);
$arrId = [];
while($ar_res = $res22->Fetch())
{
	$arrId[] = $ar_res['ID'];
}

printr($arrId);


//$dir = $_SERVER["DOCUMENT_ROOT"];
//$files = scandir($dir);
$siteUrl = "skidchik.ru";
$files = scandir("/home/bitrix/ext_www/" . $siteUrl);
$fileListXml = [];
foreach ($files as $filename) {
	//echo "Файл $filename в последний раз был изменён: " . date("F d Y H:i:s.", filemtime("/home/bitrix/ext_www/" . $siteUrl . "/" . $filename)) . "<br>";
	if (preg_match('/sitemap-iblock-\d{1,}.xml/', $filename, $matches)) {
		//printr($matches[0]);
		$fileListXml += [$matches[0] => date("Y-m-d\TH:i:s", filemtime("/home/bitrix/ext_www/" . $siteUrl . "/" . $filename))];
	}
}

//printr($files);
printr($fileListXml);

foreach (glob($_SERVER["DOCUMENT_ROOT"] . "/*.txt") as $filename) {
    echo "$filename дата изменения" . date ("Y-m-d\TH:i:s", filemtime($filename)) . "<br>";
}

/* $VALUES = array();
$res = CIBlockElement::GetProperty(33, 288, array(), array("CODE" => "GOROD"));
while ($ob = $res->GetNext()) {
	$VALUES[] = $ob['VALUE'];
}
printr($VALUES); */

/* $arSelect = Array(
	"ID",
	"SECTION_PAGE_URL",
	"UF_*"
);
$arFilter = Array(
	"IBLOCK_ID" => 33,
	"ACTIVE" => "Y"
);
$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
$arTemp = array();
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arTemp[$arFields["SECTION_PAGE_URL"]] = $arFields;
}
unset($res);
$arTempResult = array();
foreach ($arResult as &$arMenuItem)
{
	if ($arTemp[$arMenuItem['LINK']])
	{
		$arTempResult[] = $arMenuItem;
	}
}
$arResult = $arTempResult;
unset($arTemp);
unset($arTempResult); */

//printr($arResult);
/* $arSelect = Array ('UF_*');
$arOrder = Array('SORT'=>'ASC'); // NAME, ID, SORT ....
$arFFilter = Array('IBLOCK_ID'=>33,
				'GLOBAL_ACTIVE'=>'Y',
					//'CODE'=>['moskva','all'],
					//'UF_TEST'=>'Поле для Спб'
				);
$db_list = CIBlockSection::GetList($arOrder, $arFFilter, true, $arSelect, false);
$arr = [];
while($ar_result = $db_list->GetNext())
{
	//echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
	//printr($ar_result['UF_TEST'][0]);
	//$arResult['SECTIONS']['UF_TEST'] = $ar_result['UF_TEST'];
	//$arr[] = $ar_result['UF_TEST'][0];
	printr($ar_result);

} */






function sitemapCreate($cityName, $propertyCode)
{
	$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "TIMESTAMP_X", "PROPERTY_" . $propertyCode);
	$arFilter = array("IBLOCK_ID" => 15, "INCLUDE_SUBSECTIONS" => "Y", "ACTIVE" => "Y", "PROPERTY_" . $propertyCode . "_VALUE" => $cityName); //ID Инфоблока и ID раздела с элементами
	$rsElement = CIBlockElement::GetList(array("NAME" => "ASC"), $arFilter, false, array("nPageSize" => 5), $arSelect);
	$arResult["ITEMS"] = array();
	while ($obElement = $rsElement->GetNextElement()) {
		$arrItem = $obElement->GetFields();
		$arrItem["PROPERTIES"] = $obElement->GetProperties();
		//printr($arrItem);
		//printr($arrItem['PROPERTIES']['GOROD']['VALUE']);
	};
}
//sitemapCreate("Питер", "GOROD");
//echo $CURRENT_PAGE = (CMain::IsHTTPS()) ? "https://" : "http://";
//echo SITE_SERVER_PROTOCOL;
printr(SITE_SERVER_NAME);
?>

<? //echo ConvertDateTime("04.07.2022 23:48:48", "YYYY-MM-DDtHH:MM:SS+03:00", "ru");
?>
<? //echo ConvertDateTime("04.07.2022 23:48:48", "YYYY-MM-DD", "ru") . 'T' . ConvertDateTime("04.07.2022 23:48:48", "HH:MM:SS+03:00", "ru");
?>
<? //echo ConvertDateTime($arrItem["TIMESTAMP_X"], "YYYY-MM-DD", "ru") . "T" . ConvertDateTime($arrItem["TIMESTAMP_X"], "HH:MM:SS+03:00", "ru");
?>
<? //$date = new DateTime('04.07.2022 23:48:48'); echo $date->format('Y-m-d\TH:i:s');
?>
<?
/* $res = CIBlockElement::GetByID(288);
if($arRes = $res->Fetch())
{
	printr($arRes);
	$res = CIBlockSection::GetByID($arRes["IBLOCK_SECTION_ID"]);
	if($arRes = $res->Fetch())
	{
		printr($arRes);
	}
} */

?>

<div>
    <?
	/* 	$arSelect = Array ('UF_*');
	$arOrder = Array('SORT'=>'ASC'); // NAME, ID, SORT ....
    $arFFilter = Array('IBLOCK_ID'=>33,
					'GLOBAL_ACTIVE'=>'Y',
					  //'CODE'=>['moskva','all'],
					  //'UF_TEST'=>'Поле для Спб'
					);
    $db_list = CIBlockSection::GetList($arOrder, $arFFilter, true, $arSelect, false);
	$arr = [];
    while($ar_result = $db_list->GetNext())
    {
        //echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
		//printr($ar_result['UF_TEST'][0]);
		//$arResult['SECTIONS']['UF_TEST'] = $ar_result['UF_TEST'];
		//$arr[] = $ar_result['UF_TEST'][0];
		printr($ar_result);

    } */

	/* 	echo $page = $APPLICATION->GetCurPage();
	if(CSite::InDir('/promo/')) {
		echo "Да";
		} */

	//$page = $APPLICATION->GetCurPage();
	//echo strtoupper(str_replace('/', '', $page)); // Будет работать внутри! Заменить при переносе в проект
	//echo strtoupper(preg_replace('/\/(\w+)\/.*/', '$1', $page));
	$page = strtoupper(preg_replace('/\/(\w+)\/.*/', '$1', $APPLICATION->GetCurPage()));
	echo "$page";

	$rsEnum = CUserFieldEnum::GetList(array(), array('USER_FIELD_NAME' => 'UF_GOROD')); // добавить 'UF_GOROD_'. strtoupper(str_replace('/', '', $APPLICATION->GetCurPage())) а лучше strtoupper(preg_replace('/\/(\w+)\/.*/', '$1', $APPLICATION->GetCurPage()))
	$uf_prop = array();
	while ($arEnum = $rsEnum->Fetch()) {
		$uf_prop[$arEnum['ID']] = $arEnum['XML_ID'];
		//printr($arEnum);
	}
	printr($uf_prop);
	$sectionsFilter = [];
	foreach ($uf_prop as $id => $xml_id) {
		if ($xml_id == SITE_SERVER_NAME) { // SITE_SERVER_NAME должен быть без скобок!!! добавить SITE_SERVER_NAME . "-" . str_replace('/', '', $APPLICATION->GetCurPage()) а лучше preg_replace('/\/(\w+)\/.*/', '$1', $APPLICATION->GetCurPage())
			echo SITE_SERVER_NAME . '-' . strtolower($page);
			$sectionsFilter = ['UF_GOROD' => $id];
		}
	}
	printr($sectionsFilter);



	/* 	$obEnum = new \CUserFieldEnum;
	$rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => 167)); // см. поля для фильтрации  

	//$enum = array();
		while($arEnum = $rsEnum->Fetch())
		{
			//$enum[$arEnum["ID"]] = $arEnum["VALUE"];
			printr($arEnum);
		} */






	/* 	//$sectionsFilter = ['ID' => [42, 45, 46]];
if (SITE_SERVER_NAME == 'skidchik.ru') {
	$sectionsFilter = ['UF_GOROD' => [70]];
} elseif (SITE_SERVER_NAME == 'spb.skidchik.ru') {
	$sectionsFilter = ['UF_GOROD' => [71]];
} */


	//$sectionsFilter = ['UF_GOROD' => [70, 71]];

	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"store_v4",
		array(
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COUNT_ELEMENTS" => "Y",
			"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
			"FILTER_NAME" => "sectionsFilter",
			"IBLOCK_ID" => "33",
			"IBLOCK_TYPE" => "skidchik",
			"SECTION_CODE" => "",
			"SECTION_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(
				0 => "UF_GOROD",
				1 => "",
			),
			"SHOW_PARENT_NAME" => "Y",
			"TOP_DEPTH" => "2",
			"VIEW_MODE" => "LINE",
			"COMPONENT_TEMPLATE" => "store_v4",
			"OFFSET_MODE" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO"
		),
		false
	); ?> <br>
</div>
<div>
    <br>
</div>
<div>

    <? // Получаем родительскую категорию по id дочерней
	$res = CIBlockSection::GetByID(40);
	if ($ar_res = $res->GetNext())
		echo $ar_res['IBLOCK_SECTION_ID'];
	//printr($ar_res);
	?>
    <?
	//$sectionsFilter2 = ['SECTION_ID' => 62];
	//$sectionsFilter2 = ['SECTION_ID' => $categoryMoscow]; // init.php



	//$GLOBALS['arrFilterCity'] = array("=PROPERTY_GOROD_VALUE" => "Москва");

	cityFilter(33, "GOROD"); // Функция фильтра в init.php принимает id инфоблока и код свойства привязки к городу  

	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		//".default",
		//"catalog_section_list",
		"skidchik_item_list",
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
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
			"FIELD_CODE" => array("NAME", ""),
			"FILTER_NAME" => "arrFilterCity",
			"USE_FILTER" => "Y",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "33",
			"IBLOCK_TYPE" => "skidchik",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "100",
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
			"PROPERTY_CODE" => array("", "UF_TEST", ""),
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
			"STRICT_SECTION_CHECK" => "N"
		)
	); ?> <br>
</div>

<?
//use \Bitrix\Main\Service\GeoIp;
//$geoIpData = \Bitrix\Main\Service\GeoIp\Manager::getDataResult($ip,LANGUAGE_ID);
//echo $geoIpData->getGeoData()->ip;
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>