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
global $arTheme;
if($arTheme['MONEY_FRACTIONS']['VALUE'] == 'Y'){
	$decimals = 2;
}else{
	$decimals = 0;
}
?>
<div class="catalog_items">
	<div class="tile clearfix">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div>
				<div class="top">
					<?if($arItem['PROPERTIES']['PLASHKA']['VALUE']):?>
					<?foreach ($arItem['PROPERTIES']['PLASHKA']['VALUE'] as $plKey => $plValue)
					{?>
						<span class="shild <?=$arItem['PROPERTIES']['PLASHKA']['VALUE_XML_ID'][$plKey]?>"><?=$plValue?></span><?
					}?>
					<?endif;?> 
				</div>
				<div class="pic">   
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>" /></a>
				</div>
				<div class="description">
					<span class="name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></span>
					<span class="availability <?=$arItem['PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$arItem['PROPERTIES']['STATUS']['VALUE']?></span>
					<span class="price"><?if($arItem['PROPERTIES']['PRICE']['VALUE']):?><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?><?=($arItem['PROPERTIES']['UNIT']['VALUE'] ? '/'.$arItem['PROPERTIES']['UNIT']['VALUE'] : '')?><?endif;?> <?if($arItem['PROPERTIES']['OLD_PRICE']['VALUE']):?><span class="old_price"><?=number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?></span><?endif;?></span>
					<div class="bottom clearfix">
						<a class="btn btn_main" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=GetMessage('DETAIL')?></a>
					</div>
				</div>
			</div>
		</div>
		<?endforeach;?>
	</div>
</div>