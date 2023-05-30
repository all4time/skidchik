<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

function sitemapMainCreate($siteUrl) { 
/* 	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
	CModule::IncludeModule("iblock"); */
	$dom = new domDocument("1.0", 'utf-8');
	$xml = $dom->createElement("xml");
	$xml ->setAttributeNS(null, 'version', '1.0');
	$xml ->setAttributeNS(null, 'encoding', 'utf-8');
	$dom->appendChild($xml); 
	$sitemapindex = $dom->createElement("sitemapindex"); 
	$sitemapindex->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

	$files = scandir("/home/bitrix/ext_www/" . $siteUrl);

	foreach ($files as $filename)
	{
		if (preg_match('/sitemap-iblock-\d{1,}.xml/', $filename, $matches)) 
		{
			$sitemap_link = (CMain::IsHTTPS()) ? "https://" : "http://" . $siteUrl . "/" . $filename; 
			$last_mod = date("Y-m-d\TH:i:s", filemtime("/home/bitrix/ext_www/" . $siteUrl . "/" . $filename));
			
			$sitemap = $dom->createElement("sitemap");
			
			$loc = $dom->createElement("loc", $sitemap_link);
			$lastmod = $dom->createElement("lastmod", $last_mod);
				
			$sitemap->appendChild($loc);
			$sitemap->appendChild($lastmod);
			
			$sitemapindex->appendChild($sitemap);
		}
	};
	$xml->appendChild($sitemapindex);
	$dom->save("/home/bitrix/ext_www/$siteUrl/sitemap.xml"); //в корне директории откуда запускаем скрипт
	echo 'Готово';
}

sitemapMainCreate("skidchik.ru"); // сначала запускаем функцию sitemapCreate, а затем эту
?>