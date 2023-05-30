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
<div class="partners_list">
    <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
    );?>
    <div class="items clearfix">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="pic">
                <div>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"/></a>
                    <?else:?>
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" />
                    <?endif;?>
                </div>
            </div>
            <div class="description">
                <span class="name">
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                    <?else:?>
                    <?echo $arItem["NAME"]?>
                    <?endif;?>
                </span>
                <p><?echo $arItem["PREVIEW_TEXT"];?></p>
                <div class="partners_contacts">
					<?if($arItem['PROPERTIES']['SITE']['VALUE']):?><a href="//<?=$arItem['PROPERTIES']['SITE']['VALUE']?>" target="_blank" class="mail"><?=$arItem['PROPERTIES']['SITE']['VALUE']?></a><?endif;?>
                    <?if($arItem['PROPERTIES']['PHONE']['VALUE']):?><span class="phone"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></span><?endif;?>
                    <?if($arItem['PROPERTIES']['WHO']['VALUE']):?><span class="who"><?=$arItem['PROPERTIES']['WHO']['VALUE']?></span><?endif;?>
                </div>
            </div>
        </div>
        <?endforeach;?>
    </div>                                                      
</div>