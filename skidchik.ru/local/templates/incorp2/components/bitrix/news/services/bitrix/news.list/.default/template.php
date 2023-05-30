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
<div class="services_list">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br/>
    <?endif;?>
    <div class="items clearfix">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
        if($arSection = $res->GetNext());
        ?>
        <div class="content_item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="photo">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=($arItem['PREVIEW_PICTURE']['SRC'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH.'/img/no_img_line.png')?>" alt="<?=$arItem["NAME"]?>"/></a>
            </div>
            <div class="right">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><h3><?=$arItem["NAME"]?></h3></a>
                <p><?=$arItem["PREVIEW_TEXT"];?></p>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="more"><span><?=GetMessage("BUTTON_LINK")?></span></a>
            </div>
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