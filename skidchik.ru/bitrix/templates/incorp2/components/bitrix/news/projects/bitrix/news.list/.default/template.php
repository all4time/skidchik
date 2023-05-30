<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]):?>
<div class="projects_list">
    <div class="items clearfix">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
        if($arSection = $res->GetNext());
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <div class="pic" style="background-image: url(<?=($arItem['PREVIEW_PICTURE']['SRC'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH.'/img/no_img_line.png')?>);"></div>
                <div class="description">
                    <span class="title"><?=$arItem["NAME"]?></span>
                    <div class="clearfix">
                        <?if($arItem['PROPERTIES']['PROJECT_S']['VALUE']):?><span class="quantity"><?=$arItem['PROPERTIES']['PROJECT_S']['VALUE']?></span><?endif;?>
                        <?if($arItem['PROPERTIES']['PRICE']['VALUE']):?><span class="cost"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></span><?endif;?>
                    </div>
                </div>
            </a>
        </div>
        <?
    endforeach;
    ?>
</div>    
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?=$arSection["DESCRIPTION"]?>                        
</div>
<?endif;?>