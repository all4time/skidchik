<?// ЗАГОТОВКА для карты сайта изображений.
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$dom = new domDocument("1.0", 'utf-8');
$xml = $dom->createElement("xml");
$xml ->setAttributeNS(null, 'version', '1.0');
$xml ->setAttributeNS(null, 'encoding', 'utf-8');
$dom->appendChild($xml); 
$urlset = $dom->createElement("urlset"); 
$urlset->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$urlset->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns:image','http://www.google.com/schemas/sitemap-image/1.1');

$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE");
$arFilter = Array("IBLOCK_ID"=>7, "SECTION_ID"=>100, "INCLUDE_SUBSECTIONS" => "Y"); //ID Инфоблока и ID раздела с элементами
$rsElement = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize"=>5), $arSelect);
$arResult["ITEMS"] = array();
while($obElement = $rsElement->GetNextElement())
{
$arItem = $obElement->GetFields();
$arItem["PROPERTIES"] = $obElement->GetProperties();
$google_link =  'https://site.ru'.$arItem[DETAIL_PAGE_URL];
$google_img =  'https://site.ru'.CFile::GetPath($arItem[PREVIEW_PICTURE]);

    $url = $dom->createElement("url"); 
    $login = $dom->createElement("loc", $google_link);
    $url->appendChild($login);
    $image = $dom->createElement("image:image");
    $image2 = $dom->createElement("image:loc", $google_img);
    $image->appendChild($image2);
    $url->appendChild($image);

$urlset->appendChild($url);
};
$xml->appendChild($urlset);
$dom->save("img.xml"); //в корне директории откуда запускаем скрипт
echo 'Готово';
?>