<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

function sitemapCreate($iblockId, $siteUrl, $cityName, $propertyCode, $propertyPriority, $propertyChangefreq ) { 
	$dom = new domDocument("1.0", 'utf-8');
	$xml = $dom->createElement("xml");
	$xml ->setAttributeNS(null, 'version', '1.0');
	$xml ->setAttributeNS(null, 'encoding', 'utf-8');
	$dom->appendChild($xml); 
	$urlset = $dom->createElement("urlset"); 
	$urlset->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "TIMESTAMP_X", "PROPERTY_" . $propertyCode, "PROPERTY_" . $propertyPriority, "PROPERTY_" . $propertyChangefreq);
	$arFilter = Array("IBLOCK_ID"=>$iblockId, "INCLUDE_SUBSECTIONS" => "Y", "ACTIVE"=>"Y", "PROPERTY_" . $propertyCode . "_VALUE" => $cityName); //ID Инфоблока и ID раздела с элементами
	$rsElement = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize"=>5), $arSelect);
	//$arResult["ITEMS"] = array();
	while($obElement = $rsElement->GetNextElement())
	{
		$arrItem = $obElement->GetFields();
		$arrItem["PROPERTIES"] = $obElement->GetProperties();

		$google_link =  (CMain::IsHTTPS()) ? "https://" : "http://" . $siteUrl . $arrItem[DETAIL_PAGE_URL];
		$change_freq = $arrItem["PROPERTIES"][$propertyChangefreq]["VALUE"];
		$itemPriority = $arrItem["PROPERTIES"][$propertyPriority]["VALUE"];

		$date = new DateTime($arrItem["TIMESTAMP_X"]); 
		$last_mod = $date->format('Y-m-d\TH:i:s');
			
			$url = $dom->createElement("url");
			
			$loc = $dom->createElement("loc", $google_link);
			$lastmod = $dom->createElement("lastmod", $last_mod);
			$changefreq = $dom->createElement("changefreq", $change_freq);
			$priority = $dom->createElement("priority", $itemPriority);
				
			$url->appendChild($loc);
			$url->appendChild($lastmod);
			$url->appendChild($changefreq);
			$url->appendChild($priority);
			
		$urlset->appendChild($url);
	};
	$xml->appendChild($urlset);
	$dom->save("/home/bitrix/ext_www/$siteUrl/sitemap-iblock-$iblockId.xml"); //в корне директории откуда запускаем скрипт
	echo 'Готово';
}

sitemapCreate(15, "skidchik.ru", "Москва", "GOROD", "PRIORITY", "CHANGEFREQ");
//sitemapCreate(15, "spb.skidchik.ru", "Санкт-Петербург", "GOROD", "PRIORITY", "CHANGEFREQ"); // и так для каждого сайта
/* 
Функцию поместить в init.php 
Вызывать функцию в этом файле с разными параметрами: 
1. id инфоблока
2. домен
3. значение привязки GOROD
4. код этого свойства
5. код свойства приоритета
6. код свойства частота обновления

?>