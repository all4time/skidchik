<?
$arSectionsFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'DEPTH_LEVEL' => 1, "ACTIVE" => "Y");
$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), $arSectionsFilter, false, array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'PICTURE', 'DETAIL_PICTURE', 'UF_SECTION_TEXT', 'DESCRIPTION'));
if($arResult['SECTIONS'])
{
	$arSections = array();
	foreach($arResult['SECTIONS'] as $key => $arSection)
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection['IBLOCK_ID'], $arSection['ID']);
		$arResult['SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();
		CIncorp2::getFieldImageData($arResult['SECTIONS'][$key], array('PICTURE'), 'SECTION');
	}
	

		foreach($arResult['SECTIONS'] as $arItem)
		{
			if( $arItem['DEPTH_LEVEL'] == 1 )
				$arSections[$arItem['ID']] = $arItem;
		}
		// fill elements
		foreach($arSections as $key => $arSection)
		{
			$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array_merge($arSectionsFilter, array('SECTION_ID' => $arSection['ID'], "ACTIVE" => "Y")), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL'));
			if($arItems)
			{
				if(!$arSections[$key]['CHILD'])
					$arSections[$key]['CHILD'] = $arItems;
				else
					$arSections[$key]['CHILD'] = array_merge($arSections[$key]['CHILD'], $arItems);
			}
		}
	$arResult['SECTIONS'] = $arSections;
}
?>
