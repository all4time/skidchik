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
<div class="blog">
    <div class="inner work">
        <div class="clearfix">
            <?if($arParams['TITLE']):?><h2 class="title_block"><?=$arParams['TITLE']?></h2><?endif;?>
            <?if($arParams['ALL_LINK']):?>  <a class="more" href="<?=$arParams['ALL_LINK']?>"><span><?=$arParams['LINK_NAME']?></span></a><?endif;?>
        </div>
        <div class="border"></div>
        <div class="items clearfix">
            <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
            if($arSection = $res->GetNext());
            ?>
            <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="pic" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"></a></div>
                <div class="description">
                    <div class="clearfix">
                        <span class="theme"><?=$arSection['NAME']?></span>
                        <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <span class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
                        <?endif?>
                    </div>
                    <span class="title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></span>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>