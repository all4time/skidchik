<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

// get all subsections of PARENT_SECTION or root sections
$arSectionsFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y');
$start_level = $arParams['DEPTH_LEVEL'];
$end_level = $arParams['DEPTH_LEVEL']+1;

if($arParams['PARENT_SECTION'])
{
	$arParentSection = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array('ID' => $arParams['PARENT_SECTION']), false, array('ID', 'IBLOCK_ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'));

	$arSectionsFilter = array_merge($arSectionsFilter, array(/*'SECTION_ID' => $arParams['PARENT_SECTION'],*/'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => '1'));
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
	{
		$arSectionsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
	}
}
else
{
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
	else
		$arSectionsFilter['DEPTH_LEVEL'] = '1';
}
$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), $arSectionsFilter, false, array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'PICTURE', 'DETAIL_PICTURE', 'UF_*', 'DESCRIPTION')); // Все UF_* !!!!!!!!!!!!

//printr($arResult['SECTIONS'][42]['UF_GOROD']);
//printr($arResult['SECTIONS']);

if($arResult['SECTIONS'])
{
	$arSections = array();
	foreach($arResult['SECTIONS'] as $key => $arSection)
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection['IBLOCK_ID'], $arSection['ID']);
		$arResult['SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();
		CIncorp2::getFieldImageData($arResult['SECTIONS'][$key], array('PICTURE'), 'SECTION');
	}
	
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
	{
		$bHasSubsections = false;
		foreach($arResult['SECTIONS'] as $arItem)
		{
			if( $arItem['DEPTH_LEVEL'] == $start_level )
			{
				if($arSections[$arItem['ID']])
					$arSections[$arItem['ID']] = array_merge($arItem, $arSections[$arItem['ID']]);
				else
					$arSections[$arItem['ID']] = $arItem;
			}
			elseif( $arItem['DEPTH_LEVEL'] == $end_level )
			{
				$bHasSubsections = true;
				$arSections[$arItem['IBLOCK_SECTION_ID']]['CHILD'][$arItem['ID']] = $arItem;
			}
		}
		\Bitrix\Main\Type\Collection::sortByColumn($arSections, array("SORT" => array(SORT_NUMERIC, SORT_ASC), "NAME" => SORT_ASC));

		$bShowElements = (($arParams['SHOW_ELEMENTS_IN_LAST_SECTION'] != 'Y' || ($arParams['SHOW_ELEMENTS_IN_LAST_SECTION'] == 'Y' && !$bHasSubsections)));
		if($bShowElements && $arParams['SHOW_CHILD_ELEMENTS'] == 'Y')
		{
			// fill elements
			foreach($arSections as $key => $arSection)
			{
				$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array_merge($arSectionsFilter, array('SECTION_ID' => $arSection['ID'])), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL'));
				if($arItems)
				{
					if(!$arSections[$key]['CHILD'])
						$arSections[$key]['CHILD'] = $arItems;
					else
						$arSections[$key]['CHILD'] = array_merge($arSections[$key]['CHILD'], $arItems);
				}
			}
		}
		$arResult['SECTIONS'] = $arSections;
		unset($arSections);
	}
}
/* //ЗАКРЫЛ поКА ЧТО! Выводятся пустые категории.
echo '<br>' . '/home/bitrix/ext_www/skidchik.ru/local/templates/incorp2/components/bitrix/news/catalog/bitrix/news.list/catalog_section_list/result_modifier.php' . '<br>';
// УСЛОВИЕ СТАВИТЬ ЗДЕСь!!!
// Можно получить пользовательское поле категории 
	$arSelect = Array ('UF_*');
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
		$arr[] = $ar_result['UF_TEST'][0];
		//printr($arResult['UF_TEST']);
    }
//printr($arResult['SECTIONS']);
printr($arr);
foreach ($arr as $key => $val) {
	$arResult['SECTIONS'][$key]['UF_TEST'] = $val;
}
//printr($arResult['SECTIONS']);
//unset ( $arResult [ 'SECTIONS' ][ 1 ]);
foreach  ( $arResult [ 'SECTIONS' ]  as   $key  =>  $arSection )
{
    //if  ($arSection [ "UF_TEST" ][ 0 ] != 'Поле для Мск' ){ // Условие не проработано
       //unset ( $arResult [ 'SECTIONS' ][ $key ]);
       //unset ( $arResult [ 'SECTIONS' ][ 0 ]); // Убирает категорию
		//printr($arSection['UF_TEST']);
	//}
}
*/
//printr($arResult['SECTIONS']);
//unset ($arResult['SECTIONS'][0]);




$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_GOROD");//IBLOCK_ID и ID обязательно должны быть указаны
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID" =>52); //!!!!!!!!!!!!!!!!!!!
$res = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){ 
	$arFields = $ob->GetFields();  
	//printr($arFields);
/* 	$arProps = $ob->GetProperties();
	printr($arProps); */
}

$db_list = CIBlockSection::GetList(
    false,//arOrder
    Array("IBLOCK_ID" => 33, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", "DEPTH_LEVEL" => "1"),//arFilter
    true,// количество элементов показывает' 
    Array(),//arSelect
    false
);
while($ar_result = $db_list->GetNext())
    {
        //echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
		//printr($ar_result);
    }


/* foreach ($arResult['SECTIONS'] as $key => $arSection) {
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_GOROD");//IBLOCK_ID и ID обязательно должны быть указаны
	$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID" =>$arSection['ID']); //!!!!!!!!!!!!!!!!!!!
	$res = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement()){
			//////////////////////////////
			$db_list = CIBlockSection::GetList(
				Array('NAME' => 'ASC'),//arOrder
				Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", "DEPTH_LEVEL" => "1"),//arFilter
				true,// количество элементов показывает' 
				Array(),//arSelect
				false
			);
			while($ar_result = $db_list->GetNext())
				{
					echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
					//printr($ar_result);
				}
			/////////////////////////////
			$arFields = $ob->GetFields();  
			//printr($arFields['NAME']);
			echo "Fields: " . $arFields['NAME'] . "- Section: " . $arSection['NAME'] . "- City: " . implode(', ', $arFields['PROPERTY_GOROD_VALUE']) . "<br>" ;
		}
} */

/* foreach ($arResult['SECTIONS'] as $key => $arSection) {
	$arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_GOROD", 'ACTIVE');//IBLOCK_ID и ID обязательно должны быть указаны
	$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID" =>$arSection['ID'], "ACTIVE" => ""); //!!!!!!!!!!!!!!!!!!!
	$res = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	//$nameKey = [];
		while($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();  */ 
			//printr($arFields['NAME']);
			//echo "Fields: " . $arFields['NAME'] . "- Section: " . $arSection['NAME'] . "- City: " . implode(', ', $arFields['PROPERTY_GOROD_VALUE']) . "<br>" ;
/* 			foreach ($arFields['PROPERTY_GOROD_VALUE'] as $item) {
				if (condition) {
					# code...
				} */
			//$arProps = $ob->GetProperties();
			//echo ($arProps['GOROD']['VALUE_XML_ID']);
			//$nameKey += [$arProps['GOROD']['XML_ID'] => $arProps['GOROD']['NAME']];
			//echo $arFields['ACTIVE'] . $arFields['NAME'] . $key . "<br>";

			//echo $arFields['ACTIVE'];
			//echo count($arFields['NAME']);

			//if ($arFields['ACTIVE'] == 'N') {
		/* 	if ((empty($arFields['PROPERTY_GOROD_VALUE'])) && ((count($arFields['ACTIVE'] == 'N')) == count($arFields['NAME']))) {
				unset($arResult['SECTIONS'][$key]);
				//echo $key;
			} */
			/* if ((empty($arFields['PROPERTY_GOROD_VALUE'])) && ($arFields['ACTIVE'] == 'N')) {
				unset($arResult['SECTIONS'][$key]);
				//echo $key;
			} */

			/* if (($arProps['GOROD']['VALUE_XML_ID'] == ['skidchik.ru'])) { // Сюда массив
				unset($arResult['SECTIONS'][$key]);
				//echo $key;
			} */
			/* if (in_array(SITE_SERVER_NAME, $arProps['GOROD']['VALUE_XML_ID'])) { // Смотреть это!!!
				echo "есть " . count($arProps['GOROD']['VALUE_XML_ID']);
			} else {
				echo "нет";
				//unset($arResult['SECTIONS'][$key]);
			} */
/* $as = array_search('skidchik.ru', $arProps['GOROD']['VALUE_XML_ID']);
echo "$as";
			if (in_array('skidchik.ru', $arProps['GOROD']['VALUE_XML_ID'])) {
				echo "есть ";
			} else {
				echo "нет ";
				//unset($arResult['SECTIONS'][$key]);
			} */

			//} //////////////////////////////////////////////////////////////////////////////
			//echo "<br>";
			//printr($nameKey);
			
			//echo SITE_SERVER_NAME;

			//unset($arResult['SECTIONS'][0]);

			//printr($arSection);

//}


/* $rsSites = CSite::GetList($by="sort", $order="desc", Array());
while ($arSite = $rsSites->Fetch())
{
	echo "<pre>"; print_r($arSite); echo "</pre>";
} */


echo SITE_SERVER_NAME;
// foreach ($arResult['SECTIONS'] as $key => $arSection) {
// 	//printr($arSection);
// 	$rsEnum = CUserFieldEnum::GetList(array(), array('USER_FIELD_NAME' => 'UF_GOROD')); // USER_FIELD_NAME нет в документации, но работает
// 	$uf_prop = array();
// 	while($arEnum = $rsEnum->Fetch())
// 	{
// 		//$uf_prop[$arEnum['ID']] = $arEnum['XML_ID'];
// 		printr($arEnum['XML_ID']);
// 		if (empty($arSection['UF_GOROD']) && ($arEnum['XML_ID'] != SITE_SERVER_NAME)){
// 			unset ($arResult['SECTIONS'][$key]);
// 	}

// 	/* if (empty($arSection['UF_GOROD']) && (!in_array(SITE_SERVER_NAME, $uf_prop))){
// 	unset ($arResult['SECTIONS'][$key]); */
// 	}

// }

/**
 * Логика отбора для данного шаблона.
 * Получаем для конкретного сайта его свойство пользовательского поля привязки категории к городу, xml_id, которого равен домену текущего сайта. 
 * Необходимо чтобы в массиве $arResult['SECTIONS'] были доступны UF-поля. В данном случае для этого добавил UF_* на 27 строке.
 * Для каждо категории, если в массиве $arSection['UF_GOROD'] нет ID свойства привязки ($arEnum['ID']), то отключаем категорию.  
 */
$rsEnum = CUserFieldEnum::GetList(array(), array('XML_ID' => SITE_SERVER_NAME )); // USER_FIELD_NAME нет в документации, но работает
	$uf_prop = array();
	while($arEnum = $rsEnum->Fetch()) {
		//$uf_prop[$arEnum['ID']] = $arEnum['XML_ID'];
		//printr($arEnum);
		foreach ($arResult['SECTIONS'] as $key => $arSection) {
			if (!in_array($arEnum['ID'], $arSection['UF_GOROD'])) {
				unset ($arResult['SECTIONS'][$key]);
			}			
		}
	}
//printr($uf_prop);

?>