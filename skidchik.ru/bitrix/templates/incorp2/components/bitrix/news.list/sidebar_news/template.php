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
<?
if($arResult["ITEMS"]):
	?>
	<span class="sidebar_title"><?=$arResult['NAME']?></span>
	<div class="news">
		<div class="items clearfix">
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$image = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 80, "height" => 80), BX_RESIZE_IMAGE_EXACT, false);
			?>
			<div class="item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
				<div class="photo">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$image["src"]?>" /></a>
				</div>
				<?endif;?>
				<div class="description">
					<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<span class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<?endif?>
					<span class="title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></span>
				</div>
			</div>
			<?endforeach;?>
		</div>
	</div>
	<?
endif;
?>