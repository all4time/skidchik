<? 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION; // Нужно!!!
/* global $APPLICATION; 
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/promo/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"IBLOCK_TYPE" => "vbf_incorp2_catalog",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["skidchik"]["actions"][0],
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);  */
//$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks); 
//printr($aMenuLinks[0]);
//\Bitrix\Main\Diag\Debug:: writeToFile($aMenuLinks,'Var','/test.log');
//unset($aMenuLinks[0]);
////////////////////////// ВЫНЕСТИ в функцию, т.к передавать только id инфоблока, а править код в каждой папке нелогично //////////
$arSelect = Array(
	"ID",
	"NAME",
	"SECTION_PAGE_URL",
	"UF_*"
);
$arFilter = Array(
	"IBLOCK_ID" => 33, //CCache::$arIBlocks[SITE_ID]["skidchik"]["actions"][0]
	"ACTIVE" => "Y"
);
$res = CIBlockSection::GetList(Array('SORT' => 'ASC'), $arFilter, false, $arSelect);
$arTemp = array();
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();

	$arTemp[] = $arFields;
	//$arTemp[$arFields["SECTION_PAGE_URL"]] = $arFields;
	//printr($arFields);
	//\Bitrix\Main\Diag\Debug:: writeToFile($arFields,'Var','/fields.log');
}
//printr($arTemp);
unset($res);

$rsEnum = CUserFieldEnum::GetList(array(), array('XML_ID' => SITE_SERVER_NAME . "-" . preg_replace('/\/(\w+)\/.*/', '$1', $APPLICATION->GetCurPage()) )); // можно выбирать по USER_FIELD_NAME => 'UF_GOROD' - нет в документации, но работает
$resArr = [];
	while($arEnum = $rsEnum->Fetch()) {
		//printr($arEnum);
		foreach ($arTemp as $key => $arSection) {
			if (in_array($arEnum['ID'], $arSection['UF_GOROD_'. strtoupper(preg_replace('/\/(\w+)\/.*/', '$1', $APPLICATION->GetCurPage()))])) {
				$resArr[] = [$arSection['NAME'], $arSection['SECTION_PAGE_URL']];
			}
		}
	}
$aMenuLinksExt = $resArr;
//$aMenuLinksExt = [['Тест', '/link'], ['Тест', '/link'] ]; // Запишем так результат
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
//unset ($aMenuLinks[$key]); строка if (in_array($arEnum['ID'], $arSection['UF_GOROD_'. strtouppe... если добавить отрицание !in_array, то можно вставить unset($aMenuLinks[$key]), но отключаются не те пункты видимо из-за сортировкию Если с ней разобраться будет ок. Естественно вверху раскаментить код подключения компонента.
?>