<? 
function my () {
    $arSelect = Array("ID", "NAME", "SECTION_PAGE_URL", "UF_*");
    $arFilter = Array("IBLOCK_ID" => 33, "ACTIVE" => "Y");
    $res = CIBlockSection::GetList(Array('SORT' => 'ASC'), $arFilter, false, $arSelect);
    $arTemp = [];
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arTemp[] = $arFields;
    }
    $rsEnum = CUserFieldEnum::GetList(array(), array('XML_ID' => 'skidchik.ru-promo'));
    $resArr = [];
    while($arEnum = $rsEnum->Fetch()) {
        //printr($arEnum);
        foreach ($arTemp as $arSection) {
            if (in_array($arEnum['ID'], $arSection['UF_GOROD_PROMO'])) {
                $resArr[] = [$arSection['NAME'], $arSection['SECTION_PAGE_URL']];
            }
        }
    }
    return $resArr;

}