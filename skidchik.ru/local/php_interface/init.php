<?php
if (!function_exists('printr')) {
    function printr($array)
    {
        global $USER;
        if (!$USER->IsAdmin())
            return false;
        $args = func_get_args();
        if (count($args) > 1) {
            foreach ($args as $values)
                printr($values);
        } else {
            if (is_array($array) || is_object($array)) {
                echo "<pre>";
                print_r($array);
                echo "</pre>";
            } else {
                echo $array;
            }
        }
        return true;
    }
}
/**
 * Фильтр элементов по городу
 * Так как нельзя перед вызовом компонента фильтровать по XML_ID свойства типа список, то сначала их необходимо получить все свойства
 * Фильтровать будем по PROPERTY_КОД СВОЙСТВА_VALUE. Логика простая: Получили все свойства и если для установленного свойства XML_ID равен url текущего сервера, а именно SITE_SERVER_NAME, то записываем в $GLOBALS фильтр по свойству PROPERTY_КОД СВОЙСТВА_VALUE, который равен текущему значению. 
 * ВАЖНО! XML_ID должно быть как домен сайта, например, spb.skidchik.ru для Санкт-Петербурга 
 */
function cityFilter($iblockId, $propertyCode)
{
    $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $iblockId, "CODE" => $propertyCode)); //Запрашиваем все свойства
    $arr_xml_id = []; // Создаем пустой массив
    while ($enum_fields = $property_enums->GetNext()) {
        $arr_xml_id += [$enum_fields["XML_ID"] => $enum_fields["VALUE"]];  // ОТМЕТИТЬ!!! Добавил xml_id и value в массив, как ключ=>значение.
        //$arr_xml_id[] = [$enum_fields["XML_ID"] => $enum_fields["VALUE"]]; // Этот вариант дает другой массив в данном случае
    }
    //printr($arr_xml_id); // Нужный нам массив
    foreach ($arr_xml_id as $xml_id => $value) { //Для каждого значения в массиве проверяем равно ли значение xml_id url'у текущего сайта
        if ($xml_id == SITE_SERVER_NAME) { // Константа битрикс. Поле "URL сервера" в настройках текущего сайта 
            $GLOBALS["arrFilterCity"] = array("=PROPERTY_" . $propertyCode . "_VALUE" => "$value");
        } else {
            $GLOBALS["arrFilterCity"] = array("=PROPERTY_" . $propertyCode . "_VALUE" => "Москва"); // На всякий случай, может и не нужно. Если что-то не так, то всегда Москва
        }
    }
}
//В php 8 строка 63 вызывает ошибку на skidchik,ru - [TypeError]
//in_array(): Argument #2 ($haystack) must be of type array, bool given (0). Добавил !empty($arSection['UF_GOROD_PROMO']). Сайт работают, но не знаю, работает ли правильно меню. Позже разберусь. Функция вызывается в /promo/.left.menu_ext.php
function my()
{
    $arSelect = array("ID", "NAME", "SECTION_PAGE_URL", "UF_*");
    $arFilter = array("IBLOCK_ID" => 33, "ACTIVE" => "Y");
    $res = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, $arSelect);
    $arTemp = [];
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arTemp[] = $arFields;
    }
    $rsEnum = CUserFieldEnum::GetList(array(), array('XML_ID' => 'skidchik.ru-promo'));
    $resArr = [];
    while ($arEnum = $rsEnum->Fetch()) {
        //printr($arEnum);
        foreach ($arTemp as $arSection) {
            if (!empty($arSection['UF_GOROD_PROMO']) && in_array($arEnum['ID'], $arSection['UF_GOROD_PROMO' ])) {
                $resArr[] = [$arSection['NAME'], $arSection['SECTION_PAGE_URL']];
            }
        }
    }
    return $resArr;
}
// Обработчик события при изменении элемента. Можно положить внутр создание карты сайта.
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/mylog.txt");

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("MyClass", "OnAfterIBlockElementUpdateHandler"));

class MyClass
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    static function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["RESULT"])
            //AddMessage2Log("Запись с кодом " . $arFields["ID"] . " изменена.");
            \Bitrix\Main\Diag\Debug::writeToFile($arFields, 'Var', '/myfields.log');
        else
            AddMessage2Log("Ошибка изменения записи " . $arFields["ID"] . " (" . $arFields["RESULT_MESSAGE"] . ").");
    }
}


//вывод printr($arResult);
// НЕЛЬЗЯ ОСТАВЛЯТЬ В ЭТОМ ФАЙЛЕ ПУСТЫЕ СТРОКИ после закрытия тега php, лучше открыть в начале <?php, писать весь код и в конце не ставить закрывающий тег пхп
define("SITE_SERVER_PROTOCOL", (CMain::IsHTTPS()) ? "https://" : "http://"); // Переменная определяет протокол, по которому работает ваш сайт
$curPage = $APPLICATION->GetCurPage(); // Получаем текущий адрес страницы
define('CATEGORY_ALL', 42); //так дается имя инфоблоку
define('CATEGORY_MSK', 40);
define('CATEGORY_SPB', 41);
/*//проверка на мобильные устройства
function check_mobile_device() {
    $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    foreach ($mobile_agent_array as $value) {
        if (strpos($agent, $value) !== false) return true;
    }
    return false;
}
*/