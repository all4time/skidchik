<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
$sort_default = $arParams['SORT_PROP_DEFAULT'] ? $arParams['SORT_PROP_DEFAULT'] : 'sort';
$order_default = $arParams['SORT_DIRECTION'] ? $arParams['SORT_DIRECTION'] : 'asc';
$arPropertySortDefault = array('name', 'date', 'sort');

$arAvailableSort = array(
    'name' => array(
        'SORT' => 'NAME',
        'ORDER_VALUES' => array(
            'asc' => GetMessage('sort_title').GetMessage('sort_name_asc'),
            'desc' => GetMessage('sort_title').GetMessage('sort_name_desc'),
        ),
    ),
    'date' => array(
        'SORT' => 'DATE',
        'ORDER_VALUES' => array(
            'asc' => GetMessage('sort_title').GetMessage('sort_date_asc'),
            'desc' => GetMessage('sort_title').GetMessage('sort_date_desc'),
        ),
    ),
    'sort' => array(
        'SORT' => 'SORT',
        'ORDER_VALUES' => array(
            $order_default => GetMessage('sort_title').GetMessage('sort_sort'),
        )
    ),
);

foreach($arAvailableSort as $prop => $arProp){
    if(!in_array($prop, $arParams['SORT_PROP']) && $sort_default !== $prop){
        unset($arAvailableSort[$prop]);
    }
}

if($arParams['SORT_PROP']){
    foreach($arParams['SORT_PROP'] as $prop){
        if(!isset($arAvailableSort[$prop])){
            $dbRes = CIBlockProperty::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CODE' => $prop));
            while($arPropperty = $dbRes->Fetch()){
                $arAvailableSort[$prop] = array(
                    'SORT' => 'PROPERTY_'.$prop,
                    'ORDER_VALUES' => array(),
                );

                if($prop == 'PRICE'){
                    $arAvailableSort[$prop]['ORDER_VALUES']['asc'] = GetMessage('sort_title').GetMessage('sort_PRICE_asc');
                    $arAvailableSort[$prop]['ORDER_VALUES']['desc'] = GetMessage('sort_title').GetMessage('sort_PRICE_desc');
                }
                else{
                    $arAvailableSort[$prop]['ORDER_VALUES'][$order_default] = GetMessage('sort_title_property', array('#CODE#' => $arPropperty['NAME']));
                }
            }
        }
    }
    $_SESSION[$arParams['IBLOCK_ID'].md5(serialize((array)$arParams['SORT_PROP']))] = $arAvailableSort;
    
}

if(array_key_exists('sort', $_REQUEST) && !empty($_REQUEST['sort'])){
    setcookie('catalogSort', $_REQUEST['sort'], 0, SITE_DIR);
    $_COOKIE['catalogSort'] = $_REQUEST['sort'];
}
if(array_key_exists('order', $_REQUEST) && !empty($_REQUEST['order'])){
    setcookie('catalogOrder', $_REQUEST['order'], 0, SITE_DIR);
    $_COOKIE['catalogOrder'] = $_REQUEST['order'];
}
$sort = !empty($_COOKIE['catalogSort']) ? $_COOKIE['catalogSort'] : $sort_default;
$order = !empty($_COOKIE['catalogOrder']) ? $_COOKIE['catalogOrder'] : $order_default;
?>

<div class="sorting">
    <div class="select">
        <div class="checked">
            <select class="sort checked">
                <?foreach($arAvailableSort as $newSort => $arSort):?>
                <?if(is_array($arSort['ORDER_VALUES'])):?>
                <?foreach($arSort['ORDER_VALUES'] as $newOrder => $sortTitle):?>
                <?$selected = ($sort == $newSort && $order == $newOrder);?>
                <option <?=($selected ? "selected='selected'" : "")?>  value="<?=$APPLICATION->GetCurPageParam('sort='.$newSort.'&order='.$newOrder, array('sort', 'order'))?>" class="ordering"><span><?=$sortTitle?></span></option>
                <?endforeach;?>
                <?endif;?>
                <?endforeach;?>
            </select>
            <span></span>
        </div>                                    
    </div>                        
</div> 