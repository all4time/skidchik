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
<div class="why">
	<div class="top">
		<h2><?=GetMessage('TITLE_BLOCK')?></h2>
		<p>
    <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
    );?>
</p>
	</div>
	<div class="bottom">
		<div class="items clearfix">
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
				<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
					<?endif;?>
					<div class="icon">
						<?if($arItem["PREVIEW_PICTURE"]):?>
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"/> 
						<?elseif($arItem['PROPERTIES']['FAICON']['VALUE']):?>
						<i class="fa <?=$arItem['PROPERTIES']['FAICON']['VALUE']?>" aria-hidden="true"></i>
						<?endif;?>      
					</div>
					<span><?=$arItem["NAME"]?></span>
					<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
				</a>
				<?endif;?>
			</div>
			<?endforeach;?>
		</div>
	</div>
</div> 