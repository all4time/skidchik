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
<div class="reviews">
    <div class="inner work">
        <?if($arParams['TITLE']):?><h2 class="title_block"><?=$arParams['TITLE']?></h2><?endif;?>
        <div class="reviews_items clearfix">
            <div class="slider_reviews">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="reviews_item">
                        <div class="top clearfix">
                            <div class="photo">
                                <?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"/>
                                <?else:?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg" alt="<?echo $arItem["NAME"]?>"/>
                                <?endif;?>
                            </div>
                            <div class="right"> 
                                <span class="name"><?echo $arItem["NAME"]?></span>
                                <span class="post"><?=$arItem['PROPERTIES']['AUTHOR']['VALUE']?></span>
                            </div>
                        </div>
                        <div class="bottom">
                            <span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                            <p><?=$arItem["PREVIEW_TEXT"];?></p>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>