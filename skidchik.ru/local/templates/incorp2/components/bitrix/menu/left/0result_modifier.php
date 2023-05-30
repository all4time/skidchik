<?// отказался от этого способа отключения пунктов в меню, т.к. в верхнем меню не убирались пункты. Правил файл .left.menu_ext.php в папке 
$rsEnum = CUserFieldEnum::GetList(array(), array('XML_ID' => SITE_SERVER_NAME ));
$uf_prop = [];
while($arEnum = $rsEnum->Fetch()) {
    //$uf_prop[$arEnum['ID']] = $arEnum['XML_ID'];
    //printr($arEnum);
    $uf_prop[] = $arEnum['ID'];
}
//printr($uf_prop);


$arSelect = Array(
	"ID",
	"SECTION_PAGE_URL",
	"UF_*"
);
$arFilter = Array(
	"IBLOCK_ID" => 33,
	"ACTIVE" => "Y",
    "UF_GOROD" => $uf_prop
);
$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
$arTemp = array();
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arTemp[$arFields["SECTION_PAGE_URL"]] = $arFields;
}
unset($res);

//printr($arTemp);

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
unset($arTempResult);